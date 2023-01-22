
<div class="modal-content">
    <form class="needs-validation" id="strenght_edit_form" action="{{ route('backend.itemconfig.strenght.update', $strenght) }}" method="Post"
        enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Strenght Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value'=> $strenght->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'note', 'value'=> $strenght->note,'placeholder' => 'note will be here...' ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('note')])
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{ $strenght->status== '1'? 'Checked': '' }} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_strenght_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>


