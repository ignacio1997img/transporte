<?php

namespace App\Observers;

use App\Models\Country;

class CountryObserver
{
    /**
     * Maneja el evento "deleting" del modelo Country.
     */
    // public function deleting(Country $country)
    // {
    //     // Eliminar lógicamente los departamentos relacionados
    //     $country->departaments()->delete();
    // }

    // /**
    //  * Maneja el evento "restoring" del modelo Country.
    //  */
    // public function restoring(Country $country)
    // {
    //     // Restaurar lógicamente los departamentos relacionados
    //     $country->departaments()->restore();
    // }
}
