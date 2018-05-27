<?php
namespace App\Classes;

class Upload{
    public function upload($file=null){
        if (!($file->isValid())) {
            header("HTTP/1.0 400 Bad Request");
            header('Content-type: text/plain');
            echo "Broken file";
            exit;
        }

        $file_ext =  strtolower($file->getClientOriginalExtension());
        $system_file_name = md5(strtotime("now")).uniqid().".".$file_ext;
        $folder = date("Y/m/d");
        $directory = 'upload/payment/'.$folder;

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if(!in_array($file_ext, ["xls", "jpeg", "gif", "png", "tiff", "pdf", "txt"])){
            header("HTTP/1.0 400 Bad Request");
            header('Content-type: text/plain');
            echo "Unsupported file type";
            exit;
        }

        $file->move($directory, $system_file_name);

        return ["file"=>$directory."/".$system_file_name];
    }
}
?>
