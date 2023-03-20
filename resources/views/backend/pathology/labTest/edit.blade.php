<div class="modal-content">
    <form class="needs-validation" id="labTest_edit_form" action="{{ route('backend.siteConfig.labTest.update', $labTest) }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Lab-Test Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $labTest->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'LabTestTube', 'name' =>'lab_test_tube_id', 'optionDatas'=>$labTestTube, 'selectedKey'=>$labTest->lab_test_tube_id])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('lab_test_tube_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'price', 'placeholder' => 'price will be here...', 'value' => number_format($labTest->labTest_price ,2), 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('price')])
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$labTest->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-primary edit_labTest_button">SAVE</button>
        </div>
    </form>
</div>
<script>


</script>
