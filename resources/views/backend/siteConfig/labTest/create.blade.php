<div class="modal-content">
    <form class="needs-validation" id="labTest_add_form" action="{{ route('backend.siteConfig.labTest.store') }}"
        method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Lab-Test Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name',
                        'placeholder' => 'name will be here...',
                        'required' => true,
                    ])
                    @include('components.backend.forms.input.errorMessage', [
                        'message' => $errors->first('name'),
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
                    <label for="delivery">Delivery Time <span class="text-danger">*</span></label>
                    <div class="d-flex" style="gap:10px">
                        <input type="number"name="time" class="form-control" placeholder="Enter Delivery Time">
                        <select name="time_type" id="time_type" class="form-control">
                            <option value="hour" {{ $serviceName->time_type== 'hour'? 'Selected': null }}>Hour</option>
                            <option value="day" {{ $serviceName->time_type== 'day'? 'Selected': null }}>Day</option>
                        </select>
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" checked id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-outline-primary save_labTest_button">SAVE</button>
        </div>
    </form>
</div>
