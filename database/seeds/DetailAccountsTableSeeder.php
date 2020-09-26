<?php

use Illuminate\Database\Seeder;

class DetailAccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('detail_accounts')->delete();
        
        \DB::table('detail_accounts')->insert(array (
            0 => 
            array (
                'id' => 2,
                'sub_account' => '101',
                'division' => NULL,
                'sub_division' => '10100',
                'name' => 'Caja',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:14:14',
                'updated_at' => '2020-09-26 16:14:14',
            ),
            1 => 
            array (
                'id' => 3,
                'sub_account' => '102',
                'division' => NULL,
                'sub_division' => '10200',
                'name' => 'Fondos Fijos',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:14:47',
                'updated_at' => '2020-09-26 16:14:47',
            ),
            2 => 
            array (
                'id' => 4,
                'sub_account' => '103',
                'division' => NULL,
                'sub_division' => '10300',
                'name' => 'Efectivo en Transito',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:15:24',
                'updated_at' => '2020-09-26 16:15:24',
            ),
            3 => 
            array (
                'id' => 5,
                'sub_account' => '104',
                'division' => NULL,
                'sub_division' => NULL,
                'name' => 'Cuentas corrientes en instituciones financieras',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:16:02',
                'updated_at' => '2020-09-26 16:16:02',
            ),
            4 => 
            array (
                'id' => 6,
                'sub_account' => NULL,
                'division' => '1041',
                'sub_division' => '10410',
                'name' => 'Cuentas corrientes operativas',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:16:47',
                'updated_at' => '2020-09-26 16:16:47',
            ),
            5 => 
            array (
                'id' => 7,
                'sub_account' => NULL,
                'division' => '1042',
                'sub_division' => '10430',
                'name' => 'Cuentas corrientes para fines específicos',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:17:52',
                'updated_at' => '2020-09-26 16:17:52',
            ),
            6 => 
            array (
                'id' => 8,
                'sub_account' => '105',
                'division' => NULL,
                'sub_division' => NULL,
                'name' => 'Certificados bancarios',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:18:19',
                'updated_at' => '2020-09-26 16:18:19',
            ),
            7 => 
            array (
                'id' => 9,
                'sub_account' => NULL,
                'division' => '1051',
                'sub_division' => '10510',
                'name' => 'Certificados bancarios',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:19:19',
                'updated_at' => '2020-09-26 16:19:19',
            ),
            8 => 
            array (
                'id' => 10,
                'sub_account' => NULL,
                'division' => '1052',
                'sub_division' => '10520',
                'name' => 'Otros',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:20:06',
                'updated_at' => '2020-09-26 16:20:06',
            ),
            9 => 
            array (
                'id' => 11,
                'sub_account' => '106',
                'division' => NULL,
                'sub_division' => NULL,
                'name' => 'Depósitos en instituciones financieras',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:20:29',
                'updated_at' => '2020-09-26 16:20:29',
            ),
            10 => 
            array (
                'id' => 12,
                'sub_account' => NULL,
                'division' => '1061',
                'sub_division' => '10610',
                'name' => 'Depósitos de ahorro',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:21:26',
                'updated_at' => '2020-09-26 16:21:26',
            ),
            11 => 
            array (
                'id' => 13,
                'sub_account' => NULL,
                'division' => '1062',
                'sub_division' => '10620',
                'name' => 'Depósitos a plazo',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:21:55',
                'updated_at' => '2020-09-26 16:21:55',
            ),
            12 => 
            array (
                'id' => 14,
                'sub_account' => '107',
                'division' => NULL,
                'sub_division' => NULL,
                'name' => 'Fondos sujetos a restricción',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:22:17',
                'updated_at' => '2020-09-26 16:22:17',
            ),
            13 => 
            array (
                'id' => 15,
                'sub_account' => NULL,
                'division' => '1071',
                'sub_division' => '10710',
                'name' => 'Fondos Sujetos a Restricción',
                'debe' => NULL,
                'haber' => NULL,
                'tipo' => 'A',
                'grupo' => '1',
                'conasev' => NULL,
                'saldo' => NULL,
                'plan_of_account_id' => 1,
                'created_at' => '2020-09-26 16:22:46',
                'updated_at' => '2020-09-26 16:22:46',
            ),
        ));
        
        
    }
}