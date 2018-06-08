@extends('layouts.tenant')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header card-header-primary card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">{{ config("tablecolumns.account_payables.icon") }}</i>
                    </div>
                    <h4 class="card-title card-inline">Account Payable</h4>
                    <a href="{{ route('account_payables.index') }}" class="btn btn-link btn-primary pull-right">&lt;&lt; Back to list</a>
                </div>
                <div class="card-body ">
                    <form id="AccountPayableForm" method="post" action="{{ route('account_payables.'.$action, $input) }}">
                        {{ csrf_field() }}
                        @if($action == 'store')
                        {{ method_field('POST') }}
                        @elseif($action == 'update')
                        {{ method_field('PUT') }}
                        @endif
                        @include('layouts.form')
                        <button class="btn btn-fill btn-primary" id="btnNewEntity">
                            @if($action == 'store')
                            Create
                            @elseif($action == 'update')
                            Update
                            @endif
                        </button>
                        @if($action == 'update')
                        <!-- <button type="button" class="btn btn-fill btn-danger" id="btnDeleteRecord" onclick="$('#delete_modal').modal()">Delete</button> -->
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if($action == 'update')
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="birdeye" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="material-icons">clear</i>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <form method="post" action="{{ route('account_payables.destroy', $input) }}">
                        {{ method_field('DELETE') }}
                        <div class="swal2-icon swal2-warning pulse-warning" style="display: block;">!</div>
                        <h3><b>Are you sure to delete this record?</b></h3>
                        <button class="btn btn-danger">Yes, delete it!</button>
                        <button type="button" class="btn btn-info" data-dismiss="modal">No, keep it</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  End Modal -->
@endif
@endsection
