@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">{{ config("tablecolumns.account_receivables.icon") }}</i>
                        </div>
                        <h4 class="card-title card-inline">Account Receivable(s)</h4>
                        <a href="{{route('batch.upload')}}" class="btn btn-link btn-primary pull-right"><i class="material-icons">cloud_upload</i> Batch Upload</a>
                        <a href="{{route('account_receivables.create')}}" class="btn btn-link btn-primary pull-right"><i class="material-icons">note_add</i> New Account Receivable</a>
                    </div>
                    <div class="card-body table-responsive">

                        <table id="datatables" class="table table-striped table-no-bordered table-hover display"
                               cellspacing="0" width="100%" style="width:100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="2%">#</th>
                                <th>Entity</th>
                                <th>Invoice ID</th>
                                <th class="text-center">Payment Date</th>
                                <th class="text-right">Payment Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($account_receivables as $key => $account_receivable)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $account_receivable->entity->name }}</td>
                                    <td>{{ $account_receivable->invoice_id }}</td>
                                    <td class="text-center">{{ formatDate($account_receivable->payment_date) }}</td>
                                    <td class="text-right">{{ formatCurrency($account_receivable->payment_amount) }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('account_receivables.edit', $account_receivable) }}">Edit</a>
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
