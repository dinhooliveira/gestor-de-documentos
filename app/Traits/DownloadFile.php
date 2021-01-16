<?php
namespace App\Traits;

trait DownloadFile{
    function downloadFile($name,$file_location,$extension){
        header("Content-disposition: attachment; filename={$name}.{$extension}");
        header("Content-type: application/{$extension}");
        readfile("{$file_location}");
    }
}