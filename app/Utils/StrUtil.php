<?php

if(!function_exists('uploadFile')) {
    function uploadFile($file, $path) {
        $img_name = $file->hashName();
        return $file->move(public_path($path), $img_name) ? $path . '/' .$img_name : false;
    }
}

