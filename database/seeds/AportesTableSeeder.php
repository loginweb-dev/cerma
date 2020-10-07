<?php

use Illuminate\Database\Seeder;

class AportesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('aportes')->delete();
        
        \DB::table('aportes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'cuenta_id' => 1,
                'nombre' => 'Pago quincenal a CERMA',
                'tipo' => 'monto',
                'monto' => '20.00',
                'descripcion' => 'nn',
                'created_at' => '2020-08-31 11:22:38',
                'updated_at' => '2020-08-31 11:22:38',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'cuenta_id' => 1,
                'nombre' => 'Aporte de 0,5% a la leche',
                'tipo' => 'porcentaje',
                'monto' => '0.05',
                'descripcion' => 'nn',
                'created_at' => '2020-08-31 11:25:33',
                'updated_at' => '2020-08-31 11:25:33',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}