<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Classes\DataSummary;

class DashboardController extends Controller
{
    public function sample()
    {
        $ds = new DataSummary;
        $sales = $ds->get("sales");
        $purchases = $ds->get("purchases");
        $cashin = $ds->get("cash_in");
        $cashout = $ds->get("cash_out");

        return view('prototypes.dashboard', compact('sales', 'purchases', 'cashin', 'cashout'));
    }
}
