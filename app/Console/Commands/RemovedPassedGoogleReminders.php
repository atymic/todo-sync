<?php

namespace App\Console\Commands;

use App\Jobs\DeleteGoogleReminders;
use App\User;
use App\UserSyncItem;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class RemovedPassedGoogleReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:passed';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::whereHas('syncItems', function (Builder $query) {
            return $query->where('due_at', '<', now());
        })->each(function (User $user) {
            dispatch(new DeleteGoogleReminders($user, $user->syncItems->pluck('google_id')->toArray()));
        });
    }
}
