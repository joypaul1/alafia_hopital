
@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css">
@endpush

@php
    $str = ['_','[', ']'];
    $rplc =[' ',' ', ' '];
    $upName =  ucfirst(str_replace($str,$rplc, $name));
    if(isset($label)){
    $label = ucfirst(str_replace($str,$rplc, $label));
    }
@endphp


<select class="form-control show-tick ms select2" id="{{ $name }}"

    @isset($name)
    name="{{ $name  }}"
    @endisset
    @isset($multiple)
    multiple
    @endisset
    data-placeholder="Select"
    @isset($required)
    required
    @endisset
    @isset($livewire)
    {{$livewire}}
    @endisset
    >


    <option value="{{null}}" hidden>- select {{ $label??$upName }} -</option>


    @forelse ($optionDatas as $data)
        <option value="{{ $data['id'] }}"
            @isset($selectedKey)
                {{ in_array($data['id'], $selectedKey??' ') ? 'selected': ' ' }}
            @endisset
        >
            {{ $data['name'] }}
        </option>
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
