<?php

namespace App\Http\Controllers;

use App\Entity;
use App\AccountReceivable;
use Illuminate\Http\Request;

class AccountReceivableController extends Controller
{
    private $autoform;

    public function __construct()
    {
        $this->autoform = config("tablecolumns.account_receivables");
    }

    public function index()
    {
        $account_receivables = AccountReceivable::orderBy("payment_date", "desc")->orderBy("invoice_id", "desc")->get();

        return view('account_receivables.index', compact('account_receivables'));
    }

    public function create()
    {
        $autoform = $this->autoform();

        $input = new AccountReceivable;
        $input->entity_id = session('entity', 0);

        $action = "store";

        return view('account_receivables.form', compact('autoform', 'input', 'action'));
    }

    public function store(Request $request)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $ar = AccountReceivable::create($request->only(['invoice_id', 'payment_amount', 'payment_date']));
        $ar->entity()->associate($entity);
        $ar->save();

        return redirect()->route('account_receivables.index')->withSuccess('New account receivable has been created.');
    }

    public function edit($id)
    {
        $autoform = $this->autoform();
        $input = AccountReceivable::find($id);
        $action = "update";

        return view('account_receivables.form', compact('autoform', 'input', 'action'));
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $ar = AccountReceivable::find($id);
        $ar->update($request->only(['invoice_id', 'payment_amount', 'payment_date']));
        $ar->entity()->associate($entity);
        $ar->save();

        return redirect()->route('account_receivables.index')->withSuccess('Account receivable for invoice '.$request->get('invoice_id').' has been updated.');
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
