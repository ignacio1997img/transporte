<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('permission_role')->delete();
        
        // Root
        $role = Role::where('name', 'admin')->firstOrFail();
        $permissions = Permission::all();
        $role->permissions()->sync($permissions->pluck('id')->all());



        // $role = Role::where('name', 'sedeges_admin')->firstOrFail();
        // $permissions = Permission::whereRaw('table_name = "admin" or
        //                                     `key` = "browse_centro_categorias" or
        //                                     `key` = "read_centro_categorias" or
        //                                     `key` = "edit_centro_categorias" or
        //                                     `key` = "add_centro_categorias" or

        //                                     `key` = "browse_centros" or
        //                                     `key` = "read_centros" or
        //                                     `key` = "edit_centros" or
        //                                     `key` = "add_centros" or

        //                                     `key` = "browse_donacion_categorias" or
        //                                     `key` = "read_donacion_categorias" or
        //                                     `key` = "edit_donacion_categorias" or
        //                                     `key` = "add_donacion_categorias" or

        //                                     `key` = "browse_donacion_articulos" or
        //                                     `key` = "read_donacion_articulos" or
        //                                     `key` = "add_donacion_articulos" or
        //                                     `key` = "edit_donacion_articulos" or

        //                                     `key` = "browse_donador_personas" or
        //                                     `key` = "read_donador_personas" or
        //                                     `key` = "edit_donador_personas" or
        //                                     `key` = "add_donador_personas" or

        //                                     `key` = "browse_donador_empresas" or
        //                                     `key` = "read_donador_empresas" or
        //                                     `key` = "edit_donador_empresas" or
        //                                     `key` = "add_donador_empresas" or

        //                                     `key` = "browse_incomedonor" or
        //                                     `key` = "read_incomedonor" or
        //                                     `key` = "edit_incomedonor" or
        //                                     `key` = "add_incomedonor" or
        //                                     `key` = "browse_incomedonorstockview" or

        //                                     `key` = "browse_egressdonor" or
        //                                     `key` = "read_egressdonor" or
        //                                     `key` = "edit_egressdonor" or
        //                                     `key` = "add_egressdonor" or

        //                                     table_name = "view_stock_donacion" or
        //                                     `key` = "browse_clear-cache"')->get();
        // $role->permissions()->sync($permissions->pluck('id')->all());
    }
}
