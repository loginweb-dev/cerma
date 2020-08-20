<?php

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Herramientas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 17:22:14',
                'route' => NULL,
                'parameters' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Diseñador de Menús',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 1,
                'order' => 1,
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Multimedia',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => 1,
                'order' => 2,
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Usuarios',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => 1,
                'order' => 3,
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
                'route' => 'voyager.users.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Paginas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-paypal',
                'color' => NULL,
                'parent_id' => 1,
                'order' => 4,
                'created_at' => '2020-08-19 16:05:12',
                'updated_at' => '2020-08-19 16:05:12',
                'route' => 'voyager.pages.index',
                'parameters' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Plan de Cuentas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-file-text',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 2,
                'created_at' => '2020-08-19 17:15:39',
                'updated_at' => '2020-08-19 19:48:00',
                'route' => 'voyager.cuentas.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Aportes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-window-list',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 3,
                'created_at' => '2020-08-19 17:18:56',
                'updated_at' => '2020-08-19 19:48:00',
                'route' => 'voyager.aportes.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Administración',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-folder',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2020-08-19 17:22:09',
                'updated_at' => '2020-08-19 17:22:16',
                'route' => NULL,
                'parameters' => '',
            ),
            8 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'Afiliados',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => NULL,
                'parent_id' => 8,
                'order' => 1,
                'created_at' => '2020-08-19 19:46:52',
                'updated_at' => '2020-08-19 19:48:00',
                'route' => 'voyager.afiliados.index',
                'parameters' => NULL,
            ),
        ));
        
        
    }
}