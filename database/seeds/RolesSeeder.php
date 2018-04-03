<?php

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  Borramos los datos de la tabla
        // DB::table('roles')->delete();

        //  Añadimos los roles que seran usados
        Roles::create(array(
        'name'=>'Admin','description'=>'Allows viewing but does not modify the content'));
    }
}
