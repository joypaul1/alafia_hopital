@extends('backend.layout.app')
@push('css')
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Patient Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Patient  List',
        'route' => route('backend.siteconfig.slider.index'),
    ])

    <div class="card">
        <div class="body">
            <div class="row">
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Name',
                        'required' => 'true',
                    ])
                </div>

                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Mobile ',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Email ',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Emergency Contact',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Guardian Name',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Gender',
                        'optionDatas' => [],
                    ])
                </div>

                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Date Of Birth',
                        'type' => 'date',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Age ',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Blood Group',
                        'optionDatas' => [],
                        'required' => 'true',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.select2.option', [
                        'name' => 'Marital Status',
                        'optionDatas' => [],
                        'required' => 'true',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Address ',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Any Known Allergies',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Weight',
                    ])
                </div>
                <div class="col-3">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'Blood Pressure',
                    ])
                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $image = $('#userProfile');
            $imageFile = $('#userProfile-image');
            // Grab image link when input change
            $image.change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $imageFile.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
@endpush
