
<div class="modal-content">
    <form class="needs-validation" id="reference_add_form" action="{{ route('backend.reference.store') }}" method="Post"
        enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Reference Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'placeholder' => 'mobile will be here...', 'number'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                </div>

                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'email', 'placeholder' => 'email will be here...' ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('email')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'commission', 'placeholder' => 'commision will be percent(%) amount (10)', 'number'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('commission')])
                </div>


                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_reference_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>


