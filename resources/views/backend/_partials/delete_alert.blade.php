@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/sweetalert/sweetalert.min.css">
@endpush
@push('js')
<script src="{{ asset('assets/backend') }}/vendor/sweetalert/sweetalert.min.js"></script>
<script>
    function delete_check(id) {
        Swal.fire({
            title: 'Are you sure?',
            html: "<b>You will delete it permanently!</b>",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            width: 400,
        }).then((result) => {
            if (result.value) {
                $('#deleteCheck_' + id).submit();
            }
        })
    }

    $(document).on('click', 'button.delete_check', function() {
        Swal.fire({
            title: 'Are you sure?'
            , html: "<b>You will delete it permanently!</b>"
            , type: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
            , width: 400
        , }).then(willDelete => {
            if (willDelete.value) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE'
                    , url: href
                    , dataType: 'json'
                    , data: data
                    , success: function(res) {
                        let $message = res.mes;
                        let $context = res.status == true ? 'success' : 'error';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                        if (res.status) {
                            table_name.DataTable().ajax.reload();
                        }
                    }
                , });
            }
        });
    });
    $(document).on('click', 'a.delete_check', function() {
        Swal.fire({
            title: 'Are you sure?'
            , html: "<b>You will delete it permanently!</b>"
            , type: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
            , width: 400
        , }).then(willDelete => {
            if (willDelete.value) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE'
                    , url: href
                    , dataType: 'json'
                    , data: data
                    , success: function(res) {
                        let $message = res.mes;
                        let $context = res.status == true ? 'success' : 'error';
                        let $positionClass = 'toast-top-right';
                        toastr.remove();
                        toastr[$context]($message, '', {
                            positionClass: $positionClass
                        });
                        if (res.status) {
                            table_name.ajax.reload();
                        }
                    },error:function(res){
                        var errors =res;
                        console.log(errors.responseJSON.errors, 'errors');
                        var myObject = errors.responseJSON.errors;
                        for (var key in myObject) {
                        if (myObject.hasOwnProperty(key)) {
                            console.log(key + "/" + myObject[key]);
                            $("form#warehouse_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + ' ' + " </strong></div>");
                            $("form#warehouse_add_form input[name='" + key + "']").after("<div class='text-danger'><strong>" + myObject[key] + " </strong></div>");
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

                , });
            }
        });
    });

</script>
@endpush
