<?php

namespace App\Http\Controllers\Helpers;

class UploadHelper {
     public static function upload($image = './assets/images/avatar_image.png') {
$x=1;
        if($image == '' || !file_exists('uploads/'.$image)){
            $image = './assets/images/avatar_image.png';
            $x=0;
        }
      
        $html = file_get_contents(__DIR__ . '/uploader.html');
        if($x==1){
         $html = str_replace('{input}', '<input type="hidden" name="image" id="image_input" value="'.$image.'"  />', $html);   
        }else{
          $html = str_replace('{input}', '<input type="hidden" name="image" id="image_input" value=""  />', $html);  
        }
        $html = str_replace('profile_picture', 'uploads/'.$image, $html);
       
      

        return $html;
    }
}