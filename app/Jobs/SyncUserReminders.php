<?php

namespace App\Jobs;

use App\Enums\GoogleRemoveSetting;
use App\Service\GoogleReminders\GoogleReminder;
use App\Service\Todoist\TodoistTask;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Sentry;
use Sentry\Breadcrumb;

class SyncUserReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->sync();
        } catch (\Exception $exception) {
            report($exception);
            Log::error(sprintf('Failed to sync for user %d', $this->user->id), [
                'message' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
            ]);

            $failKey = sprintf('sync:failcount:todo:%s', $this->user->id);
            $fails = Cache::get($failKey, 0);
            if ($fails > 3) {
                $this->user->update([
                    'sync_enabled' => false,
                ]);

                return;
            }

            Cache::put($failKey, $fails + 1, now()->addMinutes(10));

            // TODO alert the user that their sync was turned off?
        }
    }

    private function sync()
    {
        Sentry::addBreadcrumb(new Breadcrumb(
            Breadcrumb::LEVEL_DEBUG,
            Breadcrumb::TYPE_HTTP,
            'sync',
            'sync-starting',
            ['id' => $this->user->id]
        ));

        Log::debug('SYNC_START', ['user' => $this->user->id]);

        $reminderClient = $this->user->getGoogleReminderClient();
        $todoistClient = $this->user->getTodoistClient();
        $reminders = $reminderClient->listReminders($this->user->timezone);

        if ($reminders === null) {
            Log::debug(sprintf('Failed to fetch reminders for user %s', $this->user->id));
            return;
        }

        $tasksToSync = $reminders
            ->filter()
            ->where('repeating', false)
            ->where('done', false);

        if ($this->user->google_reminders === GoogleRemoveSetting::AFTER_TIME) {
            $alreadySynced = $this->user->syncItems()->pluck('google_id');

            $tasksToSync = $tasksToSync->filter(function (GoogleReminder $reminder) use ($alreadySynced) {
                return $alreadySynced->search($reminder->id) === false;
            });
        }

        $todoistTasks = $tasksToSync->map(function (GoogleReminder $googleReminder) {
            return new TodoistTask([
                'content' => $googleReminder->title,
                'label' => 'GReminder',
                'due' => $googleReminder->remindAt,
                'autoReminder' => !$this->user->todoist_disable_reminders,
            ]);
        });

        if ($todoistTasks->isNotEmpty()) {
            $todoistTasks->chunk(90)->each(function (Collection $chunk) use ($todoistClient) {
                $todoistRes = $todoistClient->createTasks($chunk->toArray());
                Sentry::addBreadcrumb(new Breadcrumb(
                    Breadcrumb::LEVEL_DEBUG,
                    Breadcrumb::TYPE_HTTP,
                    'todoist-res',
                    null,
                    $todoistRes
                ));
            });
        }

        if ($this->user->google_reminders === GoogleRemoveSetting::IMMEDIATE) {
            Log::debug('SYNC_DELETE', ['user' => $this->user->id, 'tasks' => $tasksToSync->count()]);
            $tasksToSync->each(function (GoogleReminder $reminder) use ($reminderClient) {
                $reminderClient->deleteReminder($reminder->id);
            });
        }

        if ($this->user->google_reminders === GoogleRemoveSetting::AFTER_TIME) {
            $this->user->syncItems()->createMany(
                $tasksToSync->map(function (GoogleReminder $reminder) {
                    return [
                        'google_id' => $reminder->id,
                        'due_at' => $reminder->remindAt->utc(),
                        'created_at' => $reminder->createdAt,
                    ];
                })
            );
        }

        Log::debug('SYNC_FINISH', ['user' => $this->user->id, 'tasks' => $tasksToSync->count()]);

        Sentry::addBreadcrumb(new Breadcrumb(
            Breadcrumb::LEVEL_DEBUG,
            Breadcrumb::TYPE_HTTP,
            'sync',
            'sync-finished',
            ['id' => $this->user->id, 'tasks' => $tasksToSync->count()]
        ));
    }
}
