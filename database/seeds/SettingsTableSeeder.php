<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('settings')->delete();
        
        \DB::table('settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'key' => 'site.title',
                'display_name' => 'Título del sitio',
                'value' => 'cerma v1.0',
                'details' => '',
                'type' => 'text',
                'order' => 1,
                'group' => 'Site',
            ),
            1 => 
            array (
                'id' => 2,
                'key' => 'site.description',
                'display_name' => 'Descripción del sitio',
                'value' => 'Descripción del sitio',
                'details' => '',
                'type' => 'text',
                'order' => 2,
                'group' => 'Site',
            ),
            2 => 
            array (
                'id' => 3,
                'key' => 'site.logo',
                'display_name' => 'Logo del sitio',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 3,
                'group' => 'Site',
            ),
            3 => 
            array (
                'id' => 4,
                'key' => 'site.google_analytics_tracking_id',
                'display_name' => 'ID de rastreo de Google Analytics',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 4,
                'group' => 'Site',
            ),
            4 => 
            array (
                'id' => 5,
                'key' => 'site.page',
                'display_name' => 'Pagina',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 5,
                'group' => 'Site',
            ),
            5 => 
            array (
                'id' => 6,
                'key' => 'admin.bg_image',
                'display_name' => 'Imagen de fondo del administrador',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 6,
                'group' => 'Admin',
            ),
            6 => 
            array (
                'id' => 7,
                'key' => 'admin.title',
                'display_name' => 'Título del administrador',
                'value' => 'cerma',
                'details' => '',
                'type' => 'text',
                'order' => 7,
                'group' => 'Admin',
            ),
            7 => 
            array (
                'id' => 8,
                'key' => 'admin.description',
                'display_name' => 'Descripción del administrador',
                'value' => 'Asociación de Pequeños Productores de Leche de las Provincias Cercado y Marbán',
                'details' => '',
                'type' => 'text',
                'order' => 8,
                'group' => 'Admin',
            ),
            8 => 
            array (
                'id' => 9,
                'key' => 'admin.loader',
                'display_name' => 'Imagen de carga del administrador',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 9,
                'group' => 'Admin',
            ),
            9 => 
            array (
                'id' => 10,
                'key' => 'admin.icon_image',
                'display_name' => 'Ícono del administrador',
                'value' => '',
                'details' => '',
                'type' => 'image',
                'order' => 10,
                'group' => 'Admin',
            ),
            10 => 
            array (
                'id' => 11,
                'key' => 'admin.google_analytics_client_id',
            'display_name' => 'ID de Cliente para Google Analytics (usado para el tablero de administrador)',
                'value' => NULL,
                'details' => '',
                'type' => 'text',
                'order' => 11,
                'group' => 'Admin',
            ),
            11 => 
            array (
                'id' => 12,
                'key' => 'recibo.titulo',
                'display_name' => 'titulo',
                'value' => 'Asociación de Pequeños Productores de Leche de las Provincias Cercado y Marbán',
                'details' => NULL,
                'type' => 'text',
                'order' => 12,
                'group' => 'Recibo',
            ),
            12 => 
            array (
                'id' => 13,
                'key' => 'recibo.nit',
                'display_name' => 'nit',
                'value' => '334494027',
                'details' => NULL,
                'type' => 'text',
                'order' => 13,
                'group' => 'Recibo',
            ),
            13 => 
            array (
                'id' => 14,
                'key' => 'recibo.direccion',
                'display_name' => 'Dirección',
                'value' => 'Edificio FEGABENI 3er piso Av. Cipriano Barace',
                'details' => NULL,
                'type' => 'text_area',
                'order' => 14,
                'group' => 'Recibo',
            ),
            14 => 
            array (
                'id' => 15,
                'key' => 'recibo.localidad',
                'display_name' => 'Localidad',
                'value' => 'Santísima Trinidad - Beni - Bolivia',
                'details' => NULL,
                'type' => 'text',
                'order' => 15,
                'group' => 'Recibo',
            ),
            15 => 
            array (
                'id' => 16,
                'key' => 'recibo.celular',
                'display_name' => 'Celular',
                'value' => '73913283',
                'details' => NULL,
                'type' => 'text',
                'order' => 16,
                'group' => 'Recibo',
            ),
            16 => 
            array (
                'id' => 17,
                'key' => 'recibo.observaciones',
                'display_name' => 'Observaciones',
                'value' => 'Observaciones: Pago por aportaciones a socios a CERMA y aporte del 0,5% al litro de leche.',
                'details' => NULL,
                'type' => 'text_area',
                'order' => 17,
                'group' => 'Recibo',
            ),
        ));
        
        
    }
}