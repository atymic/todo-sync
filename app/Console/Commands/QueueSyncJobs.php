<?php

namespace App\Console\Commands;

use App\Jobs\SyncUserReminders;
use App\User;
use Illuminate\Console\Command;

class QueueSyncJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:queue';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::whereNotNull('google_refresh_token')
            ->whereNotNull('todoist_access_token')
            ->where('sync_enabled', true)
            ->get()
        ->each(function (User $user) {
            dispatch(new SyncUserReminders($user));
        });
    }
}
