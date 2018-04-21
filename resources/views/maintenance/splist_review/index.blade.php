@if($planned_review == null || isset($planned_review) && $planned_review->status == 'drafted')
<form method="POST" action="{{ route('spListReview_update') }}" class="form-horizontal">
    {{ csrf_field() }}

    <div class="card">
        <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">event</i>
            </div>
            <h4 class="card-title">Planned Review Date</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="reviewName" class="col-form-label">Review name</label>
                <input type="text" name="reviewName" id="reviewName" class="form-control"
                       value="{{isset($planned_review)? $planned_review->name : null}}" required>
            </div>
            <div class="form-group">
                <label for="reviewDate" class="col-form-label">Date to start review</label>
                <input type="text" name="reviewDate" id="reviewDate" class="form-control datetimepicker"
                       value="{{isset($planned_review)? $planned_review->planned_start_date : null}}" required>
            </div>
        </div>
    </div>

    <div class="row">
        {{--reminder 1--}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">av_timer</i>
                    </div>
                    <h4 class="card-title">Reminder 1</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="reminder1" class="col-form-label">Date for reminder 1</label>
                        <input type="text" name="reminder1" id="reminder1" class="form-control datetimepicker"
                               value="{{isset($planned_review)? $planned_review->reminder1 : null}}">
                    </div>
                </div>
            </div>
        </div>


        {{--reminder 2--}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">av_timer</i>
                    </div>
                    <h4 class="card-title">Reminder 2</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="reminder2" class="col-form-label">Date for reminder 2</label>
                        <input type="text" name="reminder2" id="reminder2" class="form-control datetimepicker"
                               value="{{isset($planned_review)? $planned_review->reminder2 : null}}">
                    </div>
                </div>
            </div>
        </div>

        {{--reminder 3--}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header card-header-rose card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">av_timer</i>
                    </div>
                    <h4 class="card-title">Reminder 3</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="reminder3" class="col-form-label">Date for reminder 3</label>
                        <input type="text" name="reminder3" id="reminder3" class="form-control datetimepicker"
                               value="{{isset($planned_review)? $planned_review->reminder3 : null}}">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div>
        <button type="submit" class="btn btn-fill btn-primary">Save</button>
    </div>

</form>

@else
    <div class="card">
        <div class="card-header card-header-primary card-header-icon">
            <div class="card-icon">
                <i class="material-icons">event</i>
            </div>
            <h4 class="card-title">Review Start Date</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="reviewName" class="col-form-label">Review name</label>
                <input type="text" name="reviewName" id="reviewName" class="form-control" readonly
                       value="{{$planned_review->name}}">
            </div>
            <div class="form-group">
                <label for="reviewDate" class="col-form-label">Review started on</label>
                <input type="text" name="reviewDate" id="reviewDate" class="form-control datetimepicker"
                       value="{{$planned_review->planned_start_date}}" readonly>
            </div>
        </div>
    </div>

@endif

@if(isset($planned_review))
<div class="text-center">
    @if($planned_review->status == 'drafted')
        <form method="POST" action="{{ route('spListReview_changeStatus',['review' => $planned_review->id]) }}" class="form-horizontal">
            {{ csrf_field() }}
            <input name="status" type="hidden" value="started">
            <button type="submit" class="btn btn-success btn-round">START REVIEW</button>
        </form>
    @elseif($planned_review->status == 'started')
        <div class="btn-group">
            <form method="POST" action="{{ route('spListReview_changeStatus',['review' => $planned_review->id]) }}" class="form-horizontal">
                {{ csrf_field() }}
                <input name="status" type="hidden" value="completed">
                <button type="submit" class="btn btn-success btn-round">COMPLETE</button>
            </form>
            <form method="POST" action="{{ route('spListReview_changeStatus',['review' => $planned_review->id]) }}" class="form-horizontal">
                {{ csrf_field() }}
                <input name="status" type="hidden" value="halted">
                <button type="submit" class="btn btn-danger btn-round">HALT</button>
            </form>
        </div>
    @endif
</div>
@endif

