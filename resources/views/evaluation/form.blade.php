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
                <div class="card">
                    <div class="card-header card-header-rose card-header-text" data-background-color="primary">
                        <div class="card-text">
                            <h4 class="card-title">Sales Invoice</h4>
                        </div>
                    </div>

                    <div class="card-body ">
                        <form method="post" action="{{ url('evaluation/'.$evaluation->id) }}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="_category" value="sales_invoice" />

                            @if($invoice)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group has-default">
                                        <a href="{{ url('evaluation/download/'.$invoice->id) }}" target="_blank">
                                            <b>{{ $invoice->file_name }}</b>
                                        </a>
                                        <small class="text-muted font-italic">was uploaded on {{ date("d F Y, g:ia", strtotime($invoice->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ url('template/sales-invoice') }}" target="_blank">Download Sales Invoice template here</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="file" name="file_sales_invoice" class="form-control">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" value="@if(!$invoice) {{ 'Upload' }} @else {{ 'Replace File' }} @endif" class="btn btn-rose">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-rose card-header-text" data-background-color="primary">
                        <div class="card-text">
                            <h4 class="card-title">AR Payment</h4>
                        </div>
                    </div>

                    <div class="card-body ">
                        <form method="post" action="{{ url('evaluation/'.$evaluation->id) }}" class="form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" />
                            <input type="hidden" name="_category" value="payments" />

                            @if($payment)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group has-default">
                                        <a href="{{ url('evaluation/download/'.$payment->id) }}" target="_blank">
                                            <b>{{ $payment->file_name }}</b>
                                        </a>
                                        <small class="text-muted font-italic">was uploaded on {{ date("d F Y, g:ia", strtotime($payment->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endif

                            <div class="row">
                                <div class="col-sm-12">
                                    <a href="{{ url('template/payments') }}" target="_blank">Download AR Payment template here</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="file" name="file_payments" class="form-control">
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col-sm-12">
                                    <input type="submit" value="@if(!$payment) {{ 'Upload' }} @else {{ 'Replace File' }} @endif" class="btn btn-rose">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
