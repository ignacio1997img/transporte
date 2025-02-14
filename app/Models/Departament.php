<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',

        'registerUser_id',
        'registerRole',
        'deleted_at',
        'deletedUser_id',
        'deletedRole',
        'deletedObservation'
    ];


    public function departaments()
    {
        return $this->hasMany(Departament::class, 'country_id');
    }
}
