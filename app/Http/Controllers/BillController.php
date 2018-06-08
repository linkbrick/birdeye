<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    private $autoform;

    public function __construct()
    {
        $this->autoform = config("tablecolumns.bills");
    }

    public function index()
    {
        $bills = Bill::orderBy("bill_date", "desc")->orderBy("bill_number", "desc")->get();

        return view('bills.index', compact('bills'));
    }

    public function create()
    {
        $autoform = $this->autoform();

        $input = new Bill;
        $input->entity_id = session('entity', 0);

        $action = "store";

        return view('bills.form', compact('autoform', 'input', 'action'));
    }

    public function store(Request $request)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $bill = Bill::create($request->only(['vendor_code', 'vendor_name', 'bill_number', 'bill_date', 'total_before_tax', 'tax', 'total']));
        $bill->entity()->associate($entity);
        $bill->save();

        return redirect()->route('bills.index')->withSuccess('New bill has been created.');
    }

    public function edit($id)
    {
        $autoform = $this->autoform();
        $input = Bill::find($id);
        $action = "update";

        return view('bills.form', compact('autoform', 'input', 'action'));
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $bill = Bill::find($id);
        $bill->update($request->only(['vendor_code', 'vendor_name', 'bill_number', 'bill_date', 'total_before_tax', 'tax', 'total']));
        $bill->entity()->associate($entity);
        $bill->save();

        return redirect()->route('bills.index')->withSuccess('Bill '.$request->get('bill_number').' has been updated.');
    }

    private function autoform()
    {
        $entities = Entity::all();
        $model[0] = "Please select a corporate";
        foreach($entities as $entity)
        {
            $model[$entity->id] = $entity->name;
        }

        $new = [
            "label" => "Entity",
            "name" => "entity_id",
            "type" => "select",
            "attr" => ["title"=>"Please select a entity"],
            "model" => $model
        ];

        $this->autoform["columns"] = array_merge([$new], $this->autoform["columns"]);
        return $this->autoform;
    }
}
