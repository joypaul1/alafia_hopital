
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        //testItem autocomplete
        $("#testItem").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.radiology_serviceName.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                value: null,//Fillable in input field
                                price: obj.price, //Fillable in input field
                                label: obj.name,
                                value_id: obj.id,

                            }
                        })
                        response(resArray);
                    }
                });
            },

            select: function(event, ui) {
                event.preventDefault();
                $("#testItem").val(null);



                let row = `<tr>
                                <td>
                                    <input type="hidden"   name="service_id[]" value="${ui.item.value_id}">
                                    ${ui.item.label}
                                </td>

                                <td>
                                    <input type="text" name="price[]"
                                    value="${ui.item.price}" class="form-control subtotal text-right"readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm removeLabTest"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

                $('#labTestAppend').last().after(row);



                approximatePrice();
            }
        });


        //removeLabTest
        $(document).on('click', '.removeLabTest', function() {
            removeRow(this);
            approximatePrice();

        });
    </script>

