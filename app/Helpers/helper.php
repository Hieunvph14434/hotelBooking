<?php
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

// set default image 
if(!function_exists('defaultImage')){
    function defaultImage() {
        return 'assets/default-avatar.jpg';
    }
}

// check exist image
if(!function_exists('checkIssetImage')){
    function checkIssetImage ($req, $data=['image'=>'', 'prefixName'=>'', 'folder'=>'', 'imageOld'=>'']) {
        $dataImage = $data['imageOld'] ? $data['imageOld'] : defaultImage();
        if($req->hasFile($data['image'])){
            if('' !== $data['imageOld'] && ! is_null($data['imageOld'])) {
                deleteFile($data['imageOld']);
            }
            $file = $req->file($data['image']);
            $dataImage = fileUpload($file, $data['prefixName'], $data['folder']);
        }
        if($req['tmp_image'] && $req['origin_name'] !== null){
            $publicId = time() . '_' .$req['origin_name'];
            $from = $req['tmp_image'];
            $to = $data['folder'] . '/' . $publicId;
            $dataImage = moveImage($from, $to);
        }
        return $dataImage;
    }
}

// save file
if(!function_exists('fileUpload')){
    function fileUpload ($file, $prefixName = '', $folder = ''){
        $fileName = pathinfo($file->hashName(), PATHINFO_FILENAME);
        $fileName = $prefixName
        ? $prefixName.'_'.$fileName
        : time() .'_'.$fileName;
        $result = $file->storeOnCloudinaryAs($folder, $fileName);
        return $result->getPublicId();
    }
}

// delete file in storage
if(!function_exists('deleteFile')){
    function deleteFile ($publicId) {
        $getUrl = getImageUrl($publicId); 
        if($getUrl) {
            Cloudinary::destroy($publicId);
        }
    }
}

// get url image 
if(!function_exists('getImageUrl')) {
    function getImageUrl($publicId) {
        return Cloudinary::getUrl($publicId);
    }
}

// move an asset from one folder to another
if(!function_exists('moveImage')) {
    function moveImage($from, $to) {
        Cloudinary::rename($from, $to);
        return $to;
    }
}

if(!function_exists('oldOValue')) {
    function oldOValue($field, $currentField, $errors)
    {
        return $errors->any() ? old($field) : $currentField;
    }
}