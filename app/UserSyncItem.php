<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSyncItem extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
