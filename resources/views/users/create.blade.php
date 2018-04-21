@extends('layouts.material')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary" >
                        <div class="card-icon">
                            <i class="material-icons">people_add</i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Create New User</h4>
                        <form id="newCorporate" method="post" action="{{ route('users.store') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="label-control">Name
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="name" class="form-control" required="true">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="label-control">Email
                                        </label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <select name="role_id" class="selectpicker" data-style="select-with-transition"
                                            title="Please select a role." data-size="7" required="required"
                                            data-live-search="true">
                                        @foreach($roles as $rkey => $rvalue)
                                            <option value="{{ $rvalue->id }}">{{ $rvalue->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">

                                    <select name="division_id" class="selectpicker" data-style="select-with-transition"
                                            title="Please select a division." data-size="7" required="required"
                                            data-live-search="true">
                                        @foreach($divisions as $dkey => $dvalue)
                                            <option value="{{ $dvalue->id }}">{{$dvalue->code}}:{{ $dvalue->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <button class="btn btn-fill btn-primary" id="btnNewCorporate">Create</button>
                            <a href="{{ route('users.index') }}" class="btn btn-simple btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection