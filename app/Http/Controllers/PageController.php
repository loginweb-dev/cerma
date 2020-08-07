<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Page;
class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        $page = Page::where('id', $id)->first(); 
        $dataType = Voyager::model('DataType')->where('slug', '=', 'pages')->first();
        return view('vendor.pages.edit', [
            'page' => $page,
            'dataType' => $dataType
        ]);
    }

    public function update(Request $request, $page_id)
    {
       
        $page = Page::where('id', $page_id)->first();
        $page->name = $request->name;
        $page->slug = Str::slug($request->name);
        $page->direction = $request->direction;
        $page->description = $request->description;
        if($request->hasFile('image')){
         
            $image=Storage::disk('public')->put('pages/'.date('F').date('Y'), $request->file('image'));
            $page->image = $image;
        }
        $mijson = $page->details;
        if ($mijson) {
            foreach(json_decode($page->details, true) as $item => $value)
            {
                if($value['type'] == 'image')
                {
                    $mijson = str_replace($value['value'], $value['value'], $mijson);
                }else{
                    if($value['type'] == 'space')
                    {
                    }else
                    {
                        $mijson_aux = json_decode($mijson, true);
                        $mijson_aux[$value['name']]['value'] = $request[$value['name']];
                        $mijson = json_encode($mijson_aux);
                    }
                }
                if($request->hasFile($value['name']))
                {
                    $dirimage = Storage::disk('public')->put('pages/'.date('F').date('Y'), $request->file($value['name']));
                    $mijson = str_replace($value['value'], $dirimage, $mijson);
                }
               
            }
            // return $mijson;
            $page->details = $mijson;
        }
   
        $page->save();
        
        return back()->with([
            'message'    => 'Pagina Actualizada - '.$page->name,
            'alert-type' => 'success',
        ]);
    }

    function default($page_id)
    {
        $page = Page::where('id', $page_id)->first(); 
        
        DB::table('settings')
            ->where('key', 'site.page')
            ->update(['value' => $page->slug]);
            
            return back()->with([
                'message'    => $page->name.' - plantilla establecida',
                'alert-type' => 'success',
            ]);
    }
}
