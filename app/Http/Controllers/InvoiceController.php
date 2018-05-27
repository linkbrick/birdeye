<?php

namespace App\Http\Controllers;

use App\Entity;
use App\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $entities = Entity::all();
        return view('invoices.create', compact('entities'));
    }

    public function store(Request $request)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $invoice = Invoice::create($request->only(['customer_code', 'customer_name', 'invoice_number', 'invoice_date', 'total_before_tax', 'tax', 'total']));
        $invoice->entity()->associate($entity);
        $invoice->save();

        return redirect()->route('invoices.index')->withSuccess('Invoice has been created.');

    }
}
