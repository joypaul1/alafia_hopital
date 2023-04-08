<div class="modal-content">
    <form class="needs-validation" id="appointment_add_form" action="{{ route('backend.appointment.store') }}"
        method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <div class="row w-100 justify-content-between">
                <div class="col-md-6">
                    <h4 class="title" id="">Create Appointment</h4>
                </div>
                <input type="hidden" name="patient_Id" id="patient_Id" value="">
                <div class="col-md-6">
                    <div class="row align-items-center">
                        <div class="col-9">
                            @include('components.backend.forms.input.input-type2', [
                                'name' => 'patientId',
                                'required' => 'true',
                                'placeholder' => 'Select Patient By Name/ID/Mobile...',
                            ])
                        </div>
                        <div class="col-3">
                            <button class="btn btn-info" data-href="{{ route('backend.patient.create') }}"
                                id="create_patient">
                                New Patient
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="row">
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'label' => 'department',
                            'name' => 'department_id',
                            'optionData' => $department,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'label' => 'doctor',
                            'name' => 'doctorID',
                            'optionData' => $doctors,
                            'required' => true,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'doctor_fees',
                            'readonly' => 'true',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'appointment_date',
                            'type' => 'date',
                            'value' => date('Y-m-d'),
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'name' => 'appointment_schedule',
                            'optionData' => [],
                            'required' => 'true',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'name' => 'appointment_priority',
                            'optionData' => $appointment_priority,
                            'selectedKey' => 'Normal',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'name' => 'payment_method',
                            'optionData' => $paymentSystems,
                            'required' => 'true',
                            'selectedKey' => 1,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'name' => 'status',
                            'optionData' => $appointment_status,
                            'selectedKey' => '1',
                            'required' => 'true',
                            'selectedKey' => 'approved',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'subtotal',
                            'readonly' => 'true',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.select2.option', [
                            'name' => 'discount_type',
                            'optionData' => $discountType,
                            // 'selectedKey' => 'discount',
                            // 'selectedKey' => 'approved',
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'discount',
                            // 'readonly' => 'true',
                            'value' => 0,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'discount_amount',
                            // 'readonly' => 'true',
                            'value' => 0.00,
                        ])
                    </div>

                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'payable_amount',
                            'readonly' => 'true',
                            'value' => 0.00,
                        ])
                    </div>

                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'paid_amount',
                            'value' => 0.00,
                        ])
                    </div>
                    <div class="col-4">
                        @include('components.backend.forms.input.input-type', [
                            'name' => 'due_amount',
                            'readonly' => true,
                            'value' => 0.00,
                        ])
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-primary save_category_button">SAVE</button>
        </div>
    </form>
</div>
