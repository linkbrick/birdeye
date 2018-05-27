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
                        <h4 class="card-title" style="display:inline">Entity
                        </h4>
                        <a href="{{route('entities.create')}}" class="btn btn-link btn-primary pull-right">New Entity</a>
                    </div>
                    <div class="card-body ">

                        <table id="datatables" class="table table-striped table-no-bordered table-hover display"
                               cellspacing="0" width="100%" style="width:100%;">
                            <thead>
                            <tr>
                                <th class="text-center" width="2%">#</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($entities as $key => $entity)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $entity->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
