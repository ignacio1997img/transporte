<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('countries')->delete();
        
        \DB::table('countries')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bolivia',
                'status' => 1,
                'created_at' => '2025-02-14 13:57:10',
                'updated_at' => '2025-02-14 13:57:10',
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