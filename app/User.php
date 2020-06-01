<?php

namespace App;

use App\Service\GoogleReminders\GoogleReminderClient;
use App\Service\Todoist\TodoistSyncClient;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'todoist_id' => 'integer',
        'google_access_token_expires_at' => 'datetime',
        'sync_enabled' => 'boolean',
        'todoist_disable_reminders' => 'boolean',
    ];

    public function syncItems()
    {
        return $this->hasMany(UserSyncItem::class);
    }

    public function getSetupAttribute()
    {
        return $this->google_refresh_token && $this->todoist_access_token;
    }

    public function getGoogleReminderClient(): GoogleReminderClient
    {
        return new GoogleReminderClient(
            $this->google_access_token,
            $this->google_access_token_expires_at,
            $this->google_refresh_token
        );
    }

    public function getTodoistClient(): TodoistSyncClient
    {
        return new TodoistSyncClient($this->todoist_access_token);
    }
}
