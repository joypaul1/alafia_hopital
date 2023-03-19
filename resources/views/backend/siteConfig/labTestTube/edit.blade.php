<div class="modal-content">
    <form class="needs-validation" id="labTestTube_edit_form" action="{{ route('backend.siteConfig.labTestTube.update', $labTestTube) }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Test-Tube Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $labTestTube->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>

                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'price', 'placeholder' => 'price will be here...', 'value' => number_format($labTestTube->price ,2), 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('price')])
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$labTestTube->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
            <button type="submit" class="btn btn-primary edit_labTestTube_button">SAVE</button>
        </div>
    </form>
</div>
<script>


</script>
