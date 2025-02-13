<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait RegistersUserEvents
{
    protected static function bootRegistersUserEvents()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $user = Auth::user();
                $model->registerUser_id = $user->id;
                $model->registerRole = $user->role->name;
            }
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $user = Auth::user();
                $model->deletedUser_id = $user->id;
                $model->deletedRole = $user->role->name;
                $model->save();
            }
        });
    }
}
