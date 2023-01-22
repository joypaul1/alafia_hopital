<div class="modal-content">
    <form class="needs-validation" id="bedCabin_edit_form"
        action="{{ route('backend.siteconfig.bedCabin.update', $bedCabin) }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Cabin Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type', [
                        'name' => 'name',
                        'value' => $bedCabin->name,
                        'placeholder' => 'name will be here...',
                        'required' => true,
                    ])
                    @include('components.backend.forms.input.errorMessage', [
                        'message' => $errors->first('name'),
                    ])
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status"
                        {{ $bedCabin->status == true ? 'Checked' : ' ' }} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_bedCabin_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>
