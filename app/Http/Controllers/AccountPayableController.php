<?php

namespace App\Http\Controllers;

use App\Entity;
use App\AccountPayable;
use Illuminate\Http\Request;

class AccountPayableController extends Controller
{
    private $autoform;

    public function __construct()
    {
        $this->autoform = config("tablecolumns.account_payables");
    }

    public function index()
    {
        $account_payables = AccountPayable::orderBy("payment_date", "desc")->orderBy("bill_id", "desc")->get();

        return view('account_payables.index', compact('account_payables'));
    }

    public function create()
    {
        $autoform = $this->autoform();

        $input = new AccountPayable;
        $input->entity_id = session('entity', 0);

        $action = "store";

        return view('account_payables.form', compact('autoform', 'input', 'action'));
    }

    public function store(Request $request)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $ap = AccountPayable::create($request->only(['bill_id', 'payment_amount', 'payment_date']));
        $ap->entity()->associate($entity);
        $ap->save();

        return redirect()->route('account_payables.index')->withSuccess('New account payable has been created.');
    }

    public function edit($id)
    {
        $autoform = $this->autoform();
        $input = AccountPayable::find($id);
        $action = "update";

        return view('account_payables.form', compact('autoform', 'input', 'action'));
    }

    public function update(Request $request, $id)
    {
        if ($request->filled('entity_id')) {
            $entity = Entity::find($request->input('entity_id'));
        }

        $ap = AccountPayable::find($id);
        $ap->update($request->only(['bill_id', 'payment_amount', 'payment_date']));
        $ap->entity()->associate($entity);
        $ap->save();

        return redirect()->route('account_payables.index')->withSuccess('Account payable for bill '.$request->get('bill_id').' has been updated.');
    }

    public function destroy($id)
    {
        dd($id);
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
