<?php
namespace App\Classes;

use Excel;

class ExcelExport
{
    private static $table_name, $data;

    public static function template($model){
        self::$table_name = $model->getTable();

        // get table columns
        $data = array_map(
                    "self::_rename",
                    array_keys(config("tablecolumns.".self::$table_name))
                );

        self::$data = $data;
        self::_export();
    }

    public static function data($model){
        // self::$data = $model->toArray();
        // self::_export();
    }

    public static function _export(){
        $data = self::$data;
        $format = self::_column_format();

        // export template
        Excel::create(self::_rename(self::$table_name), function($excel) use ($data, $format){
            $excel->sheet("Sheet1", function($sheet) use ($data, $format){
                // dump rows from array
                $sheet->fromArray($data);

                // style row 1 (header)
                $sheet->row(1, function($row) {
                    $row->setBackground('#333333');
                    $row->setFontColor('#ffffff');
                    $row->setFontWeight('bold');
                });

                // format column
                $sheet->setColumnFormat($format);

                $sheet->freezeFirstRow();
            });
        })->export('xlsx');
    }

    private static function _column_format(){
        $col_count = 1;
        $format = [];
        $cols = config("tablecolumns.".self::$table_name);

        foreach($cols as $key=>$col){
            $_f = self::_format_string(\Schema::getColumnType(self::$table_name, $col));

            if($_f != ""){
                $format[self::_column_letter($col_count)] = $_f;
            }

            $col_count++;
        }

        return $format;
    }

    private static function _column_letter($c){
        $c = intval($c);
        if ($c <= 0){
            return '';
        }

        $letter = '';

        while($c != 0){
            $p = ($c - 1) % 26;
            $c = intval(($c - $p) / 26);
            $letter = chr(65 + $p) . $letter;
        }

        return $letter;
    }

    private static function _format_string($type){
        switch($type){
            case "string":
                return "";
            break;

            case "decimal":
                return "0.0000";
            break;

            case "date":
                return "yyyy-mm-dd";
            break;

            default:
                return "";
        }
    }

    private static function _rename($v){
        return ucwords(str_replace("_", " ", $v));
    }
}

?>
