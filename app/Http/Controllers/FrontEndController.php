<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Block;
use App\Page;
use App\User;
class FrontEndController extends Controller
{
    function default()
    {

        $page = setting('site.page');
        $collection = Page::where('slug', $page)->first();
        
        if($collection){
            $blocks = Block::where('page_id', $collection->id)->orderBy('position', 'asc')->get();
            return view($collection->direction, [
                'collection' => json_decode($collection->details, true),
                'page' => $collection,
                'blocks'     => $blocks
            ]);
        }else{
            return view('welcome');
        }
        
    }
    public function pages($slug)
    {
        $collection = Page::where('slug', $slug)->first();
        // return $collection;
        $blocks = Block::where('page_id', $collection->id)->orderBy('position', 'asc')->get();
        // return $blocks;
        return view($collection->direction, [
            'collection' => json_decode($collection->details, true),
            'page' => $collection,
            'blocks'     => $blocks
        ]);
    }
}
