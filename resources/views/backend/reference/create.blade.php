
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


{{-- <script >
    $(document).on('submit', 'form#reference_add_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#reference_add_form");
        var formData = registerForm.serialize();
        $('.save_reference_button').attr('disabled',true);

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
                console.log(res);
                if(res.status){
                    $(modal).modal('hide');
                    dataBaseCall();
                    let $message = res.success;
                    let $context = 'success';
                    let $positionClass= 'toast-top-right';
                    toastr.remove();
                    toastr[$context]($message, '', {
                        positionClass: $positionClass
                    });
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
                    $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                    $("form#outlet_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
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
    });

</script> --}}
