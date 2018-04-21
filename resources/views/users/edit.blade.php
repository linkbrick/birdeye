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
                        <h4 class="card-title">Edit User</h4>
                        <form id="editUser" method="post" action="{{ route('users.update',['user' => $user->id]) }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Name
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="name" class="form-control" required="true" value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email
                                        </label>
                                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <select name="role_id" class="selectpicker" data-style="select-with-transition"
                                            title="Please select a role." data-size="7" required="required"
                                            data-live-search="true">
                                        @foreach($roles as $rkey => $rvalue)
                                            <option value="{{ $rvalue->id }}" @if(in_array($rvalue->id, $user->roles()->pluck('id')->toArray() ) )  selected @endif> {{ $rvalue->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <button class="btn btn-fill btn-primary" id="btnUpdateUser">Update</button>
                            <a href="{{ route('users.index') }}" class="btn btn-simple btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
