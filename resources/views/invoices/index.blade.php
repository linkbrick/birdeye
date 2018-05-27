@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title" style="display:inline">Invoice(s)
                        </h4>
                        <a href="{{route('invoices.create')}}" class="btn btn-link btn-primary pull-right">New Invoice</a>
                    </div>
                    <div class="card-body ">

                        <table id="datatables" class="table table-striped table-no-bordered table-hover display"
                               cellspacing="0" width="100%" style="width:100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="2%">#</th>
                                <th>Entity</th>
                                <th>Customer Code</th>
                                <th>Customer Name</th>
                                <th>Invoice Number</th>
                                <th class="text-center">Invoice Date</th>
                                <th class="text-right">Total Before Tax</th>
                                <th class="text-right">Tax</th>
                                <th class="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invoices as $key => $invoice)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $invoice->entity->name }}</td>
                                    <td>{{ $invoice->customer_code }}</td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td class="text-center">{{ formatDate($invoice->invoice_date) }}</td>
                                    <td class="text-right">{{ formatCurrency($invoice->total_before_tax) }}</td>
                                    <td class="text-right">{{ formatCurrency($invoice->tax) }}</td>
                                    <td class="text-right">{{ formatCurrency($invoice->total) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
