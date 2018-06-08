<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    private $autoform;

    public function __construct()
    {
        $this->autoform = config("tablecolumns.invoices");
    }

    public function index()
    {
        $invoices = Invoice::orderBy("invoice_date", "desc")->orderBy("invoice_number", "desc")->get();

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $autoform = $this->autoform();

        $input = new Invoice;
        $input->entity_id = session('entity', 0);

        $action = "store";

        return view('invoices.form', compact('autoform', 'input', 'action'));
    }

    public function store(Request $request)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $invoice = Invoice::create($request->only(['customer_code', 'customer_name', 'invoice_number', 'invoice_date', 'total_before_tax', 'tax', 'total']));
        $invoice->entity()->associate($entity);
        $invoice->save();

        return redirect()->route('invoices.index')->withSuccess('New invoice has been created.');
    }

    public function edit($id)
    {
        $autoform = $this->autoform();
        $input = Invoice::find($id);
        $action = "update";

        return view('invoices.form', compact('autoform', 'input', 'action'));
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $invoice = Invoice::find($id);
        $invoice->update($request->only(['customer_code', 'customer_name', 'invoice_number', 'invoice_date', 'total_before_tax', 'tax', 'total']));
        $invoice->entity()->associate($entity);
        $invoice->save();

        return redirect()->route('invoices.index')->withSuccess('Invoice '.$request->get('invoice_number').' has been updated.');
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
