<div class="card">
    <div class="card-header card-header-rose card-header-text" data-background-color="primary">
        <div class="card-text">
            <h4 class="card-title">
                Sales Invoice
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
            <input type="hidden" name="_category" value="sales_invoice" />

            @if($invoice)
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group has-default">
                        <a href="{{ url('evaluation/download/'.$invoice->id) }}" target="_blank">
                            <b>{{ $invoice->file_name }}</b>
                        </a>
                        <small class="text-muted font-italic">was uploaded on {{ date("d F Y, g:ia", strtotime($invoice->created_at)) }}</small>
                    </div>
                </div>
            </div>
            <hr>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ url('template/sales-invoice') }}" target="_blank">Download Sales Invoice template here</a>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <input type="file" name="sales_invoice_file" class="form-control">
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-12">
                    <input type="submit" value="
                    @if(!$invoice)
                        {{ 'Upload Sales Invoice' }}
                    @else
                        {{ 'Replace Sales Invoice' }} 
                    @endif
                    " class="btn btn-rose">
                </div>
            </div>
        </form>
    </div>
</div>
