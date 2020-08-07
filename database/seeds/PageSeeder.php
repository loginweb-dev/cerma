<?php

use Illuminate\Database\Seeder;
use App\Page;
use App\Block;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = Page::create([
            'name'      => 'Landingpage Software',
            'slug'      => 'landingpage-software',
            'description' => 'Pagina de Destino para Empresa de Software',
            'direction' => 'pages.lps',
            'user_id' => 1,
            'details'   => null
        ]);
    }
}
