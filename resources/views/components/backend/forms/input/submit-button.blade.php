
{{-- @include('components.backend.forms.input.submit-button',
[ 'type' => 'button/submit', 'class' => 'class', 'name' => 'button name']) --}}

<div class="col-lg-12
@isset($positon)
{{$positon}}
@else
text-right
@endisset
">

    <button
        type="@isset($type){{$type}}@else submit @endisset"
        @isset($disabled)
        disabled
        @endisset
        class="btn
        @isset($class){{$class}}@else btn-primary @endisset"
        id="@isset($id){{$id}}@endisset"

        >
        @isset($name)
        {{$name}}
        @else
        Submit
        @endisset
    </button>
</div>
{{-- resources\views\components\backend\forms\input\submit-button.blade.php --}}
