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
                        <h4 class="card-title">Create New Ability</h4>
                        <form id="newAbility" method="post" action="{{ route('abilities.store') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Name
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="name" class="form-control" required="true">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Title
                                        </label>
                                        <input type="text" name="title" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-fill btn-primary" id="btnNewAbility">Create</button>
                            <a href="{{ route('abilities.index') }}" class="btn btn-simple btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
