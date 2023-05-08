{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number' =>true, 'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=> 'yes' ]) --}}


<div class="form-group">
    {{-- label --}}
    <label class="col-form-label"
        @isset($name)
            for="{{ $name }}"
        @endisset>
        @php
            $str = ['_', '[', ']'];
            $rplc = [' ', ' ', ' '];
            $upName = ucfirst(str_replace($str, $rplc, $name));
            $obj = new stdClass();
            $obj->type = 'text';
            $obj->name = $name;
            $obj->id = $name;
            $obj->class = 'form-control';
            $obj->placeholder = $name;
            if (isset($class)) {
                $obj->class = $obj->class . ' ' . $class;
            }
            if (isset($id)) {
                $obj->id = $obj->id . ' ' . $id;
            }
            if (isset($placeholder)) {
                $obj->placeholder = $placeholder;
            }
            if (isset($type)) {
                $obj->type = $type;
            }
        @endphp
        {{ $label ?? $upName }}
        @isset($required)
            <span class="text-danger">* </span>
        @endisset
    </label>
    {{-- input --}}
    <input type="{{$obj->type}}" name="{{ $obj->name }}" class="{{ $obj->class }}" id="{{ $obj->id }}"
        @isset($number)
            min="0"
            step="0.01"
            title="amount"
            pattern="^\d+(?:\.\d{1,2})?$"
        @endisset
        placeholder="{{$obj->placeholder }}"
        @isset($value)
            value="{{ $value }}"
        @endisset autocomplete="on"
        @if (isset($required)) required @endif @if (isset($readonly)) readonly @endif>
</div>
