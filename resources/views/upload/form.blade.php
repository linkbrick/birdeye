<div class="card">
    <div class="card-header card-header-primary card-header-text" data-background-color="primary">
        <div class="card-text">
            <h4 class="card-title">
                <i class="material-icons" style="font-size:16px;">{{ $upload["icon"] }}</i>
                {{ $upload["title"] }}
            </h4>
        </div>
    </div>

    <div class="card-body ">
        <form method="post" action="{{ route('batch.upload') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_model" value="{{ $upload['model'] }}" />

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ url('batch_upload/template/'.$upload['model']) }}" target="_blank">Download {{ $upload["title"] }} template here</a>
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <input type="file" name="{{ $upload['model'] }}_file" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" value="Upload {{ $upload['title'] }}" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>
