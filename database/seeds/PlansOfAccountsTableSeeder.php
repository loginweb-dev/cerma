<?php

use Illuminate\Database\Seeder;

class PlansOfAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('plans_of_accounts')->delete();
        
        \DB::table('plans_of_accounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
                'code' => '10',
                'name' => 'Caja y Banco',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'created_at' => '2020-09-26 16:02:59',
                'updated_at' => '2020-09-26 16:02:59',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
                'code' => '11',
                'name' => 'INVERSIONES AL VALOR RAZONABLE Y DISPONIBLES PARA LA VENTA',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'created_at' => '2020-09-26 16:23:09',
                'updated_at' => '2020-09-26 16:23:09',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
                'code' => '12',
                'name' => 'CUENTAS POR COBRAR COMERCIALES – TERCEROS',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'created_at' => '2020-09-26 16:24:01',
                'updated_at' => '2020-09-26 16:24:01',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
                'code' => '13',
                'name' => 'CUENTAS POR COBRAR COMERCIALES – RELACIONADAS',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'created_at' => '2020-09-26 16:24:17',
                'updated_at' => '2020-09-26 16:24:17',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
                'code' => '14',
            'name' => 'CUENTAS POR COBRAR AL PERSONAL, A LOS ACCIONISTAS SOCIOS), DIRECTORES Y GERENTES',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:24:39',
            'updated_at' => '2020-09-26 16:24:39',
            'deleted_at' => NULL,
        ),
        5 => 
        array (
            'id' => 6,
            'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
            'code' => '16',
            'name' => 'CUENTAS POR COBRAR DIVERSAS - TERCEROS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:25:51',
            'updated_at' => '2020-09-26 16:25:51',
            'deleted_at' => NULL,
        ),
        6 => 
        array (
            'id' => 7,
            'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
            'code' => '17',
            'name' => 'CUENTAS POR COBRAR DIVERSAS - RELACIONADAS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:26:14',
            'updated_at' => '2020-09-26 16:26:14',
            'deleted_at' => NULL,
        ),
        7 => 
        array (
            'id' => 8,
            'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
            'code' => '18',
            'name' => 'SERVICIOS Y OTROS CONTRATADOS POR ANTICIPADO',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:26:39',
            'updated_at' => '2020-09-26 16:26:39',
            'deleted_at' => NULL,
        ),
        8 => 
        array (
            'id' => 9,
            'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
            'code' => '19',
            'name' => 'ESTIMACIÓN DE CUENTAS DE COBRANZA DUDOSA',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:27:02',
            'updated_at' => '2020-09-26 16:27:02',
            'deleted_at' => NULL,
        ),
        9 => 
        array (
            'id' => 10,
            'element' => 'ACTIVO REALIZABLE',
            'code' => '20',
            'name' => 'MERCADERÍAS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:27:33',
            'updated_at' => '2020-09-26 16:27:33',
            'deleted_at' => NULL,
        ),
        10 => 
        array (
            'id' => 11,
            'element' => 'ACTIVO REALIZABLE',
            'code' => '21',
            'name' => 'PRODUCTOS TERMINADOS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:28:08',
            'updated_at' => '2020-09-26 16:28:08',
            'deleted_at' => NULL,
        ),
        11 => 
        array (
            'id' => 12,
            'element' => 'ACTIVO REALIZABLE',
            'code' => '22',
            'name' => 'SUBPRODUCTOS, DESECHOS Y DESPERDICIOS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:28:29',
            'updated_at' => '2020-09-26 16:28:29',
            'deleted_at' => NULL,
        ),
        12 => 
        array (
            'id' => 13,
            'element' => 'ACTIVO DISPONIBLE Y EXIGIBLE',
            'code' => '23',
            'name' => 'PRODUCTOS EN PROCESO',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:28:48',
            'updated_at' => '2020-09-26 16:28:48',
            'deleted_at' => NULL,
        ),
        13 => 
        array (
            'id' => 14,
            'element' => 'ACTIVO REALIZABLE',
            'code' => '24',
            'name' => 'MATERIAS PRIMAS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:30:20',
            'updated_at' => '2020-09-26 16:30:20',
            'deleted_at' => NULL,
        ),
        14 => 
        array (
            'id' => 15,
            'element' => 'ACTIVO REALIZABLE',
            'code' => '25',
            'name' => 'MATERIALES AUXILIARES, SUMINISTROS Y REPUESTOS',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:30:42',
            'updated_at' => '2020-09-26 16:30:42',
            'deleted_at' => NULL,
        ),
        15 => 
        array (
            'id' => 16,
            'element' => 'ACTIVO REALIZABLE',
            'code' => '26',
            'name' => 'ENVASES Y EMBALAJES',
            'debe' => NULL,
            'haber' => NULL,
            'tipo' => 'A',
            'grupo' => '1',
            'conasev' => NULL,
            'saldo' => NULL,
            'created_at' => '2020-09-26 16:31:24',
            'updated_at' => '2020-09-26 16:31:24',
            'deleted_at' => NULL,
        ),
    ));
        
        
    }
}