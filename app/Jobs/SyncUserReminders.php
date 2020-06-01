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
use Illuminate\Support\Facades\Log;

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
        $reminderClient = $this->user->getGoogleReminderClient();
        $todoistClient = $this->user->getTodoistClient();
        $reminders = $reminderClient->listReminders($this->user->timezone);

        if ($reminders === null) {
            Log::debug(sprintf('Failed to fetch reminders for user %s', $this->user->id));
            return;
        }

        $tasksToSync = $reminders->filter()->where('done', false);

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
            $todoistClient->createTasks($todoistTasks->toArray());
        }

        if ($this->user->google_reminders === GoogleRemoveSetting::IMMEDIATE) {
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
    }
}
