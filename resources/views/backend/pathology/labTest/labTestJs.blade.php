
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        //testItem autocomplete
        $("#testItem").autocomplete({
            source: function(request, response) {
                var optionData = request.term;
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.labTest.index') }}",
                    data: {
                        'optionData': optionData
                    },
                    success: function(res) {
                        var resArray = $.map(res.data, function(obj) {
                            return {
                                tube: obj.tube, //Fillable in input field
                                value: null, //Fillable in input field
                                category: obj.category, //Fillable in input field
                                price: obj.price, //Fillable in input field
                                label: obj.name,
                                value_id: obj.id,
                                needle: obj.needle,
                                glucose: obj.glucose,
                            }
                        })
                        response(resArray);
                    }
                });
            },

            select: function(event, ui) {
                event.preventDefault();
                $("#testItem").val(null);

                //get all labTestCatName value by class name labTestCatName
                let testTube_id = $('.testTube_id').map(function() {
                    return $(this).val();
                }).get();

                let labTestCatName = $('.labTestCatName').map(function() {
                    return $(this).val();
                }).get();

                let tubeAppendFlag = false;

                if (labTestCatName.length > 0) {
                    //check if category is already exist or not in table row by labTestCatName class name
                    labTestCatName.forEach(catName => {
                        if ((catName) == (ui.item.category).toString()) {
                            tubeAppendFlag = false;
                            //check if testTube_id is already exist or not in table row by testTube_id class name
                            if (testTube_id.length > 0) {
                                testTube_id.forEach(testTube => {
                                    if ((testTube) == (ui.item.tube.id).toString()) {
                                        tubeAppendFlag = false;
                                    } else {
                                        tubeAppendFlag = true;
                                    }
                                });
                            }
                        } else {
                            tubeAppendFlag = true;
                        }
                    });
                } else if (labTestCatName.length == 0) {
                    tubeAppendFlag = true;
                }

                // console.log(tubeAppendFlag, labTestCatName.length);
                // labTest data append in table also added table row discount_type dropdown & discount & discount_amount with html event attribute
                let row = `<tr>
                                <td>
                                    <input type="hidden" class="labTest_id"  name="labTest_id[]" value="${ui.item.value_id}">
                                    <input type="hidden" class="labTestCatName"  value="${ui.item.category}">
                                    <input type="hidden"  value="${ui.item.tube.name}">
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
                //cus added
                if ((ui.item.label).toString() == "Fasting Blood Sugar (FBS)" ) {
                    let row = `<tr>
                                <td>
                                    <input type="hidden" class="labTest_id"  name="labTest_id[]" value="319">
                                    <input type="hidden" class="labTestCatName"  value="Biochemistry">
                                    CUS
                                </td>
                                <td>
                                    <input type="text" name="test_price[]" value="${120}" class="form-control test_price text-right"readonly>
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
                                    value="${120}" class="form-control subtotal text-right"readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm removeLabTest"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

                    $('#labTestAppend').last().after(row);
                }
                //cus added
                if ((ui.item.label).toString() == "Blood Glucose 2 Hrs. AFB" ||(ui.item.label).toString() == "Blood Glucose 2 Hrs. After 75gm Glucose") {
                    let row = `<tr>
                                <td>
                                    <input type="hidden" class="labTest_id"  name="labTest_id[]" value="320">
                                    <input type="hidden" class="labTestCatName"  value="Biochemistry">
                                    CUS (2Hours)
                                </td>
                                <td>
                                    <input type="text" name="test_price[]" value="${120}" class="form-control test_price text-right"readonly>
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
                                    value="${120}" class="form-control subtotal text-right"readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm removeLabTest"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>`;

                    $('#labTestAppend').last().after(row);
                }
                //end labTestAppend
                if (tubeAppendFlag == true) {
                    let tube = `<tr>
                        <td>
                            <input type="hidden" name="testTube_id[]" class="testTube_id" value="${ui.item.tube.id}">
                            ${ui.item.tube.name}
                        </td>
                        <td>
                            <input type="text" name="testTube_price[]"
                            value="${ui.item.tube.price}" class="form-control testTube_price text-right"
                            readonly>
                        </td>
                    </tr>`;
                    $('#testTubeAppend').last().after(tube);
                }
                //end testTubeAppend



                //append needle data in testTubeAppend row
                if (ui.item.needle > 0) {

                    let needle_id = $('.needle_id').map(function() {
                        return $(this).val();
                    }).get();
                    let needle_for = $('.needle_for').map(function() {
                        return $(this).val();
                    }).get();

                    if ((ui.item.label).toString() == "Fasting Blood Sugar (FBS)" || (ui.item.label)
                        .toString() == "Blood Glucose 2 Hrs. AFB" || (ui.item.label).toString() ==
                        "Blood Glucose 2 Hrs. After 75gm Glucose") {
                        let needle = `<tr>
                                    <td>
                                        <input type="hidden" name="needle_id[]"  class="needle_id" value="needle">
                                        <input type="hidden" class="needle_for" value="${ui.item.label}">
                                        Needle
                                    </td>
                                    <td>
                                        <input type="text" name="needle_price[]"
                                        value="${20}" class="form-control testTube_price text-right"
                                        readonly>
                                    </td>
                                </tr>`;
                        let classLength = $('.needle_id').length;
                        if (classLength == 1) {
                            $('#testTubeAppend').last().after(needle);

                        } else if (classLength == 0) {
                            $('#testTubeAppend').last().after(needle);
                            $('#testTubeAppend').last().after(needle);
                        }
                    } else {
                        //first check needle not exist
                        if ($.inArray('needle', needle_id) != -1) {

                        } else {
                            let needle = `<tr>
                                <td>
                                    <input type="hidden" name="needle_id[]"  class="needle_id" value="needle">
                                    <input type="hidden" class="needle_for" value="${ui.item.label}">
                                    Needle
                                </td>
                                <td>
                                    <input type="text" name="needle_price[]"
                                    value="${20}" class="form-control testTube_price text-right"
                                    readonly>
                                </td>
                            </tr>`;
                            $('#testTubeAppend').last().after(needle);
                        }
                    }

                }
                approximatePrice();
            }
        });


        //removeLabTest
        $(document).on('click', '.removeLabTest', function() {
            removeRow(this);
            // remove all testTubeTable table tbody tr ignore tr id testTubeAppend
            $('.testTubeTable tbody tr').not('#testTubeAppend').remove()
            // get testTable all tbody tr td labTest_id value
            $('.labTest_id').map(function() {
                //ajax request
                $.ajax({
                    method: 'GET',
                    url: "{{ route('backend.siteConfig.labTest.index') }}",
                    data: {
                        'labTest_id': $(this).val()
                    },
                    success: function(res) {
                        let labTestCatName = $('.labTestCatName').map(function() {
                            return $(this).val()
                        }).get();
                        let testTube_id = $('.testTube_id').map(function() {
                            return $(this).val()
                        }).get();

                        if ($.inArray((res.data.tube.id).toString(), testTube_id) != -1 && $
                            .inArray((res.data.category).toString(), labTestCatName) != -1
                        ) {

                        } else {
                            // testTube data append in table
                            let tube = `<tr>
                                    <td>
                                        <input type="hidden" name="testTube_id[]" class="testTube_id" value="${res.data.tube.id}">
                                        ${res.data.tube.name}
                                    </td>
                                    <td>
                                        <input type="text" name="testTube_price[]"
                                        value="${res.data.tube.price}" class="form-control testTube_price text-right"
                                        readonly>
                                    </td>
                                </tr>`;
                            $('#testTubeAppend').last().after(tube);
                        }
                    }
                });
            }).get();
            approximatePrice();

        });
    </script>

