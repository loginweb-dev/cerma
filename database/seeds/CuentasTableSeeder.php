<?php

use Illuminate\Database\Seeder;

class CuentasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cuentas')->delete();
        
        \DB::table('cuentas')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Aportes',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}