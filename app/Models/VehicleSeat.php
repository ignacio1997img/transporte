<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RegistersUserEvents;

class VehicleSeat extends Model
{
    use HasFactory, RegistersUserEvents, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'vehicle_id',
        'seatNumber',
        'label',
        'position_x',
        'position_y',
        'is_driver',

        'status',
        'registerUser_id',
        'registerRole',
        'deleted_at',
        'deletedUser_id',
        'deletedRole',
        'deletedObservation'
    ];    

    public function vehicle() {
        return $this->belongsTo(Vehicle::class);
    }
}
