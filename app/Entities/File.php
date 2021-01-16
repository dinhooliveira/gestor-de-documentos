<?php

namespace App\Entities;

use CodeIgniter\Entity;

class File extends Entity
{
    function customer(){
        $customer = new \App\Models\CustomerModel();
        return $customer->find($this->customer_id);
    }

    function userDownloadHistory(){
        $userDownloadHistory = new  \App\Models\UserDownloadHistoryModel();
        return $userDownloadHistory->where("file_id",$this->id)->findAll();
    }

    function customerDownloadHistory(){
        $customerDownloadHistory = new  \App\Models\CustomerDownloadHistoryModel();
        return $customerDownloadHistory->where("file_id",$this->id)->findAll();
    }

    function user(){
        $user = new \App\Models\UserModel();
        return $user->find($this->user_id);
    }

    function getCreatedAt($lang=null){
         return  \Util::formatDate($lang,$this->attributes['created_at']);
    }

    function getUpdatedAt($lang=null){
        return   \Util::formatDate($lang,$this->attributes['updated_at']);
    }
}
