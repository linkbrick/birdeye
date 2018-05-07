<div class="card">
    <div class="card-header card-header-rose card-header-text" data-background-color="primary">
        <div class="card-text">
            <h4 class="card-title">
                {{ $upload["title"] }}
                @if($model)
                    <i class="material-icons">done_all</i>
                @else
                    <i class="material-icons">watch_later</i>
                @endif
            </h4>
        </div>
    </div>

    <div class="card-body ">
        <form method="post" action="{{ url('evaluation/'.$evaluation->id) }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="PUT" />
            <input type="hidden" name="_category" value="{{ $upload['category'] }}" />

            @if($model)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group has-default">
                        <b>{{ $model->file_name }}</b>
                        &nbsp;&nbsp;
                        <a href="javascript:;" class="view_excel" data-target="{{ $model->id }}" data-title="{{ $upload['title'] }}">view</a>
                        &nbsp;&middot;&nbsp;
                        <a href="{{ url('evaluation/download/'.$model->id) }}" target="_blank">download</a>
                        <div><small class="text-muted font-italic">uploaded on {{ date("d F Y, g:ia", strtotime($model->created_at)) }}</small></div>
                    </div>
                </div>
            </div>
            <hr>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ url('evaluation/template/'.$upload['category']) }}" target="_blank">Download {{ $upload["title"] }} template here</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="file" name="{{ $upload['category'] }}_file" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" value="
                    @if(!$model)
                        {{ 'Upload ' }}
                    @else
                        {{ 'Replace ' }}
                    @endif
                    {{ $upload['title'] }}
                    " class="btn btn-rose">
                </div>
            </div>
        </form>
    </div>
</div>
