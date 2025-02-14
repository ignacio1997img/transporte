<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartamentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('departaments')->delete();
        
        \DB::table('departaments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'country_id' => 1,
                'name' => 'Beni',
                'issued' => 'BE',
                'status' => 1,
                'created_at' => '2025-02-14 14:20:51',
                'updated_at' => '2025-02-14 14:52:55',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'country_id' => 1,
                'name' => 'Pando',
                'issued' => 'PD',
                'status' => 1,
                'created_at' => '2025-02-14 14:22:34',
                'updated_at' => '2025-02-14 14:55:02',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'country_id' => 1,
                'name' => 'Santa Cruz',
                'issued' => 'SCZ',
                'status' => 1,
                'created_at' => '2025-02-14 14:52:34',
                'updated_at' => '2025-02-14 14:52:34',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'country_id' => 1,
                'name' => 'Oruro',
                'issued' => 'OR',
                'status' => 1,
                'created_at' => '2025-02-14 14:53:16',
                'updated_at' => '2025-02-14 14:53:16',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'country_id' => 1,
                'name' => 'La Paz',
                'issued' => 'LP',
                'status' => 1,
                'created_at' => '2025-02-14 14:53:29',
                'updated_at' => '2025-02-14 14:53:29',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'country_id' => 1,
                'name' => 'Cochabamba',
                'issued' => 'CBBA',
                'status' => 1,
                'created_at' => '2025-02-14 14:53:45',
                'updated_at' => '2025-02-14 14:53:45',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'country_id' => 1,
                'name' => 'Potosí',
                'issued' => 'PT',
                'status' => 1,
                'created_at' => '2025-02-14 14:54:09',
                'updated_at' => '2025-02-14 14:54:09',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'country_id' => 1,
                'name' => 'Chuquisaca',
                'issued' => 'CH',
                'status' => 1,
                'created_at' => '2025-02-14 14:54:33',
                'updated_at' => '2025-02-14 14:54:33',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'country_id' => 1,
                'name' => 'Tarija',
                'issued' => 'TJA',
                'status' => 1,
                'created_at' => '2025-02-14 14:54:57',
                'updated_at' => '2025-02-14 14:54:57',
                'registerUser_id' => NULL,
                'registerRole' => NULL,
                'deleted_at' => NULL,
                'deletedUser_id' => NULL,
                'deletedRole' => NULL,
                'deletedObservation' => NULL,
            ),
        ));
        
        
    }
}