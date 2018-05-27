@extends('layouts.material')

@section('content')
<div class="container-fluid" >
    <div class="row">
        <div class="col-md-12">
            @include('layouts.messages')

            <div class="text-right">
                <button class="btn btn-rose btn-fill" onclick="newEval()">New Evaluation</button>
            </div>

            <div class="card">
                <div class="card-header card-header-rose card-header-icon" data-background-color="primary">
                    <div class="card-icon">
                        <i class="material-icons">view_list</i>
                    </div>
                </div>

                <div class="card-body">
                    <div class="toolbar"></div>

                    <div class="material-datatables">
                        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Evaluation</th>
                                    @foreach($uploads as $category=>$data)
                                        <th class="text-center">{{ $data["title"] }}</th>
                                    @endforeach
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Evaluation Date</th>
                                    @foreach($uploads as $category=>$data)
                                        <th class="text-center">{{ $data["title"] }}</th>
                                    @endforeach
                                    <th class="text-right">Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($evaluation as $index=>$eva)

                                <tr>
                                    <td>
                                        <div class="hidden">{{ $eva->code }}</div>
                                        {{ date("F Y", strtotime($eva->code."-01")) }}
                                    </td>
                                    @foreach($uploads as $category=>$data)
                                        <td class="text-center">
                                            @if($eva->upload->where("category", $data["model"])->count() > 0)
                                                <i class="material-icons text-success">done_all</i>
                                            @else
                                                <i class="material-icons text-danger">watch_later</i>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td class="text-right">
                                        <a href="{{ url('evaluation/'.$eva->id.'/edit') }}" class="btn btn-link btn-info btn-just-icon like"><i class="material-icons">mode_edit</i></a>
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

@push('scripts')
    <script src="{{ asset('js/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ asset('js/jquery.datatables.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable({
                "order": [],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search records",
                }
            });

            $('.card .material-datatables label').addClass('form-group');
        });

        function newEval(){
            swal({
                title: 'New Evaluation',
                html:
                    '<small class="text-muted">Select Evaluation Date</small><form method="post">' +
                        '@csrf' +
                        '<div class="row">' +
                            '<div class="col-sm-6">' +
                                '<div class="form-group">' +
                                    '<select class="form-control" name="month" title="Month">' +
                                        '<option disabled selected>Month</option>' +
                                        @foreach($month as $m=>$d)
                                        '<option value="{{ $m }}" @if(date("m")==$m) selected @endif>{{ $d }}</option>' +
                                        @endforeach
                                      '</select>' +
                                  '</div>' +
                              '</div>' +
                              '<div class="col-sm-6">' +
                                  '<div class="form-group">' +
                                      '<select class="form-control" name="year" title="Year">' +
                                          '<option disabled selected>Year</option>' +
                                          @foreach($year as $y)
                                          '<option value="{{ $y }}" @if(date("Y")==$y) selected @endif>{{ $y }}</option>' +
                                          @endforeach
                                        '</select>' +
                                    '</div>' +
                                '</div>' +
                        '</div>' +
                        '<div class="row">' +
                            '<div class="col-sm-12">' +
                                '<input type="submit" class="btn btn-success" value="Create">' +
                                '<input type="button" class="btn btn-danger" onclick="swal.closeModal()" value="Cancel">' +
                            '</div>' +
                        '</div>' +
                    '</form>',
                showCancelButton: false,
                showConfirmButton: false
            }).catch(swal.noop)
        }
    </script>
@endpush
