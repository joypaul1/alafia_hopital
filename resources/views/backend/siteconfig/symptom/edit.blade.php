<div class="modal-content">
    <form class="needs-validation" id="symptom_edit_form" action="{{ route('backend.siteConfig.symptom.update', $symptom) }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Symptom Edit</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'value' => $symptom->name, 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Symptom Type', 'name' =>'symptom_type_id', 'optionDatas'=>$type, 'selectedKey'=>$symptom->symptom_type_id, 'required'=>true])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('symptom_type_id')])
                </div>

                <div class=" form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3">{{$symptom->description??' '}}</textarea>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" {{$symptom->status == true ? 'Checked': ' '}} id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary edit_symptom_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>
<script>


</script>
