@push('js')

<script>
 // global app configuration object
    var config = {
        routes: {
            unit            : "{{route('backend.itemconfig.unit.index') }}",
            brand           : "{{route('backend.itemconfig.brand.index') }}",
            rack            : "{{route('backend.itemconfig.rack.index') }}",
            row             : "{{route('backend.itemconfig.row.index') }}",
            category        : "{{route('backend.itemconfig.category.index') }}",
            sub_category    : "{{route('backend.itemconfig.subcategory.index') }}",
            child_category  : "{{route('backend.itemconfig.childcategory.index') }}",
            generic_name    : "{{route('backend.itemconfig.generic-name.index') }}",
            strenght    : "{{route('backend.itemconfig.strenght.index') }}",
        }
    };
$(function() {

    // category data
    $.ajax({
        type: "GET",
        url:config.routes.category,
        dataType: 'JSON',
        data: {
            optionData: true
        },

        success: function(res) {
            $.map(res.data, function(val, i) {
                var newOption = new Option(val.name, val.id, false, false);
                $('#category_id').append(newOption).trigger('change');
                $('#category_id').val("{{$category_id}}").trigger('change');;
            });
        }
        , error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });
    // brand data
    $.ajax({
        type: "GET",
        url:config.routes.brand,
        dataType: 'JSON',
        data: {
            optionData: true
        },

        success: function(res) {
            $.map(res.data, function(val, i) {
                var newOption = new Option(val.name, val.id, false, false);
                $('#brand_id').append(newOption).trigger('change');
                $('#brand_id').val("{{$brand_id}}").trigger('change');

            });
        }
        , error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });
    // strenght data
    $.ajax({
        type: "GET",
        url:config.routes.strenght,
        dataType: 'JSON',
        data: {
            optionData: true
        },

        success: function(res) {
            $.map(res.data, function(val, i) {
                var newOption = new Option(val.name, val.id, false, false);
                $('#strenght_id').append(newOption).trigger('change');
                $('#strenght_id').val("{{$strenght_id}}").trigger('change');;

            });
        }
        , error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });
    // generic_name data
    $.ajax({
        type: "GET",
        url:config.routes.generic_name,
        dataType: 'JSON',
        data: {
            optionData: true
        },

        success: function(res) {
            $.map(res.data, function(val, i) {
                var newOption = new Option(val.name, val.id, false, false);
                $('#generic_id').append(newOption).trigger('change');
                $('#generic_id').val("{{$generic_id}}").trigger('change');;

            });
        }
        , error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });
    // unit data
    $.ajax({
        type: "GET"
        , url: config.routes.unit
        , dataType: 'JSON'
        , data: {
            optionData: true
        },

        success: function(res) {
            $.map(res.data, function(val, i) {
                var newOption = new Option(val.name, val.id, false, false);
                $('#unit_id').append(newOption).trigger('change');
                $('#unit_id').val("{{$unit_id}}").trigger('change');;

            });
        }
        , error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });
    // rack data
    $.ajax({
        type: "GET"
        , url: config.routes.rack
        , dataType: 'JSON'
        , data: {
            optionData: true
        },

        success: function(res) {
            $.map(res.data, function(val, i) {
                var newOption = new Option(val.name, val.id, false, false);
                $('#rack_id').append(newOption).trigger('change');
                $('#rack_id').val("{{$rack_id}}").trigger('change');;

            });
        }
        , error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            console.log(msg);
        }
    });


});

    // row_id data
    $('#rack_id').on('click', function(e) {
        e.preventDefault();
        let url = config.routes.row
        $.ajax({
            type: "GET"
            , url: url
            , dataType: 'JSON'
            , data: {
                rack_id: e.target.value
            },

            success: function(res) {
                $("#row_id").html('');
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#row_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
        , });

    });

    // sub-category data
    $('#category_id').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            type: "GET"
            , url: config.routes.sub_category
            , dataType: 'JSON'
            , data: {
                category_id: e.target.value
            },

            success: function(res) {

                $("#subcategory_id").html('').select2();
                $("#childcategory_id").html('').select2();
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#subcategory_id').append(newOption).trigger('change');

                });
            }
            , error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
        , });

    });

    // child-category data
    $('#subcategory_id').on('click', function(e) {
        e.preventDefault();
        let url = "{{route('backend.itemconfig.childcategory.index') }}"
        $.ajax({
            type: "GET"
            , url: config.routes.child_category
            , dataType: 'JSON'
            , data: {
                subcategory_id: e.target.value
            },

            success: function(res) {
                $("#childcategory_id").html(' ').select2();
                $.map(res.data, function(val, i) {
                    var newOption = new Option(val.name, val.id, false, false);
                    $('#childcategory_id').append(newOption).trigger('change');
                });
            }
            , error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
        , });

    });
</script>


@endpush
