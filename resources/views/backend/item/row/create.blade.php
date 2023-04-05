<div class="modal-content">
    <form class="needs-validation" id="row_add_form" action="{{ route('backend.itemconfig.row.store') }}"
        method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id=""> <i class="fa fa-plus-circle" aria-hidden="true"></i> Row Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'note', 'placeholder' => 'note will be here...', ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('note')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',[ 'name' => 'rack_id','optionData'=> $racks ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('note')])
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_row_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>

