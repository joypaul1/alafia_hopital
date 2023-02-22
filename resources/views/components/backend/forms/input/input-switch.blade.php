{{-- @include('components.backend.forms.input.input-switch',[ 'name' => 'mobile', 'number' =>true, 'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=> 'yes' ]) --}}

<label class="switch">
    <input type="checkbox"
    @isset($data_link)
        onclick = "{{ route($data_link) }}"
    @endisset
    @isset($status)
        @if ($status == true)
            checked
        @endif
    @endisset
    >
    <span class="slider round"></span>
</label>
