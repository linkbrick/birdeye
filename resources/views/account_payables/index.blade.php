@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">{{ config("tablecolumns.account_payables.icon") }}</i>
                        </div>
                        <h4 class="card-title card-inline">Account Payable(s)</h4>
                        <a href="{{route('batch.upload')}}" class="btn btn-link btn-primary pull-right"><i class="material-icons">cloud_upload</i> Batch Upload</a>
                        <a href="{{route('account_payables.create')}}" class="btn btn-link btn-primary pull-right"><i class="material-icons">note_add</i> New Account Payable</a>
                    </div>
                    <div class="card-body table-responsive">

                        <table id="datatables" class="table table-striped table-no-bordered table-hover display"
                               cellspacing="0" width="100%" style="width:100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="2%">#</th>
                                <th>Entity</th>
                                <th>Bill ID</th>
                                <th class="text-center">Payment Date</th>
                                <th class="text-right">Payment Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($account_payables as $key => $account_payable)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $account_payable->entity->name }}</td>
                                    <td>{{ $account_payable->bill_id }}</td>
                                    <td class="text-center">{{ formatDate($account_payable->payment_date) }}</td>
                                    <td class="text-right">{{ formatCurrency($account_payable->payment_amount) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('account_payables.edit', $account_payable) }}">Edit</a>
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
