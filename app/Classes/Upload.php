<?php
namespace App\Classes;

use App\Upload as uploadModel;
// use Illuminate\Support\Facades\Storage;

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

        self::_save_to_disk($file, $directory, $system_file_name);

        // clear previous uploaded record
        self::delete([
                        "evaluation_id" => $param["evaluation_id"],
                        "category" => $param["model"]
                    ]);

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

    static function delete($param){
        if(is_array($param))
        {
            $toDelete = [];
            $up = new uploadModel;
            foreach($param as $key=>$val){
                $up = $up->where($key, $val);
            }

            $files = $up->get();

            foreach($files as $file){
                $toDelete[] = "$file->location/$file->system_name";
            }

            $up->delete();
        }
        else
        {
            $toDelete = "";
            $file = uploadModel::find($param);
            $toDelete = "$file->location/$file->system_name";
            $file->delete();
        }

        // delete actual file on disk
        \File::delete($toDelete);
    }

    private static function _save_to_disk($file, $directory, $filename){
        $file->move($directory, $filename);
    }
}
?>
