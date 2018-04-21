@extends('layouts.material')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary" >

                        <div class="card-icon">
                            <i class="material-icons">grade</i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Edit Ability</h4>
                        <form id="newAbility" method="post" action="{{ route('abilities.update',['ability' => $ability->id]) }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Name
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="name" class="form-control" value="{{ $ability->name }}" >
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Title
                                        </label>
                                        <input type="text" name="title" class="form-control" value="{{ $ability->title }}">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-fill btn-primary" id="btnNewAbility">Update</button>
                            <a href="{{ route('abilities.index') }}" class="btn btn-simple btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
