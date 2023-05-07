@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
    <i class="fa fa-list"></i> LabTest Create
@stop


@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-info-circle',
'name'=> 'LabTest List',
'route'=> route('backend.siteConfig.labTest.index'),
])
    <div class="row col-9">
        <div class="card">
            <div class="body">
                <div class="modal-content">
                <form class="needs-validation" id="labTest_add_form" action="{{ route('backend.siteConfig.labTest.store') }}"
                    method="Post" enctype="multipart/form-data">
                    @method('POST')
                    @csrf

                    <div class="modal-body">
                        <div class="form-validation">
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'name',
                                    'type' => 'text',
                                    'placeholder' => 'name will be here...',
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('name'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'short_name',
                                    'type' => 'text',
                                    'placeholder' => 'short name will be here...',
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('short_name'),
                                ])
                            </div>

                            <div class="form-group">
                                @include('components.backend.forms.select2.option', [
                                    'label' => 'Department',
                                    'name' => 'department',
                                    'optionData' => $department,
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('department'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'type',
                                    'optionData' => $type,
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('type'),
                                ])
                            </div>

                            <div class="form-group">
                                @include('components.backend.forms.select2.option', [
                                    'label' => 'LabTestTube',
                                    'name' => 'lab_test_tube_id',
                                    'optionData' => $labTestTube,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('lab_test_tube_id'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.select2.option', [
                                    'name' => 'specimen',
                                    'optionData' => $specimen,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('specimen'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'price',
                                    'placeholder' => 'price will be here...',
                                    'required' => true,
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('price'),
                                ])
                            </div>

                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'unit',
                                    'placeholder' => 'unit will be here...',
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('unit'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'needle',
                                    'number' => true,
                                    'placeholder' => 'needle qty will be here...',
                                    'value' => 0
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('needle'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'glucose',
                                    'number' => true,
                                    'placeholder' => 'glucose qty will be here...',
                                    'value' => 0
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('glucose'),
                                ])
                            </div>
                            <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                                    'name' => 'pot',
                                    'number' => true,
                                    'placeholder' => 'pot qty will be here...',
                                    'value' => 0
                                ])
                                @include('components.backend.forms.input.errorMessage', [
                                    'message' => $errors->first('pot'),
                                ])
                            </div>

                            <div class="form-group">
                                <label for="delivery">Delivery Time <span class="text-danger">*</span></label>
                                <div class="d-flex" style="gap:10px">
                                    <input type="number"name="time" class="form-control"
                                        placeholder="Enter Delivery Time" required>
                                    <select name="time_type" id="time_type" class="form-control" required>
                                        <option value="hour">Hour</option>
                                        <option value="day">Day</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                            @include('components.backend.forms.texteditor.editor', [
                                'name' => 'reference',
                                'placeholder' => 'reference  here ...',

                            ])
                            @include('components.backend.forms.input.errorMessage', [
                                'message' => $errors->first('reference'),
                            ])
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="status" checked id="active_check">
                                <label class="form-check-label" for="active_check">Active ?</label>
                            </div>

                            {{-- <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=>true ])
                                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                                </div>   --}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-primary save_labTest_button">SAVE</button>
                    </div>
                </form>
                </div>

            </div>
        </div>
    </div>

@endsection
