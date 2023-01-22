
{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number' =>true, 'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=> 'yes' ]) --}}


{{-- label start --}}
<label class="col-form-label"
@isset($name)
for="{{ $name }}"
@endisset>
@php
    $str = ['_','[', ']'];
    $rplc =[' ',' ', ' '];
    $upName =  ucfirst(str_replace($str,$rplc, $name));
@endphp
{{$label??$upName }}
@isset($required)
<span class="text-danger">* </span>
@endisset
</label>
{{-- label end here --}}

{{-- input start --}}
<input
@if(isset($type))
type="{{ $type }}"
@else
type="text"
@endif

@isset($name)
name="{{ $name }}"
@endisset
@isset($number)
min="0"
step="0.01"
title="amount"
pattern="^\d+(?:\.\d{1,2})?$"
@endisset

@if(isset($id))
id="{{ $id }}"
@else
id="{{ $name }}"
@endisset

@if(isset($class))
class="form-control {{ $class }}"
@else
class="form-control "
@endif

@isset($placeholder)
placeholder="{{ $placeholder }}"
@endisset

@isset($value)
value="{{$value}}"
@endisset
@isset($autocomplete)
autocomplete="on"
@else
autocomplete="off"

@endisset
@isset($required)
required
@endisset
@isset($readonly)
readonly
@endisset

>
{{-- input end here --}}
