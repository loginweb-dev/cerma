<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
        $keys = [
            'browse_admin',
            'browse_bread',
            'browse_database',
            'browse_media',
            'browse_compass',
        ];

        foreach ($keys as $key) {
            Permission::firstOrCreate([
                'key'        => $key,
                'table_name' => null,
            ]);
        }

        Permission::generateFor('menus');

        Permission::generateFor('roles');

        Permission::generateFor('users');

        Permission::generateFor('settings');

        Permission::generateFor('afiliados');

        Permission::generateFor('aportes');

        Permission::generateFor('cuentas');

        Permission::generateFor('aporteafiliado');

        Permission::generateFor('pages');

        Permission::generateFor('blocks');

        Permission::generateFor('plans_of_accounts');

        Permission::generateFor('type_documents');

        Permission::generateFor('asientos');
    }
}
