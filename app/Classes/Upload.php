<?php
namespace App\Classes;

use App\Upload as uploadModel;

class Upload{
    private static $extension_allowed = [
        'excel' => ["xls", "xlsx", "csv"],
    ];

    static function save($file=null, $param, $filetype="excel"){
        if (!($file->isValid())) {
            abort(415);
        }

        $file_name = $file->getClientOriginalName();
        $file_ext =  strtolower($file->getClientOriginalExtension());
        $system_file_name = md5(strtotime("now")).uniqid().".".$file_ext;
        $file_size = $file->getClientSize();
        $folder = date("Y/m/d");
        $directory = "upload/".$param["model"]."/".$folder;

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if(!in_array($file_ext, self::$extension_allowed[$filetype])){
            abort(415);
        }

        $file->move($directory, $system_file_name);

        $upload = new uploadModel;
        $upload->account_code = $param["account_code"];
        $upload->evaluation_id = $param["evaluation_id"];
        $upload->category = $param["model"];
        $upload->location = $directory;
        $upload->file_name = $file_name;
        $upload->system_name = $system_file_name;
        $upload->file_type = $file_ext;
        $upload->file_size = $file_size;
        $upload->save();

        return ["id"=>$upload->id, "location"=>$directory."/".$system_file_name];
    }
}
?>
