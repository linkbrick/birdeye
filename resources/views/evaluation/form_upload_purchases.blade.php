<div class="card">
    <div class="card-header card-header-rose card-header-text" data-background-color="primary">
        <div class="card-text">
            <h4 class="card-title">
                Purchase Order
                @if($invoice)
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
            <input type="hidden" name="_category" value="purchases" />

            @if($purchases)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group has-default">
                        <a href="{{ url('evaluation/download/'.$purchases->id) }}" target="_blank">
                            <b>{{ $purchases->file_name }}</b>
                        </a>
                        <small class="text-muted font-italic">was uploaded on {{ date("d F Y, g:ia", strtotime($purchases->created_at)) }}</small>
                    </div>
                </div>
            </div>
            <hr>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ url('template/purchases') }}" target="_blank">Download Purchase Order template here</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="file" name="purchases_file" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" value="
                    @if(!$purchases)
                        {{ 'Upload Purchase Order' }} 
                    @else
                        {{ 'Replace Purchase Order' }}
                    @endif
                    " class="btn btn-rose">
                </div>
            </div>
        </form>
    </div>
</div>
