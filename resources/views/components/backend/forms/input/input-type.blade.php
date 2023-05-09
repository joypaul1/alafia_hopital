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
            $obj->value = null;
            $obj->number = false;
            $obj->type = 'text';
            $obj->name = $name;
            $obj->id = $name;
            $obj->class = 'form-control';
            $obj->placeholder = $name;
            if (isset($class)) {
                $obj->class = $obj->class . ' ' . $class;
            }
            if (isset($id)) {
                $obj->id = $id;
            }
            if (isset($placeholder)) {
                $obj->placeholder = $placeholder;
            }
            if (isset($type)) {
                $obj->type = $type;
            }
            if (isset($number)) {
                $obj->number = $number;
            }
            if (isset($value)) {
                $obj->value = $value;
            }
        @endphp
        {{ $label ?? $upName }}
        @isset($required)
            <span class="text-danger">* </span>
        @endisset
    </label>
    {{-- input --}}
    {{-- @dd($obj->number); --}}

    <input type="{{$obj->type}}" name="{{ $obj->name }}" class="{{ $obj->class }}" id="{{ $obj->id }}"
        {{-- @if($obj->number)
            min="0"
            step="0.01"
            title="amount"
            pattern="^\d+(?:\.\d{1,2})?$"
        @endif --}}
        placeholder="{{$obj->placeholder }}"
            value="{{ $obj->value }}"
        autocomplete="on"
        @if (isset($required)) required @endif @if (isset($readonly)) readonly @endif>
</div>
