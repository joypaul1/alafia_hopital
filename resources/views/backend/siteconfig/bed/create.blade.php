
<div class="modal-content">
    <form class="needs-validation" id="bed_add_form" action="{{ route('backend.siteconfig.bed.store') }}" method="Post"
        enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id="">Category Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Bed Group', 'name' =>'bed_group_id', 'optionDatas'=>$group, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('bed_group_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Bed Type', 'name' =>'bed_type_id', 'optionDatas'=>$type, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('bed_type_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Cabin', 'name' =>'cabin_id', 'optionDatas'=>$cabin, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('cabin_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Ward', 'name' =>'ward_id', 'optionDatas'=>$ward, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('ward_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.select2.option',['label'=>'Floor', 'name' =>'floor_id', 'optionDatas'=>$floor, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('floor_id')])
                </div>
                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'price', 'placeholder' => 'name will be here...', 'required'=>true ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="status" id="active_check">
                    <label class="form-check-label" for="active_check">Active ?</label>
                </div>


            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_bed_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>


