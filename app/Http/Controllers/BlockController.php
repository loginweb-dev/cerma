<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Storage;
use App\Block;
use App\Page;
class BlockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($page_id)
    {
        $page = Page::where('id', $page_id)->first();
        $blocks = Block::where('page_id', $page_id)->orderBy('position', 'asc')->get();
        $dataType = Voyager::model('DataType')->where('slug', '=', 'blocks')->first();
        // dd($page, $blocks, $dataType);
        // return $page;
        return view('vendor.pages.blocks', [
            'blocks' => $blocks,
            'dataType' =>  $dataType,
            'page' => $page
        ]);
    }

    public function update(Request $request, $block_id)
    {
        $block = Block::where('id', $block_id)->first();
        $mijson = $block->details;

        switch ($block->type) {
            case 'dinamyc-data':
                foreach(json_decode($block->details, true) as $item => $value)
                {
                    if($value['type'] == 'image'){
                        // $mijson = str_replace($value['value'], $value['value'], $mijson);
                    }else{
                        if($value['type'] == 'space'){
                        }else{
                            $mijson_aux = json_decode($mijson, true);
                            $mijson_aux[$value['name']]['value'] = $request[$value['name']];
                            $mijson = json_encode($mijson_aux);
                        }
                    }
                    if($request->hasFile($value['name'])){
                        $dirimage = Storage::disk('public')->put('blocks/'.date('F').date('Y'), $request->file($value['name']));
                        $mijson_aux = json_decode($mijson, true);
                        $mijson_aux[$value['name']]['value'] = $dirimage;
                        $mijson = json_encode($mijson_aux);  
                        // $mijson = str_replace($value['value'], $dirimage, $mijson);
                    }
                }
                $block->details = $mijson;
                $block->save();
                break;
            case 'controller':
                foreach(json_decode($block->details, true) as $item => $value)
                {
                    $mijson_aux = json_decode($mijson, true);
                    $mijson_aux[$value['name']]['value'] = $request[$value['name']];
                    $mijson = json_encode($mijson_aux);
                }
                $block->details = $mijson;
                $block->save();
                break;
        }
        
        return back()->with([
            'message'    => 'Block '.$block->title.' actualizado.',
            'alert-type' => 'success',
        ]);
    }


    public function block_ordering($block_id, $order){
        return Block::where('id', $block_id)->update(['position' => $order]);
    }

    public function delete($id)
    {
        Block::where('id', $id)->delete();
        return back()->with([
            'message'    => 'Block Eliminado',
            'alert-type' => 'success',
        ]);
    }

    public function move_up($id)
    {
        $block = Block::where('id', $id)->first();
        $swapOrder = $block->position;

        $previousSetting = Block::where('position', '<', $swapOrder)->orderBy('position', 'DESC')->first();
        $data = [
        'message'    => __('voyager::settings.already_at_top'),
        'alert-type' => 'error',
        ];
        // return $previousSetting;
        if (isset($previousSetting->position)) {
            $block->position = $previousSetting->position;
            $block->save();
            $previousSetting->position = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => __('voyager::settings.moved_order_up', ['name' => $block->title]),
                'alert-type' => 'success',
            ];
        }

        return back()->with($data);
    }

    public function move_down($id)
    {
     
        $block = Block::where('id', $id)->first();

        $swapOrder = $block->position;

        $previousSetting = Block::where('position', '>', $swapOrder)->orderBy('position', 'ASC')->first();
        $data = [
            'message'    => __('voyager::settings.already_at_bottom'),
            'alert-type' => 'error',
        ];

        if (isset($previousSetting->position)) {
            $block->position = $previousSetting->position;
            $block->save();
            $previousSetting->position = $swapOrder;
            $previousSetting->save();

            $data = [
                'message'    => __('voyager::settings.moved_order_down', ['name' => $block->title]),
                'alert-type' => 'success',
            ];
        }

        return back()->with($data);
    }

}
