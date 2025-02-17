<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\RegistersUserEvents;

class Country extends Model
{
    use HasFactory, RegistersUserEvents, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'status', 'registerUser_id', 'registerRole', 'deletedUser_id', 'deletedRole', 'deletedObservation'
    ];

    public function departaments()
    {
        return $this->hasMany(Departament::class);
    }

    public function delete()
    {
        // Eliminar lógicamente los departamentos relacionados
        $this->departaments()->delete();

        // Eliminar lógicamente el país
        return parent::delete();
    }

    public function restore()
    {
        // Restaurar lógicamente los departamentos relacionados
        $this->departaments()->restore();

        // Restaurar lógicamente el país
        return parent::restore();
    }
}
