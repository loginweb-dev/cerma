<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Traits\Seedable;

class VoyagerDatabaseSeeder extends Seeder
{
    use Seedable;

    protected $seedersPath = __DIR__.'/';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seed('DataTypesTableSeeder');
        $this->seed('DataRowsTableSeeder');
        $this->seed('MenusTableSeeder');
        $this->seed('MenuItemsTableSeeder');
        $this->seed('RolesTableSeeder');
        $this->seed('PermissionsTableSeeder');
        $this->seed('PermissionRoleTableSeeder');
        $this->seed('SettingsTableSeeder');
        $this->seed('UserSeeder');
        $this->seed('PageSeeder');
        $this->seed('CuentasTableSeeder');
        $this->seed('AportesTableSeeder');
        $this->seed('PlansOfAccountsTableSeeder');
        $this->seed('DetailAccountsTableSeeder');
        $this->seed('TypeDocumentsTableSeeder');
    }
}
