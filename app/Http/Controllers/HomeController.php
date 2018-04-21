<?php

namespace App\Http\Controllers;

use App\CollectionNote;
use App\ReceivedNote;
use App\ReleaseNote;
use App\ReturnedNote;
use App\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Bouncer;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if(Bouncer::is($user)->an('account')){
            return redirect()->route('homes.account');
        }elseif(Bouncer::is($user)->an('manager')){
            return redirect()->route('homes.manager');
        }elseif(Bouncer::is($user)->an('operation')){
            return redirect()->route('homes.operation');
        }else{
            return view('errors.role_not_defined');
        }
    }

    public function accountView()
    {
        $release_notes = ReleaseNote::all();
        $receive_notes = ReceivedNote::all();
        $returned_notes = ReturnedNote::all();
        $collection_notes = CollectionNote::all();
        $sales_orders = SalesOrder::all();
        return view('homes.account',compact('release_notes','receive_notes','returned_notes','collection_notes','sales_orders'));
    }

    public function operationView()
    {
        return view('homes.manager');
    }

    public function managerView()
    {
        return view('homes.manager');
    }
}
