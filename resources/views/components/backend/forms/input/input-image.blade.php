

{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-image',[ 'name' => 'image', 'alert_text' =>'Image Will be (200x200)px.' ]) --}}

@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/dropify/css/dropify.min.css">
@endpush
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
{{$upName }}
@isset($required)
<span class="text-danger">*</span>
@endisset
</label>
{{-- label end here --}}

<input type="file"
@isset($name) name="{{ $name }}" @endisset
class="dropify
@if(isset($class))
{{ $class }}
@endif"
@if(isset($id))
id="{{ $id }}"
@else
id="{{ $name }}"
@endisset data-allowed-file-extensions="jpg jpeg png svg">
@isset($alert_text)
<strong class="text-danger text-bold"> {{$alert_text}} </strong>
@endisset



@push('js')

<script src="{{ asset('assets/backend') }}/vendor/dropify/js/dropify.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/forms/dropify.js"></script>

@endpush
