<?php

use Illuminate\Database\Seeder;

class DataTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('data_types')->delete();
        
        \DB::table('data_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'users',
                'slug' => 'users',
                'display_name_singular' => 'Usuario',
                'display_name_plural' => 'Usuarios',
                'icon' => 'voyager-person',
                'model_name' => 'TCG\\Voyager\\Models\\User',
                'policy_name' => 'TCG\\Voyager\\Policies\\UserPolicy',
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerUserController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-09-02 15:38:27',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'menus',
                'slug' => 'menus',
                'display_name_singular' => 'Menú',
                'display_name_plural' => 'Menús',
                'icon' => 'voyager-list',
                'model_name' => 'TCG\\Voyager\\Models\\Menu',
                'policy_name' => NULL,
                'controller' => '',
                'description' => '',
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => NULL,
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'roles',
                'slug' => 'roles',
                'display_name_singular' => 'Rol',
                'display_name_plural' => 'Roles',
                'icon' => 'voyager-lock',
                'model_name' => 'TCG\\Voyager\\Models\\Role',
                'policy_name' => NULL,
                'controller' => 'TCG\\Voyager\\Http\\Controllers\\VoyagerRoleController',
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"desc","default_search_key":null,"scope":null}',
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-25 22:20:40',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'pages',
                'slug' => 'pages',
                'display_name_singular' => 'Pagina',
                'display_name_plural' => 'Paginas',
                'icon' => 'voyager-browser',
                'model_name' => 'App\\Page',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"id","order_display_column":"id","order_direction":"asc","default_search_key":"id","scope":null}',
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'blocks',
                'slug' => 'blocks',
                'display_name_singular' => 'Blocke',
                'display_name_plural' => 'Blockes',
                'icon' => 'voyager-params',
                'model_name' => 'App\\Block',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"id","order_display_column":"id","order_direction":"asc","default_search_key":"id","scope":null}',
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'cuentas',
                'slug' => 'cuentas',
                'display_name_singular' => 'Cuenta',
                'display_name_plural' => 'Plan de Cuentas',
                'icon' => 'voyager-file-text',
                'model_name' => 'App\\Cuenta',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"id","order_display_column":"id","order_direction":"asc","default_search_key":"nombre","scope":null}',
                'created_at' => '2020-08-19 17:15:39',
                'updated_at' => '2020-08-31 11:32:33',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'aportes',
                'slug' => 'aportes',
                'display_name_singular' => 'Aporte',
                'display_name_plural' => 'Tipos de aportes',
                'icon' => 'voyager-window-list',
                'model_name' => 'App\\Aporte',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"id","order_display_column":"id","order_direction":"asc","default_search_key":"nombre","scope":null}',
                'created_at' => '2020-08-19 17:18:56',
                'updated_at' => '2020-08-31 12:10:11',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'afiliados',
                'slug' => 'afiliados',
                'display_name_singular' => 'Afiliado',
                'display_name_plural' => 'Afiliados',
                'icon' => 'voyager-person',
                'model_name' => 'App\\Afiliado',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"nombre_completo","order_display_column":"nombre_completo","order_direction":"asc","default_search_key":"nombre_completo","scope":null}',
                'created_at' => '2020-08-19 19:46:52',
                'updated_at' => '2020-09-02 15:10:25',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'plans_of_accounts',
                'slug' => 'plans-of-accounts',
                'display_name_singular' => 'Plan de Cuenta',
                'display_name_plural' => 'Planes de Cuentas',
                'icon' => 'voyager-double-right',
                'model_name' => 'App\\Models\\PlansOfAccount',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 1,
                'details' => '{"order_column":"id","order_display_column":"id","order_direction":"asc","default_search_key":"id","scope":null}',
                'created_at' => '2020-09-25 16:20:39',
                'updated_at' => '2020-10-01 18:09:36',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'type_documents',
                'slug' => 'type-documents',
                'display_name_singular' => 'Tipo de Documento',
                'display_name_plural' => 'Tipos de Documentos',
                'icon' => 'voyager-documentation',
                'model_name' => 'App\\Models\\TypeDocument',
                'policy_name' => NULL,
                'controller' => NULL,
                'description' => NULL,
                'generate_permissions' => 1,
                'server_side' => 0,
                'details' => '{"order_column":null,"order_display_column":null,"order_direction":"asc","default_search_key":null,"scope":null}',
                'created_at' => '2020-09-26 16:37:17',
                'updated_at' => '2020-09-26 16:38:53',
            ),
        ));
        
        
    }
}