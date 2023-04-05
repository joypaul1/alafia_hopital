
<div class="modal-content">
    <form class="needs-validation" id="outlet_add_form" action="{{ route('backend.outlet.store') }}" method="Post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="modal-header">
            <h4 class="title" id=""> Outlet Add</h4>
        </div>
        <div class="modal-body">
            <div class="form-validation">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'name','placeholder' => 'Enter supplier name here...', 'required'=> true ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('name')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'company_name','placeholder' => 'Enter Company Name here...'])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('company_name')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="status" id="active_check">
                            <label class="form-check-label" for="active_check">Active ?</label>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number'=> true, 'placeholder' => 'Enter mobile Number here...', 'required'=> true])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'email','placeholder' => 'Enter Phone Number here...', ])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('email')])
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.select2.option',[ 'label' => 'country','name' => 'country_id','optionData'=> $countries])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('country_id')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'province', 'placeholder' => 'Enter your province name here...'])
                            @include('components.backend.forms.input.errorMessage', ['message' =>  $errors->first('province')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'city', 'placeholder' => 'Enter your city name here...' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('city')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'postal_code', 'number' => true, 'placeholder' => 'Enter Postal Code here...' ])
                            @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'address_line_1', 'placeholder' => 'Enter Address Line 1 here...'])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('address_line_1')])
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @include('components.backend.forms.input.input-type',[ 'name' => 'address_line_2', 'placeholder' => 'Enter Address Line 2 here...'])
                            @include('components.backend.forms.input.errorMessage', ['message' =>$errors->first('address_line_2')])
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary save_outlet_button">SAVE</button>
            {{-- <button type="reset" class="btn btn-warning">Reset</button> --}}
            <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
        </div>
    </form>
</div>


<script >
    $(document).on('submit', 'form#outlet_add_form', function(e) {
        e.preventDefault();
        var registerForm = $("form#outlet_add_form");
        var formData = registerForm.serialize();
        // $('.save_outlet_button').attr('disabled',true);
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
                // console.log(res);
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

</script>
