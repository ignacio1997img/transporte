<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RegistersUserEvents;

class Departament extends Model
{
    use HasFactory, RegistersUserEvents, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'country_id', 'name', 'issued', 'status', 'registerUser_id', 'registerRole', 'deletedUser_id', 'deletedRole', 'deletedObservation'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
