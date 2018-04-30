<?php
namespace App\Classes;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ExcelTemplateExport implements FromCollection, WithHeadings, WithColumnFormatting
{
    private $model, $columns;

    public function __construct($model){
        $this->model = $model;
        $table_name = $model->getTable();
        $this->columns = array_keys(config("tablecolumns.$table_name"));
    }

    public function collection(){
        // $empty_rows = [];
        // for($i=0; $i<100; $i++){
        //     foreach($this->columns as $col){
        //         $empty_rows[$i][$col] = 'test';
        //     }
        // }
        return collect([]);
    }

    public function headings(): array
    {
        return $this->columns;
    }

    public function columnFormats(): array
    {
        return [
            // 'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}

?>
