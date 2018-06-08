@foreach($autoform["columns"] as $obj)
<?php $name = $obj['name']; ?>
<div class="row">
    <div class="col-md-12">
        <div class="form-group label-floating ">
            <label class="control-label">{{ $obj['label'] }}
                @if(!isset($obj['required']) || $obj['required']!=false)
                <small>*</small>
                @endif
            </label>

            @switch($obj['type'])
                @case('text')
                    <textarea name="{{ $name }}"
                        class="form-control {{ $obj['attr']['class'] or '' }}"
                        @if(!isset($obj['required']) || $obj['required']!=false)
                        required
                        @endif
                    >
                    @break

                @case('select')
                    <select id="{{ $name }}" name="{{ $name }}" class="selectpicker {{ $obj['attr']['class'] or '' }}" data-style="select-with-transition"
                            title="{{ $obj['attr']['title'] or '' }}" data-size="7"  data-live-search="true"
                            @if(isset($obj['attr']['misc']))
                            @foreach($obj['attr']['misc'] as $attr=>$val)
                            {{ $attr."='".$val."'" }}
                            @endforeach
                            @endif
                            @if(isset($obj['required']) && $obj['required']!=false)
                            required
                            @endif
                    >
                        @foreach($obj['model'] as $ekey => $evalue)
                            <option value="{{ $ekey }}"
                                @if($ekey == $input->$name)
                                selected
                                @endif
                            >{{ $evalue }}</option>
                        @endforeach
                    </select>
                    @break

                @default
                    <input name="{{ $name }}"
                        class="form-control
                        @if($obj['type']=='date')
                        datepicker
                        @endif
                        {{ $obj['attr']['class'] or '' }}"
                        @if(!isset($obj['required']) || $obj['required']!=false)
                        required
                        @endif
                        @if($obj['type']=='decimal' || $obj['type']=='integer')
                        type = "number"
                        @if($obj['type']=='decimal') step="0.01" @endif
                        @else
                        type="text"
                        @endif
                        value="{{ $input->$name }}"
                    >
            @endswitch
        </div>
    </div>
</div>
@endforeach

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            Setting.initFormExtendedDatetimepickers();
        });
    </script>
@endpush
