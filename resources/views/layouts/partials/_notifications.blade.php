<div class="container-fluid">

    @if($errors->any())
    <div class="form-group">
        <div class="alert alert-danger">
            <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
            </button> -->
            @foreach($errors->all() as $_err)
            <span>
                {!! $_err !!}
            </span>
            @endforeach
        </div>
    </div>
    @endif

    @if(session()->has('_messages'))
    <?php
        $_MESSAGES = session()->get('_messages');
    ?>
    <div class="form-group">
        <div class="alert alert-{{ $_MESSAGES['type'] }}">
            @if(is_array($_MESSAGES['messages']))
                @foreach($_MESSAGES['messages'] as $_msg)
                <span>{{ $_msg }}</span>
                @endforeach
            @else
            <span>{!! $_MESSAGES['messages'] !!}</span>
            @endif
        </div>
    </div>
    @endif


    @if(session()->has('success'))
        <div class="form-group">
            <div class="alert alert-primary">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif
    
</div>
