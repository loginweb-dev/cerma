<?php

use Illuminate\Database\Seeder;

class AfiliadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('afiliados')->delete();
        
        \DB::table('afiliados')->insert(array (
            0 => 
            array (
                'id' => 2,
                'nombre_completo' => 'RAUL EGGERS AÑEZ',
                'ci' => '1737743 BE',
                'rau' => '8039342109',
                'movil' => '71126044',
                'localidad' => 'TRINIDAD',
                'direccion' => 'ZONA SAN ANTONIO,  CALLE MAMORÈ  N.º 360',
                'fecha_afiliacion' => '2015-04-15',
                'foto' => 'afiliados/September2020/uYQ59Dzs01unbetUS2RW.jpg',
                'created_at' => '2020-09-18 12:16:46',
                'updated_at' => '2020-09-18 12:40:19',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 3,
                'nombre_completo' => 'JORGE MONTELLANO ROLDÀN',
                'ci' => '1052243 BE',
                'rau' => NULL,
                'movil' => '71130302',
                'localidad' => 'TRINIDAD',
                'direccion' => 'ZONA FATIMA, CALLE TTE. LUIS CÈSPEDES nº 48',
                'fecha_afiliacion' => '2012-09-15',
                'foto' => 'afiliados/September2020/pvz0tCuNikbUtWiioXrX.jpg',
                'created_at' => '2020-09-18 12:50:56',
                'updated_at' => '2020-09-18 12:52:01',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 4,
                'nombre_completo' => 'ARMANDO GÒMEZ ARTEAGA',
                'ci' => '1727667 BE',
                'rau' => NULL,
                'movil' => '70261411',
                'localidad' => 'TRINIDAD',
                'direccion' => 'ZONA CHAPARRAL Nº F01',
                'fecha_afiliacion' => '2015-05-15',
                'foto' => NULL,
                'created_at' => '2020-09-18 13:07:34',
                'updated_at' => '2020-09-18 13:07:34',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 5,
                'nombre_completo' => 'ALARCÒN BALCAZAR WILMA TERESA',
                'ci' => '1707205-BENI',
                'rau' => '8039250994',
                'movil' => '71123676',
                'localidad' => 'TRINIDAD',
                'direccion' => 'S/N',
                'fecha_afiliacion' => '2012-04-15',
                'foto' => NULL,
                'created_at' => '2020-09-21 14:19:17',
                'updated_at' => '2020-09-21 14:19:17',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 6,
                'nombre_completo' => 'APONTE DELLIEN HUGO NICOLAS',
                'ci' => '4190147 - BENI',
                'rau' => '8039361030',
                'movil' => '69050003',
                'localidad' => 'TRINIDAD',
                'direccion' => NULL,
                'fecha_afiliacion' => '2019-02-15',
                'foto' => NULL,
                'created_at' => '2020-09-21 14:23:36',
                'updated_at' => '2020-09-21 14:23:36',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 7,
                'nombre_completo' => 'APONTE LOPEZ LUIS ALBERTO',
                'ci' => '4196757 - BENI',
                'rau' => 'S/R',
                'movil' => 'S/T',
                'localidad' => 'TRINIDAD',
                'direccion' => NULL,
                'fecha_afiliacion' => '2018-11-15',
                'foto' => NULL,
                'created_at' => '2020-09-21 14:26:11',
                'updated_at' => '2020-09-21 14:26:11',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 8,
                'nombre_completo' => 'ARGANDOÑA FLORIAN JHON ORLANDO',
                'ci' => '1906170-1K',
                'rau' => NULL,
                'movil' => '72811299',
                'localidad' => 'TRINIDAD',
                'direccion' => 'MACHETEROS S/N',
                'fecha_afiliacion' => '2012-06-01',
                'foto' => NULL,
                'created_at' => '2020-09-21 14:43:06',
                'updated_at' => '2020-09-21 14:43:06',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 9,
                'nombre_completo' => 'ARIAS VILLARROEL ROXANA DE YAÑEZ',
                'ci' => '1731785-BENI',
                'rau' => '8039244670',
                'movil' => '78280998',
                'localidad' => 'TRINIDAD',
                'direccion' => NULL,
                'fecha_afiliacion' => '2019-08-01',
                'foto' => NULL,
                'created_at' => '2020-09-21 14:45:49',
                'updated_at' => '2020-09-21 14:45:49',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 10,
                'nombre_completo' => 'ARTEAGA VACA CARLOS ALBERTO',
                'ci' => '1932567-BENI',
                'rau' => '8039238143',
                'movil' => '78288803',
                'localidad' => 'TRINIDAD',
                'direccion' => NULL,
                'fecha_afiliacion' => '2013-02-01',
                'foto' => NULL,
                'created_at' => '2020-09-21 14:48:00',
                'updated_at' => '2020-09-21 14:48:00',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}