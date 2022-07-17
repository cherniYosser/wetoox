<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class UploadsController extends Controller
{
    static public function upload($file , $fit='476,248' , $imgpath , $imgsizeh , $imgsizew ){

        if(Input::file()){
            
            $image = Input::file($file);

            $filename  = time() . '.' . $image->getClientOriginalExtension();

            $path = public_path($imgpath . $filename);
            
            $image = Image::make($image->getRealPath())->resize($imgsizeh ,$imgsizew);

            if(!empty($fit)){
                $image->fit($fit);
            }
            
            $image->save($path, 80);

            return $filename;
        }
    }

}
