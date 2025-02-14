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

    // protected $fillable = [  
    //     'name',
    //     'status',

    //     'registerUser_id',
    //     'registerRole',
    //     'deleted_at',
    //     'deletedUser_id',
    //     'deletedRole',
    //     'deletedObservation'
    // ];


    public function departaments()
    {
        return $this->hasMany(Departament::class, 'country_id');
    }
}
