@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">{{ config("tablecolumns.bills.icon") }}</i>
                        </div>
                        <h4 class="card-title card-inline">Bill(s)</h4>
                        <a href="{{route('batch.upload')}}" class="btn btn-link btn-primary pull-right"><i class="material-icons">cloud_upload</i> Batch Upload</a>
                        <a href="{{route('bills.create')}}" class="btn btn-link btn-primary pull-right"><i class="material-icons">note_add</i> New Bill</a>
                    </div>

                    <div class="card-body table-responsive">

                        <table id="datatables" class="table table-striped table-no-bordered table-hover display"
                               cellspacing="0" width="100%" style="width:100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="2%">#</th>
                                <th>Entity</th>
                                <th>Vendor Code</th>
                                <th>Vendor Name</th>
                                <th>Bill Number</th>
                                <th class="text-center">Bill Date</th>
                                <th class="text-right">Total Before Tax</th>
                                <th class="text-right">Tax</th>
                                <th class="text-right">Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bills as $key => $bill)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $bill->entity->name }}</td>
                                    <td>{{ $bill->vendor_code }}</td>
                                    <td>{{ $bill->vendor_name }}</td>
                                    <td>{{ $bill->bill_number }}</td>
                                    <td class="text-center">{{ formatDate($bill->bill_date) }}</td>
                                    <td class="text-right">{{ formatCurrency($bill->total_before_tax) }}</td>
                                    <td class="text-right">{{ formatCurrency($bill->tax) }}</td>
                                    <td class="text-right">{{ formatCurrency($bill->total) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('bills.edit', $bill) }}">Edit</a>
                                    </td>
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
