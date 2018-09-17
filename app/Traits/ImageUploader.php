<?php

namespace App\Traits;

trait ImageUploader {
    /**
     * @param \Illuminate\Http\File $file
     * return $name File after Upload
     */
    public function uploadImage($file = null){
        $nameFile = $file->getFilename();

        $ext = $file->getClientOriginalExtension();

        $size = $file->getSize();


        $name = \Webpatser\Uuid\Uuid::generate()->string.'.'.$ext;

        if($file->storeAs('/', $name, ['disk'=>'google'])){
            return $name;
        }

    }

    protected function getDisk($name = 'google'){
        return $name;
    }

    protected function getStorage(){
        return \Illuminate\Support\Facades\Storage::disk($this->getDisk());
    }
}