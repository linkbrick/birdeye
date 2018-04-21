@extends('layouts.material')

@section('content')
    <div class="container-fluid">
        @if(session()->has('message'))
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <span>{{ session()->get('message') }}</span>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card ">
            <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">tune</i>
                </div>
                <h4 class="card-title">Maintenance</h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills nav-pills-primary" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#calendar_link" role="tablist">
                            CALENDAR
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#competency_link" role="tablist">
                            COMPETENCY
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#matrix_link" role="tablist">
                            CRITICALITY MATRIX
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#splist_link" role="tablist">
                            SP LIST REVIEW
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#subsidiaries_link" role="tablist">
                            SUBSIDIARIES
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#cc_link" role="tablist">
                            CC CONCUR
                        </a>
                    </li>
                </ul>
                <div class="tab-content tab-space">
                    <div class="tab-pane active" id="calendar_link">
                        CALENDAR LINK
                    </div>
                    <div class="tab-pane" id="competency_link">
                        COMPETENCY LINK
                    </div>
                    <div class="tab-pane" id="matrix_link">
                        MATRIX LINK
                    </div>
                    <div class="tab-pane" id="splist_link">
                        @include('maintenance.splist_review.index')
                    </div>
                    <div class="tab-pane" id="subsidiaries_link">
                        THIS IS SUBSIDIARIES LINK
                    </div>
                    <div class="tab-pane" id="cc_link">
                        THIS IS CC LINK
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
<script src="{{ asset('js/moment.min.js') }}"></script>
{{--<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>--}}
<script type="text/javascript">
    $(function () {
        $('.datetimepicker').datetimepicker({
            icons: {
                time: 'fa fa-clock-o',
                date: 'fa fa-calendar',
                up: 'fa fa-chevron-up',
                down: 'fa fa-chevron-down',
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'glyphicon glyphicon-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-times'
            },
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>
@endpush
