@extends('layouts.material')

@section('content')
    <div class="container-fluid" >
        <div class="header text-center">
            <h3 class="title">Evaluation for {{ date("F Y", strtotime($evaluation->code."-01")) }}</h3>
            <p class="category">
                Please make sure all the neccessary documents have been uploaded
            </p>
            <small class="text-muted"><a href="{{ url('evaluation') }}">&lt;&lt; Back to list</a></small>
        </div>

        @include('layouts.messages')

        <div class="row">
            <div class="col-md-6">
                @include('evaluation.form_upload_sales_invoice')
            </div>

            <div class="col-md-6">
                @include('evaluation.form_upload_ar_payment')
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @include('evaluation.form_upload_purchases')
            </div>

            <div class="col-md-6">
                @include('evaluation.form_upload_ap_payment')
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .card-title i.material-icons{
        font-size:16px;
    }
</style>
@endpush
