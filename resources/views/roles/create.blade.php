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
                        <h4 class="card-title">Create New Role</h4>
                        <form id="newRole" method="post" action="{{ route('roles.store') }}"
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
                            <section>
                                <h5>Abilities</h5>
                            @foreach($abilities as $akey => $ability)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="abilities[]" value="{{ $ability->id }}"> {{ $ability->title }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            </section>

                            <button class="btn btn-fill btn-primary" id="btnNewRole">Create</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-simple btn-primary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

