@extends('layouts.material')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary">
                        <div class="card-icon">
                            <i class="material-icons">work</i>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Edit Role</h4>
                        <form id="editRole" method="post" action="{{ route('roles.update',['role' => $role->id]) }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating ">
                                        <label class="control-label">Name
                                            <small>*</small>
                                        </label>
                                        <input type="text" name="name" class="form-control" value="{{ $role->name }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Title
                                        </label>
                                        <input type="text" name="title" class="form-control" value="{{ $role->title }}">
                                    </div>
                                </div>
                            </div>
                            <section>
                                <h5>Abilities</h5>
                            @foreach($abilities as $akey => $ability)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="abilities[]" value="{{ $ability->id }}" @if( in_array($ability->id, $role->abilities()->get()->pluck('id')->toArray() )) checked @endif > {{ $ability->title }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </section>

                            <button class="btn btn-fill btn-primary" id="btnUpdateRole">Update</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-simple btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

