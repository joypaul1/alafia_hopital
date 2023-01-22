@push('css')

<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css">

@endpush


<label class="col-form-label"
@isset($name)
for="{{ $name }}" 
@endisset> 
{{ucfirst($name)}}
@isset($required)
<span class="text-danger">*</span>
@endisset
</label> 
{{-- label end here --}}


<select class="form-control show-tick ms select2" id="{{$name}}" 
    @isset($name)
    name="{{ $name }}" 
    @endisset
    data-placeholder="Select {{ucfirst($name)}}" 
    @isset($required) required @endisset >

    <option value="{{null}}">- select {{($name)}} -</option>
    @forelse ($datas as $data)
        <option value="{{ $data->id }}">{{ $data->name }}</option>
    @empty
    @endforelse
    
</select>
 

  
@push('js')

<script src="{{ asset('assets/backend') }}/vendor/select2/select2.min.js"></script> 

@if (isset($name))
<script>
    $("#{{$name}}").select2();
</script>
@else
<script>
    $(".select2").select2();
</script>
    
@endif



@endpush
