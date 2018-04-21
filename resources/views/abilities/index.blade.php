@extends('layouts.material')

@section('content')
    <div class="container-fluid" id="corporate-index">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon card-header-primary">
                        <div class="card-icon">
                            Abilities
                        </div>
                    </div>
                    <div class="row" style="display: inline">
                        <a href="{{route('abilities.create')}}" class="btn btn-link btn-primary pull-right">New Ability</a>
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
                                    <th class="disabled-sorting" width="15%">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($abilities as $akey => $ability)
                                    <tr>
                                        <td>{{ ++$akey }}</td>
                                        <td>{{ $ability->name }}</td>
                                        <td>{{ $ability->title }}</td>
                                        <td class="td-actions">
                                            <div class="row" style="width: 110px;margin:0px;">
                                                <a href="{{route('abilities.edit',["id" => $ability->id])}}"
                                                   class="col-md-3 btn btn-info"><i
                                                            class="material-icons">edit</i></a>
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

