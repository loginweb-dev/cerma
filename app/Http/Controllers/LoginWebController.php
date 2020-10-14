<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class LoginWebController extends Controller
{
    public function save_image($file, $dir){
        try {
            Storage::makeDirectory("/public/$dir/".date('F').date('Y'));
            $base_name = Str::random(20);

            // imagen normal
            $filename = $base_name.'.'.$file->getClientOriginalExtension();
            $image_resize = Image::make($file->getRealPath())->orientate();
            $image_resize->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path =  "$dir/".date('F').date('Y').'/'.$filename;
            $image_resize->save(public_path('../storage/app/public/'.$path));
            $imagen = $path;

            // imagen mediana
            $filename_medium = $base_name.'-medium.'.$file->getClientOriginalExtension();
            $image_resize = Image::make($file->getRealPath())->orientate();
            $image_resize->resize(512, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path_medium = "$dir/".date('F').date('Y').'/'.$filename_medium;
            $image_resize->save(public_path('../storage/app/public/'.$path_medium));

            // imagen pequeña
            $filename_small = $base_name.'-small.'.$file->getClientOriginalExtension();
            $image_resize = Image::make($file->getRealPath())->orientate();
            $image_resize->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $path_small = "$dir/".date('F').date('Y').'/'.$filename_small;
            $image_resize->save(public_path('../storage/app/public/'.$path_small));

            // imagen cuadrada
            $filename_small = $base_name.'-cropped.'.$file->getClientOriginalExtension();
            $image_resize = Image::make($file->getRealPath())->orientate();
            $image_resize->resize(256, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $image_resize->resizeCanvas(256, 256);
            $path_small = "$dir/".date('F').date('Y').'/'.$filename_small;
            $image_resize->save(public_path('../storage/app/public/'.$path_small));

            return $imagen;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
