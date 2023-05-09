{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number' =>true, 'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=> 'yes' ]) --}}

@php
    $str = ['_', '[', ']'];
    $rplc = [' ', ' ', ' '];
    $upName = ucfirst(str_replace($str, $rplc, $name));
    $obj = new stdClass();
    $obj->value = null;
    $obj->number = false;
    $obj->inType = 'text';
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
    if (isset($inType)) {
        $obj->inType = $inType;
    }
    if (isset($number)) {
        $obj->number = $number;
    }
    if (isset($value)) {
        $obj->value = $value;
    }
    $setValue = json_encode($obj);
    $input = json_decode($setValue, true);
@endphp
<div class="form-group">
    {{-- label --}}
    <label class="col-form-label"
        @isset($name)
            for="{{ $name }}"
        @endisset>

        {{ $label ?? $upName }}

    </label>
    {{-- input --}}
    <input type="{{ $input['inType'] }}" name="{{ $input['name'] }}" class="{{ $input['class'] }}" id="{{ $input['id'] }}"
        @isset($input['number'])
            min="0"
            step="0.01"
            title="amount"
            pattern="^\d+(?:\.\d{1,2})?$"
        @endisset
        placeholder="{{ $input['placeholder'] }}" value="{{ $input['value'] }}" autocomplete="off">
</div>
