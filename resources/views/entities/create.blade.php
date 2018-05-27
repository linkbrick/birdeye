@extends('layouts.tenant')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <h4 class="card-title">Entity</h4>
                    </div>
                    <div class="card-body ">
                        <form id="newCompany" method="post" action="{{ route('entities.store') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="form-group label-floating ">
                                <label class="control-label">Name
                                    <small>*</small>
                                </label>
                                <input type="text" name="name" class="form-control" required="true">
                            </div>
                            <button class="btn btn-fill btn-primary" id="btnNewEntity">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
