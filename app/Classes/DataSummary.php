<?php
namespace App\Classes;

class DataSummary
{
    private $data;

    public function __construct()
    {
        $this->data = config("sampledata");
    }

    public function get($summary)
    {
        if(method_exists($this, $summary)){
            return $this->$summary();
        }

        return $this->data;
    }

    private function sales()
    {
        $sales = $this->data["sales"];
        $result["daily"] = $sales["todate"][date("D")];
        $result["weekly"] = array_sum($sales["todate"]);
        $result["monthly"] = $sales[date("Y")][date("n")] + $result["weekly"];
        $result["yearly"] = array_sum($sales[date("Y")]) + $result["weekly"];

        $lastYearSum = 0;
        foreach($sales[date("Y")-1] as $month=>$amt){
            if($month <= date("n")){
                $lastYearSum += $amt;
            }
        }

        $result["last-year"] = array_sum($sales[date("Y")-1]);
        $result["last-month"] = $sales[date("Y")][date("n")-1];
        $result["last-year-month"] = $sales[date("Y")-1][date("n")];
        $result["last-year-todate"] = $lastYearSum - $result["weekly"];
        $result["week"] = $sales["todate"];
        $sales[date("Y")][date("n")] += $result["weekly"];
        $result["this-year-monthly-sales"] = $sales[date("Y")];
        $result["last-year-monthly-sales"] = $sales[date("Y")-1];

        return $result;
    }

    private function purchases()
    {
        $purchases = $this->data["purchases"];
        $result["daily"] = $purchases["todate"][date("D")];
        $result["weekly"] = array_sum($purchases["todate"]);
        $result["monthly"] = $purchases[date("Y")][date("n")] + $result["weekly"];
        $result["yearly"] = array_sum($purchases[date("Y")]) + $result["weekly"];
        $result["week"] = $purchases["todate"];

        return $result;
    }

    private function cash_in()
    {
        $casin = $this->data["cash-in"];
        $result["daily"] = $casin["todate"][date("D")];
        $result["weekly"] = array_sum($casin["todate"]);
        $result["monthly"] = $casin[date("Y")][date("n")] + $result["weekly"];
        $result["yearly"] = array_sum($casin[date("Y")]) + $result["weekly"];
        $result["week"] = $casin["todate"];

        return $result;
    }

    private function cash_out()
    {
        $casout = $this->data["cash-out"];
        $result["daily"] = $casout["todate"][date("D")];
        $result["weekly"] = array_sum($casout["todate"]);
        $result["monthly"] = $casout[date("Y")][date("n")] + $result["weekly"];
        $result["yearly"] = array_sum($casout[date("Y")]) + $result["weekly"];
        $result["week"] = $casout["todate"];

        return $result;
    }
}
?>
