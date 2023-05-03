<div class="modal-content">
    <form class="needs-validation" id="patient_add_form" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">New Patient</h4>
        </div>

        <div class="modal-body">
            <div class="form-validation">
                <div class="row">
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'name',
                        'required' => 'true',
                        'placeholder' => 'Enter Name'
                        ])

                    </div>

                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'mobile',
                        'required' => 'true',
                        'number' => true,
                        'placeholder' => 'Enter Mobile'
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'email',
                        'placeholder' => 'Enter Email'
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'emargency_contact',
                        'placeholder' => 'Enter Emargency Contact'
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'guardian_name',
                        'placeholder' => 'Enter Guardian Name'

                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                        'name' => 'gender',
                        'optionData' => $genders,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'age',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'dob',
                        'type' => 'date',
                        'id' => 'date_of_birth',
                        ])
                    </div>

                     {{-- <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'name' => 'symptoms_type',
                            'optionData' => [],
                            'required' => 'true',
                        ])
                    </div>--}}
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                        'name' => 'blood_group',
                        'optionData' => $blood_group,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                        'name' => 'marital_status',
                        'optionData' => $marital_status,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                        'name' => 'address',
                        'placeholder' => 'Enter Address'
                        ])
                    </div>
                    {{-- <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'any_known_allergies',
                            'placeholder' => 'Enter Any Known Allergies'
                        ])
                    </div> --}}
                    {{-- <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'Weight',
                            'placeholder' => 'Enter Weight'
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'Blood Pressure',
                            'placeholder' => 'Ex: 120/80'
                        ])
                    </div> --}}
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-primary">SAVE</button>
        </div>
    </form>
</div>
