{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number' =>true, 'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=> 'yes' ]) --}}

@php
    $str = ['_', '[', ']'];
    $rplc = [' ', ' ', ' '];
    $upName = ucfirst(str_replace($str, $rplc, $name));
    $obj = new stdClass();
    $obj->value = null;
    $obj->disable = false;
    $obj->readonly = false;
    $obj->required = false;
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
        $obj->number = true;
    }
    if (isset($required)) {
        $obj->required = true;
    }
    if (isset($readonly)) {
        $obj->readonly = true;
    }
    if (isset($disable)) {
        $obj->disable = true;
    }
    if (isset($value)) {
        $obj->value = $value;
    }
    $setValue = json_encode($obj);
    $input = json_decode($setValue, true);
    // dd($input);
@endphp
<div class="form-group">
    {{-- label --}}
    <label class="col-form-label"
        @isset($name)
            for="{{ $name }}"
        @endisset>

        {{ $label ?? $upName }}
        @if($input['required'])
            <span class="text-danger">*</span>
        @endif
    </label>
    {{-- input --}}
    <input type="{{ $input['inType'] }}" name="{{ $input['name'] }}" class="{{ $input['class'] }}" id="{{ $input['id'] }}"
        @if($input['number']== true)
            min="0"
            step="0.01"
            title="amount"
            pattern="^\d+(?:\.\d{1,2})?$"
            onkeypress='return event.charCode >= 48 && event.charCode <= 57'
        @endif
        placeholder="{{ $input['placeholder'] }}" value="{{ $input['value'] }}" autocomplete="off"
        @if($input['required'] == true)
            required
        @endif
        @if($input['readonly'] == true)
        readonly
        @endif
        @if($input['disable'] == true)
        disable
        @endif

        >
</div>
