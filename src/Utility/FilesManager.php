<?php

namespace App\Utility;

use Cake\Core\Exception\Exception;

class FilesManager
{

    /**
     * @param $file_request represents the file sending by request
     * @param $destination represents the folder where has saved the file
     * @return string
     */
    public function uploadFiles($file_request = null, $destination = null)
    {

        try{
            $new_name = $file_request['name']. date("F j, Y, g:i a");
            $name_sha = hash('sha256' , $new_name) . '_' . $file_request['name'];
            if (move_uploaded_file($file_request['tmp_name'], $destination.$name_sha)) {
                return $name_sha;
            }
            return false;

        } catch (Exception $e){
            return false;
        }
        return false;
    }
}
