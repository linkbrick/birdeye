@extends('layouts.material')

@section('content')
    <div class="container-fluid" >
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-rose card-header-text" data-background-color="primary">
                        <div class="card-text">
                            <h4 class="card-title">Upload Excel</h4>
                        </div>
                    </div>

                    <div class="card-body ">
                        <form method="post" class="form-horizontal" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <a href="{{ url('template-sales-invoice') }}" target="_blank">Download template here</a>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-sm-2 col-form-label">Sales Invoice Excel</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file_salesInvoice" class="form-control">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2 offset-sm-10">
                                    <input type="submit" value="Upload" class="btn btn-rose">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
