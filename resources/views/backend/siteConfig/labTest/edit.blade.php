@extends('backend.layout.app')
@include('backend._partials.datatable__delete')


@section('page-header')
    <i class="fa fa-list"></i> LabTest Edit
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-info-circle',
        'name' => 'LabTest List',
        'route' => route('backend.siteConfig.labTest.index'),
    ])
    <div class="row col-9">
        <div class="card">
            <div class="body">
                <div class="modal-content">
                    <form class="needs-validation" id="labTest_edit_form"
                        action="{{ route('backend.siteConfig.labTest.update', $labTest) }}" method="Post"
                        enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="modal-body">
                            <div class="form-validation">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'name',
                                        'value' => $labTest->name,
                                        'placeholder' => 'name will be here...',
                                        'required' => true,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('name'),
                                    ])
                                </div>
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'Department',
                                        'name' => 'department',
                                        'optionData' => $department,
                                        'required' => true,
                                        'selectedKey' => $labTest->department,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('department'),
                                    ])
                                </div>
                                <div class="form-group">
                                    @include('components.backend.forms.select2.option', [
                                        'label' => 'LabTestTube',
                                        'name' => 'lab_test_tube_id',
                                        'optionData' => $labTestTube,
                                        'selectedKey' => $labTest->lab_test_tube_id,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('lab_test_tube_id'),
                                    ])
                                </div>
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type', [
                                        'name' => 'price',
                                        'placeholder' => 'price will be here...',
                                        'value' => number_format($labTest->labTest_price, 2),
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
                                        'value' => $labTest->unit,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('unit'),
                                    ])
                                </div>
                                <div class="form-group">
                                    <label for="delivery">Delivery Time</label>
                                    <div class="d-flex" style="gap:10px">
                                        <input type="number"name="time" value="{{ $labTest->time }}"
                                            class="form-control" placeholder="Enter Delivery Time">
                                        <select name="time_type" id="time_type" class="form-control">
                                            <option value="hour" {{ $labTest->time_type == 'hour' ? 'Selected' : null }}>
                                                Hour
                                            </option>
                                            <option value="day" {{ $labTest->time_type == 'day' ? 'Selected' : null }}>
                                                Day
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    @include('components.backend.forms.texteditor.editor', [
                                        'name' => 'reference',
                                        'placeholder' => 'reference  here ...',
                                        'value' => $labTest->reference,
                                    ])
                                    @include('components.backend.forms.input.errorMessage', [
                                        'message' => $errors->first('reference'),
                                    ])
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" name="status"
                                        {{ $labTest->status == true ? 'Checked' : ' ' }} id="active_check">
                                    <label class="form-check-label" for="active_check">Active ?</label>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" class="btn btn-primary edit_labTest_button">SAVE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
