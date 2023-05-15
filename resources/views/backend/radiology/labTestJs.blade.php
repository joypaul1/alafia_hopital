
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
                                    <input type="text" name="test_price[]"
                                    value="${ui.item.price}" class="form-control test_price text-right"readonly>
                                </td>
                                <td>
                                    <select name="discount_type[]" class="form-control discount_type" onChange=>"discount_type()">
                                        <option value="${null}" hidden><-- Discount --> </option>
                                        <option value="fixed">Fixed</option>
                                        <option value="percentage" selected >Percentage</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="discount[]" class="form-control discount text-right" >
                                </td>
                                <td>
                                    <input type="text" name="discount_amount[]" class="form-control discount_amount text-right" value="0" readonly>
                                </td>
                                <td>
                                    <input type="text" name="subtotal[]"
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

