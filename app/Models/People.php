<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RegistersUserEvents;


class People extends Model
{
    use HasFactory, RegistersUserEvents, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ci',
        'first_name',
        'last_name',
        'birth_date',
        'email',
        'phone',
        'address',
        'gender',
        'image',
        'status',

        'registerUser_id',
        'registerRole',
        'deleted_at',
        'deletedUser_id',
        'deletedRole',
        'deletedObservation',
    ];
}
