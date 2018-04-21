@extends('layouts.material')

@section('content')
    <div class="container-fluid" id="corporate-index">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary">

                        <div class="card-icon">
                            Roles
                        </div>
                    </div>
                    <div class="row" style="display: inline">
                        <a href="{{route('roles.create')}}" class="btn btn-link btn-primary pull-right">New Role</a>
                    </div>
                    <div class="card-body">
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                   cellspacing="0" width="100%" style="width:100%; word-break: break-all">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Title</th>
                                    <th>Abilities</th>
                                    <th>Level</th>
                                    <th class="disabled-sorting" width="15%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $rkey => $role)
                                    <tr>
                                        <td>{{ ++$rkey }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->title }}</td>
                                        <td>
                                            @if($role->abilities()->count() > 0)
                                            <ul>

                                            @foreach($role->abilities()->get() as $ability)
                                                <li>{{ $ability->title }}</li>
                                                @endforeach
                                            </ul>
                                                @else
                                                <p class="text-warning">You did not assigned ability to this user</p>
                                                @endif
                                        </td>
                                        <td>{{ $role->level }}</td>
                                        <td class="td-actions">
                                            <div class="row" style="width: 110px;margin:0px;">
                                                <a href="{{route('roles.edit',["id" => $role->id])}}"
                                                   class="col-md-3 btn btn-info"><i
                                                            class="material-icons">edit</i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

