<?php

use App\Role;
use App\User;
use App\Branch;
use App\Company;
use App\Country;
use App\Functionality;
use App\Salesroute;
use Illuminate\Database\Seeder;
//use Database\seeds\RolesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	/*Inhabilitamos el chequeo de claves foráneas*/
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
    	/* Borramos los datos de las tablas */
        User::truncate();

		$cantidadPaises = 50;
        $cantidadEmpresas = 10;
        $cantidadSucursales = 100;
        $cantidadUsuarios = 200;
        $cantidadRutas = 100;
        

        /* invocamos el seeder para crear la data fake */
        factory(Country::class, $cantidadPaises)->create();
		factory(Company::class, $cantidadEmpresas)->create();
		factory(Branch::class, $cantidadSucursales)->create();
        factory(User::class, $cantidadUsuarios)->create();
        factory(Salesroute::class, $cantidadRutas)->create();

        /*Creamos los roles definidos*/
        //$this->call(RolesSeeder::class);
        Role::create(array('name'=>'Admin','description'=>'Administrador del sistema','status'=>true));
        Role::create(array('name'=>'Consultor','description'=>'Permite hacer modificaciones en los datos','status'=>true));
        Role::create(array('name'=>'Modificador','description'=>'Solo permite hacer consultas de datos','status'=>true));

        /*Creamos las funciones para los roles */
        //$this->call(RolesSeeder::class);
        Functionality::create(array('name'=>'CountryCreate','module'=>'Country','permission'=>'C')); /* C=Create*/
        Functionality::create(array('name'=>'CountryRead','module'=>'Country','permission'=>'R')); /* R=Read*/
        Functionality::create(array('name'=>'CountryUpdate','module'=>'Country','permission'=>'U')); /* U=Update*/
        Functionality::create(array('name'=>'CountryDelete','module'=>'Country','permission'=>'D')); /* D=Delete*/
        Functionality::create(array('name'=>'CompanyCreate','module'=>'Company','permission'=>'C')); /* C=Create*/
        Functionality::create(array('name'=>'CompanyRead','module'=>'Company','permission'=>'R')); /* R=Read*/
        Functionality::create(array('name'=>'CompanyUpdate','module'=>'Company','permission'=>'U')); /* U=Update*/
        Functionality::create(array('name'=>'CompanyDelete','module'=>'Company','permission'=>'D')); /* D=Delete*/
        Functionality::create(array('name'=>'BranchCreate','module'=>'Branch','permission'=>'C')); /* C=Create*/
        Functionality::create(array('name'=>'BranchRead','module'=>'Branch','permission'=>'R')); /* R=Read*/
        Functionality::create(array('name'=>'BranchUpdate','module'=>'Branch','permission'=>'U')); /* U=Update*/
        Functionality::create(array('name'=>'BranchDelete','module'=>'Branch','permission'=>'D')); /* D=Delete*/
        Functionality::create(array('name'=>'UserCreate','module'=>'User','permission'=>'C')); /* C=Create*/
        Functionality::create(array('name'=>'UserRead','module'=>'User','permission'=>'R')); /* R=Read*/
        Functionality::create(array('name'=>'UserUpdate','module'=>'User','permission'=>'U')); /* U=Update*/
        Functionality::create(array('name'=>'UserDelete','module'=>'User','permission'=>'D')); /* D=Delete*/
        Functionality::create(array('name'=>'RoleCreate','module'=>'Role','permission'=>'C')); /* C=Create*/
        Functionality::create(array('name'=>'RoleRead','module'=>'Role','permission'=>'R')); /* R=Read*/
        Functionality::create(array('name'=>'RoleUpdate','module'=>'Role','permission'=>'U')); /* U=Update*/
        Functionality::create(array('name'=>'RoleDelete','module'=>'Role','permission'=>'D')); /* D=Delete*/
        Functionality::create(array('name'=>'FunctionalityRead','module'=>'Functinality','permission'=>'R')); /* R=Read*/
        /* Creamos la relacin entre los roles y los Functionality */


        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
