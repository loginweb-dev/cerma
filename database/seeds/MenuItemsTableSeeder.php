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
                'parent_id' => 11,
                'order' => 1,
                'created_at' => '2020-08-19 17:15:39',
                'updated_at' => '2020-08-25 22:26:09',
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
                'parent_id' => 11,
                'order' => 2,
                'created_at' => '2020-08-19 17:18:56',
                'updated_at' => '2020-08-25 22:26:11',
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
            9 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Cobro de aportes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-dollar',
                'color' => '#000000',
                'parent_id' => 8,
                'order' => 2,
                'created_at' => '2020-08-25 22:25:22',
                'updated_at' => '2020-08-25 22:25:28',
                'route' => 'aporteafiliado.index',
                'parameters' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Parametros',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-browser',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2020-08-25 22:26:04',
                'updated_at' => '2020-08-25 22:26:04',
                'route' => NULL,
                'parameters' => '',
            ),
            11 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Reporte',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-receipt',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2020-08-30 22:10:14',
                'updated_at' => '2020-08-30 22:10:14',
                'route' => NULL,
                'parameters' => '',
            ),
            12 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Recepciones',
                'url' => 'admin/importar/recepciones',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => '#000000',
                'parent_id' => 12,
                'order' => 1,
                'created_at' => '2020-08-30 22:14:06',
                'updated_at' => '2020-08-30 22:21:42',
                'route' => NULL,
                'parameters' => '',
            ),
            13 => 
            array (
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Afiliados',
                'url' => 'admin/reportes/afiliados',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '#000000',
                'parent_id' => 12,
                'order' => 2,
                'created_at' => '2020-09-04 21:05:49',
                'updated_at' => '2020-09-04 21:06:01',
                'route' => NULL,
                'parameters' => '',
            ),
            14 => 
            array (
                'id' => 15,
                'menu_id' => 1,
                'title' => 'Planes de Cuentas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-double-right',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2020-09-25 16:20:39',
                'updated_at' => '2020-09-25 16:20:39',
                'route' => 'voyager.plans-of-accounts.index',
                'parameters' => NULL,
            ),
        ));
        
        
    }
}