{{-- how to add your template --}}
{{-- @include('components.backend.forms.texteditor.editor',[ 'name' => 'description' ]) --}}
{{-- default use --}}
{{-- @include('components.backend.forms.texteditor.editor' --}}
@php
    $str = ['_', '[', ']'];
    $rplc = [' ', ' ', ' '];
    $upName = ucfirst(str_replace($str, $rplc, $name));
@endphp
{{-- label end here --}}
<label class="col-form-label" @isset($name)
for="{{ $name }}"
@endisset>
    {{ $upName }}
    @isset($required)
        <span class="text-danger">*</span>
    @endisset
</label>
{{-- label end here --}}

{{-- textarea  --}}
<textarea name="@isset($name){{ $name }}@else  description  @endisset"
    id="@isset($name){{ $name }}@else  description  @endisset" class="editor-textarea"
    placeholder="@isset($placeholder){{ $placeholder }} @else Enter description here... @endisset">
@isset($value)
{!! $value !!}
@endisset
</textarea>
{{-- textarea end --}}

@push('js')
    <script src="https://cdn.tiny.cloud/1/qvctqtfhdqwqkjf8r0rd2dbjuk44fzk70v0sosx67u0z5msk/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    @if (isset($name))
        <script>
            tinymce.init({
                selector: '.editor-textarea',
                plugins: 'advlist autolink lists link image charmap preview anchor pagebreak table',
                // toolbar_mode: 'floating',
                height: '220px',
            });
        </script>
    @else
        <script>
            tinymce.init({
                selector: '.editor-textarea',
                plugins: 'advlist autolink lists link image charmap preview anchor pagebreak table',
                toolbar_mode: 'floating',
                height: '220px',
            });
        </script>
    @endif

@endpush
