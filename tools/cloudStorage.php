<?php
require_once "vendor/autoload.php";
 
use Google\Cloud\Storage\StorageClient;
 

function uploadImage(string $bucketName, string $id, string $source): void
{
    $imageName = $id . ".jpg";
    $storage = new StorageClient(['projectId' => 'a1-task1-s3778046']);
    $file = fopen($source, 'r');
    $bucket = $storage->bucket($bucketName);
    $object = $bucket->upload($file, [
        'name' => $imageName,
    ]);
}

function getImage($bucketName, $id) {
    $imageUrl = "https://storage.cloud.google.com/" . $bucketName . "/" . $id . ".jpg";
    // echo $imageUrl;
    return $imageUrl;
}
