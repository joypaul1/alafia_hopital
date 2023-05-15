@push('css')
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/select2/select2.css" />
    <link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css">
@endpush

@php
    $str = ['_', '[', ']'];
    $rplc = [' ', ' ', ' '];
    $upName = ucfirst(str_replace($str, $rplc, $name));
    if (isset($label)) {
        $label = ucfirst(str_replace($str, $rplc, $label));
    }

@endphp
{{-- label end here --}}
{{-- @if (isset($label) || isset($name)) --}}
<label class="col-form-label for="{{ $name }}">
    {{ $label ?? $upName }}
    @isset($required)
        <span class="text-danger">*</span>
    @endisset
</label>
{{-- @endif --}}
{{-- label end here --}}


<select class="form-control show-tick ms select2" id="{{ $name }}" name="{{ $name }}"
    @isset($multiple) multiple @endisset
    @isset($onclick)
    onclick="dataBaseCall()"
@endisset
    @isset($onchange)
onchange="dataBaseCall()"
@endisset
    @isset($required)
required
@endisset>
    <option value="{{ null }}">- select {{ $label ?? $name }} -</option>
    @forelse ($optionData as $data)
        <option value="{{ $data['id'] }}"
            @isset($selectedKey) {{ $selectedKey == $data['id'] ? 'selected' : ' ' }} @endisset>
            {{ $data['name'] }}
        </option>
    @empty
    @endforelse
</select>

@push('js')
    <script src="{{ asset('assets/backend') }}/vendor/select2/select2.min.js"></script>
    @if (isset($name))
        <script>
            // $(document).ready(function(){
            //     $('#{{ $name }}').select2({
            //         dropdownParent: $('.patient_modal')
            //     });
            // });
            $("#{{ $name }}").each(function() {
                $(this).select2();
            });
            // $("#{{ $name }}").select2();
        </script>
    @else
        <script>
            $(".select2").each(function() {
                $(this).select2();
            });;
        </script>
    @endif


@endpush
