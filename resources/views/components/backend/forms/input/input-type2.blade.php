
{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-type2',[ 'name' => 'mobile', 'number' =>true, 'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=> 'yes' ]) --}}

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
onkeypress='return event.charCode >= 48 && event.charCode <= 57'
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
