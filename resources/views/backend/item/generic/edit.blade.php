


<div class="modal-content">
    <form class="needs-validation" id="generic_edit_form" action="{{ route('backend.itemconfig.generic-name.update', $genericName) }}"
        method="Post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Generic Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">

                <div class="form-row">    
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => old('name',$genericName->name), 'placeholder' => 'text will be here...' ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'note', 'value' => old('note',$genericName->note),  'placeholder' => 'note will be here...', ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('note')])
                </div>
                
               
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_generic_button">Update</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>

<script>


</script>