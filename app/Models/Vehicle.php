<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RegistersUserEvents;

class Vehicle extends Model
{
    use HasFactory, RegistersUserEvents, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'image',
        'number',
        'year',
        'color',
        'model',
        'brand',
        'ability',
        'numberChassis',
        'numberEngine',
        'numberRegistration',
        'description',
        'status',
        'registerUser_id',
        'registerRole',
        'deleted_at',
        'deletedUser_id',
        'deletedRole',
        'deletedObservation'
    ];

    public function vehicleSeat() {
        return $this->hasMany(VehicleSeat::class);
    }
}
