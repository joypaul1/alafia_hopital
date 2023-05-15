{{-- label start --}}
<label class="col-form-label" @isset($name)
for="{{ $name }}"
@endisset>
    @php
        $str = ['_', '[', ']'];
        $rplc = [' ', ' ', ' '];
        $upName = ucfirst(str_replace($str, $rplc, $name));
    @endphp
    {{ $label ?? $upName }}
    @isset($required)
        <span class="text-danger">* </span>
    @endisset
</label>
{{-- label end here --}}
<select
    @isset($class)
class="form-control {{ $class }}"
@else
class="form-control"
@endisset
    @isset($name)
name="{{ $name }}"
@endisset
    @isset($id)
id="{{ $id }}"
@else
id="{{ $name }}"
@endisset>
    <option value="{{ null }}" disabled>- select {{ $name }} -</option>

    @isset($optionData)
        @forelse ($optionData as $data)
            <option value="{{ $data['id'] }}"
                @isset($selectedKey)
            {{ $selectedKey == $data['id'] ? 'selected' : ' ' }}
        @endisset>
                {{ $data['name'] }}
            </option>
        @empty
        @endforelse
    @endisset

</select>
