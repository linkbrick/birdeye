<?php
namespace App\Classes;

class ExcelValidateData
{
    public static function run($data, $table_name){
        $cols = config("tablecolumns.".$table_name.".columns");
        $result["error"] = false;
        $result["columns"] = [];
        $result["not_found"] = [];

        foreach($cols as $key=>$col){
            $col_name = $col["name"];
            // if expected column does not exist
            if(!isset($data->$col_name)){
                $result["error"] = true;
                $result["not_found"][] = $col_name;
                continue;
            }

            $is_valid = self::_check(
                $col["type"],
                $data->$col_name
            );

            // if data format input is invalid
            if(!$is_valid){
                $result["error"] = true;
                $result["columns"][] = $col_name;
            }
        }

        return (object) $result;
    }

    private static function _check($datatype, $val){
        switch($datatype){
            case "decimal": case "integer":
                if(is_numeric($val)) return true;
            break;

            case "date":
                $date = $val;
                if(is_object($val)){
                    $date = $date->toDateString();
                }

                if(self::_validateDate($date)) return true;
            break;

            default:
                return true;
        }

        return false;
    }

    private static function _validateDate($date, $format = 'Y-m-d'){
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}

?>
