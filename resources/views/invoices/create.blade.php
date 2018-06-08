@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">{{ config("tablecolumns.invoices.icon") }}</i>
                        </div>
                        <h4 class="card-title">Invoice</h4>
                    </div>
                    <div class="card-body ">
                        <form id="newInvoice" method="post" action="{{ route('invoices.store') }}">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Entity </label>
                                        <select id="entity_id" name="entity_id" class="selectpicker" data-style="select-with-transition"
                                                title="Please select a entity" data-size="7"  data-live-search="true">
                                            <option value="0">Please select a corporate</option>
                                            @foreach($entities as $ekey => $evalue)
                                                <option value="{{ $evalue->id }}"
                                                    @if($evalue->id == session('entity', 0))
                                                    selected
                                                    @endif
                                                >{{ $evalue->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Customer Code
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="customer_code" class="form-control" required="true" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Customer Name
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="customer_name" class="form-control" required="true" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Invoice Number
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="invoice_number" class="form-control" required="true" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Invoice Date
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="invoice_date" class="form-control datepicker" required="true" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Total Before Tax
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="total_before_tax" class="form-control" required="true" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Tax
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="tax" class="form-control" required="true" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Total
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="total" class="form-control" required="true" >
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-fill btn-primary" id="btnNewEntity">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            Setting.initFormExtendedDatetimepickers();
        });
    </script>
@endpush
