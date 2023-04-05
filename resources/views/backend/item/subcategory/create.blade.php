<div class="modal-content">
    <form class="needs-validation" id="subcategory_add_form"
        action="{{ route('backend.itemconfig.subcategory.store') }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf

        <div class="modal-header">
            <h4 class="title" id="">Subcategory Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">

                <div class="form-group">
                    @include('components.backend.forms.input.input-type',[ 'name' => 'name', 'placeholder' => 'name will be here...', 'required'=> 'yes' ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                </div>

                <div class="form-group">
                    @include('components.backend.forms.select2.option',[ 'name' =>'category_id','optionData'=>$categories, 'required'=> true ])
                    @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('category_id')])
                </div>


                {{-- <div class="form-group">
                    @include('components.backend.forms.input.input-image',[ 'name' => 'image', 'placeholder' => 'image
                    will be here...', 'alert_text' =>"Image Will be (200x200) px" ])
                    @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('image')])
                </div> --}}


            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_subcategory_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>

