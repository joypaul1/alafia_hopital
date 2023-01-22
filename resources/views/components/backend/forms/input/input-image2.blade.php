
{{-- how to add your template --}}
{{-- @include('components.backend.forms.input.input-image2',[ 'name' => 'image', 'alert_text' =>'Image Will be (200x200)px.' ]) --}}

@push('css')
<link href="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.css" rel="stylesheet">
@endpush
@php
    $str = ['_','[', ']'];
    $rplc =[' ',' ', ' '];
    $upName =  ucfirst(str_replace($str,$rplc, $name));
@endphp


{{-- label start --}}
<label class="col-form-label" @isset($name) for="{{ $name }}" @endisset>
    {{ucfirst($label??$upName)}}
    @isset($required)
    <span class="text-danger">*</span>
    @endisset
</label>
{{-- label end here --}}

<div id="drag-drop-area"></div>
@isset($alert_text)
<strong class="text-danger text-bold"> {{$alert_text}} </strong>
@endisset



@push('js')
<script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
<script>
    var uppy = Uppy.Core()
        .use(Uppy.Dashboard, {
            inline: true,
            target: '#drag-drop-area'
        })
        .use(Uppy.Tus, {
            endpoint: 'https://master.tus.io/files/'
        }) //you can put upload URL here, where you want to upload images

    uppy.on('complete', (result) => {
        console.log('Upload complete! We’ve uploaded these files:', result.successful)
    })
</script>
@endpush