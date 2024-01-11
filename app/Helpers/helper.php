<?php

// set default image 

use Cloudinary\Api\Exception\ApiError;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;

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
            $sourcePath = $req['tmp_image'];
            $destinationPath = $data['folder'] . '/';
            $newFileName = $req['origin_name'];
            $dataImage = $destinationPath . $newFileName;
            Storage::move($sourcePath, $dataImage);
        }
        return $dataImage;
    }
}

// save file
if(!function_exists('fileUpload')){
    function fileUpload ($file, $prefixName = '', $folder = ''){
        $fileName = $file->hashName();
        $fileName = $prefixName
        ? $prefixName.'_'.$fileName
        : time() .'_'.$fileName;
        $result = $file->storeOnCloudinaryAs($folder, pathinfo($fileName, PATHINFO_FILENAME));
        return $result->getSecurePath();
    }
}

// delete file in storage
if(!function_exists('deleteFile')){
    function deleteFile ($dataImage) {
        $publicId = pathinfo(parse_url($dataImage, PHP_URL_PATH), PATHINFO_FILENAME);
        try {
            // Use the Cloudinary Laravel integration to delete the image
            Cloudinary::destroy($publicId);

            return "Image deleted from Cloudinary!";
        } catch (ApiError $e) {
            // Check if the error indicates that the resource doesn't exist
            if (strpos($e->getMessage(), 'No such file or directory') !== false) {
                return "Image does not exist on Cloudinary.";
            } else {
                // Handle other API errors
                return "Error deleting image: " . $e->getMessage();
            }
        }
    }
}