
<div class="modal-content">
    <form class="needs-validation" id="register_add_form" action="{{ route('backend.register.store') }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id=""> Register Add </h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name','placeholder' => 'Enter register name here...', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.select2.option',['label'=>'outlet', 'name' => 'outlet_id', 'optionData'=> $outlets])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('outlet_id')])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="status" id="active_check">
                            <label class="form-check-label" for="active_check">Active ?</label>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_register_button">SAVE</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>


<script >
    $(document).on('submit', 'form#register_add_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#register_add_form");
        var formData = registerForm.serialize();
        $('.save_register_button').attr('disabled',true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            enctype: 'multipart/form-data',
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(res) {
                if(res.status){
                    let $message = res.success;
                    let $context = 'success';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                    $('.create_data').modal('hide');
                }else{
                    let $message = res.errors ;
                    let $context = 'error';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
                }

            },error:function(res){
                var errors =res;
                console.log(errors.responseJSON.errors, 'errors');
                var myObject = errors.responseJSON.errors;
                for (var key in myObject) {
                if (myObject.hasOwnProperty(key)) {
                    console.log(key + "/" + myObject[key]);
                    $("form#register_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                    $("form#register_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
                        let $message = myObject[key] ;
                        let $context = 'error';
                        let $positionClass= 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                    }

                }


            }
        });

        table_name.ajax.reload();
    });

</script>
