<?php 

namespace App\Classes;

use App\Events\ModelEvent;

class Helpers
{

    public static function uploadImage($inFile, $inPath){
        if($inFile){
            $fileName = (bin2hex(openssl_random_pseudo_bytes(13))).'.'.$inFile->getClientOriginalExtension();
            $inFile->move($inPath, $fileName);
            return $inPath."/".$fileName;
        }
        return null;
    }
}