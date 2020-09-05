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
                'nombre' => 'Caja',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Bancos',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'nombre' => 'Caja de ahorros',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'nombre' => 'Deposito a plazo fijo',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'nombre' => 'Cuentas por cobrar',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'nombre' => 'Documentos por cobrar',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'nombre' => 'Crédito fiscal',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'nombre' => 'Anticipo de impuestos',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'nombre' => 'Inventario de mercadería',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'nombre' => 'Muebles y enseres',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'nombre' => 'Aportes',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'nombre' => 'Equipos de computación',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'nombre' => 'Material de escritorio',
                'detalles' => 'nn',
                'created_at' => '2020-08-31 11:22:02',
                'updated_at' => '2020-08-31 11:22:02',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}