<?php
namespace App\Classes;

class Upload{
    private static $extension_allowed = [
        'excel' => ["xls", "xlsx", "csv"],
    ];

    static function save($file=null, $destination, $filetype="excel"){
        if (!($file->isValid())) {
            abort(415);
        }

        $file_ext =  strtolower($file->getClientOriginalExtension());
        $system_file_name = md5(strtotime("now")).uniqid().".".$file_ext;
        $folder = date("Y/m/d");
        $directory = "upload/$destination/".$folder;

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        if(!in_array($file_ext, self::$extension_allowed[$filetype])){
            abort(415);
        }

        $file->move($directory, $system_file_name);

        return $directory."/".$system_file_name;
    }
}
?>
