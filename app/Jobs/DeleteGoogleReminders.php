<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteGoogleReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var array
     */
    private $googleReminderIds;

    public function __construct(User $user, array $googleReminderIds)
    {
        $this->user = $user;
        $this->googleReminderIds = $googleReminderIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = $this->user->getGoogleReminderClient();

        foreach ($this->googleReminderIds as $reminderId) {
            $client->deleteReminder($reminderId);
        }
    }
}
