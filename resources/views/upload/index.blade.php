@extends('layouts.tenant')

@section('content')
<div class="container-fluid" >
    <div class="header text-center">
        <h3 class="title">Batch Upload</h3>
        <p class="category">
            Please make sure the files is in correct excel format
        </p>
        <small class="text-muted"><a href="javascript:window.history.back();">&lt;&lt; Back to list</a></small>
    </div>

    @foreach($uploads as $index=>$upload)
        @if($index%2 == 0)
        <div class="row">
        @endif
        <?php $model = $upload["model"]; ?>
        <div class="col-md-6">
            @include('upload.form')
        </div>
        @if($index%2 == 1 || count($uploads)==($index+1))
        </div>
        @endif
    @endforeach
</div>
@endsection
