
$(function () {

    const costingTable = $('table.costing_table');
    let exc_tax = $("input[name='exc_tax']");
    let tax_rate = $("input[name='tax_rate']");
    let inc_tax = $("input[name='inc_tax']");
    let profit_percent = $("input[name='profit_percent']");
    let sell_price = $("input[name='sell_price']");

    $("select[name='tax_type']").on('change', function () {
        const row = costingTable.find('tbody>tr:first');
        row.find('td:eq(2)>label').text($(this).find("option:selected").text());
        row.find('td:eq(2)>input').attr('placeholder', $(this).find("option:selected").val());
        calculation();
    });
    $("select[name='tax_id']").on('change', function () {
        calculation();

    });

    tax = (here = $("select[name='tax_id']")) => {
        const str = here.find("option:selected").text();
        const middle = str.slice(
            str.indexOf('(') + 1,
            str.lastIndexOf(')'),
        );
        const taxArray = middle.split('/');
        let tax = taxArray[0], type = taxArray[1];
        return { tax, type };

    }
    calculation = () => {
        let exc_tax_rate = parseFloat(exc_tax.val()).toFixed(2);
        let tax_amount = 0;
        let amount = 0;
        let single_dsp_tax = parseFloat(inc_tax.val());
        let profit_percent_rate = parseFloat(profit_percent.val());
        let sell_of_price = parseFloat(sell_price.val());


        let $Tax = tax();
        if ($Tax.type == 'flat') {
            tax_amount = parseFloat($Tax.tax).toFixed(2);
        } else {
            tax_amount = parseFloat((exc_tax_rate * $Tax.tax) / 100).toFixed(2);
        }
        // console.log(exc_tax_rate , $Tax.tax, tax_amount);

        if ($("select[name='tax_type']").find("option:selected").val() == "included_tax") {
            amount = parseFloat(parseFloat(exc_tax_rate) + parseFloat(tax_amount)).toFixed(2);
        } else {
            amount = parseFloat(exc_tax_rate).toFixed(2);
        }
        inc_tax.val(amount);
        tax_rate.val(tax_amount);

        profit_percent_rate = (amount * profit_percent_rate) / 100;
        sell_of_price = parseFloat(parseFloat(profit_percent_rate) + parseFloat(amount)).toFixed(2);
        sell_price.val(sell_of_price);
    }

    profit_percent.change(function (e) {
        e.preventDefault();
        calculation();
    });

    sell_price.change(function (e) {
        e.preventDefault();
        let single_dsp_tax = parseFloat(inc_tax.val());
        let profit_percent_rate = parseFloat(profit_percent.val());
        let sell_of_price = parseFloat(sell_price.val());
        let $percent = parseFloat(((sell_of_price - single_dsp_tax) / single_dsp_tax) * 100).toFixed(2);
        profit_percent.val($percent)

    });

    exc_tax.change(function (e) {
        e.preventDefault();
        calculation();
    });

});


tinymce.init({
    selector: '#description',
    plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
    toolbar_mode: 'floating',
    height: '200',
});


if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function (e) {
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function (e) {
                var file = e.target;
                $("<img></img>", {
                    class: "imageThumb",
                    src: e.target.result,
                    title: file.name
                }).insertAfter("#files");
            });
            fileReader.readAsDataURL(f);
        }
    });
} else {
    alert("Your browser doesn't support to File API")
}
$("#add_attribute").click(function () {
    let markup = `<tr>
                    <td>
                        <input type="text"  placeholder="Attribute Name"  name="attribute_name[]" class="form-control">
                    </td>
                    <td><input type="text" placeholder="Attribute Value"  name="attribute_value[]"class="form-control"></td>
                    <td><input type="checkbox" class="form-control"></td>
                    <td><input type="number"></td>
                    <td class="text-center"><i class="fa fa-minus-circle" style='cursor:
                        pointer;' aria-hidden="true"></i></td>
                    </tr>`;
    tableBody = $("#product_attribute");
    tableBody.append(markup);
});
$("#add_gallery").click(function () {
    var rowCount = $('table.galleryImage').find('tbody>tr').length + 1;
    let markup = `<tr>
                        <td>
                            <input type="text" name="galleryName[]" placeholder="gallery name" class="form-control">
                        </td>
                        <td>
                            <div class="field" align="left">
                                <span>
                                    <input type="file" id="files" name="galleryImage[`+ rowCount + `][]" multiple />
                                </span>
                            </div>
                        </td>
                        <td><input type="checkbox"  id="is_thumbnail" value="off" name="is_thumbnail[]" class="form-control"></td>
                        <td class='text-danger h5' ><i class="fa fa-trash galleryRowDelete" style="cursor: pointer ;" aria-hidden="true"></i></td>
                    </tr>`;
    tableBody = $("#additional_products");
    tableBody.append(markup);
});

$(document).on('click', '.galleryRowDelete', function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
});

$(document).on('click', '.deleteAttribute', function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
});

$(document).on('click', '#is_thumbnail', function () {
    console.log($(this).val());
    if ($(this).val() == 'off') {
        $(this).val('on');
    } else {
        $(this).val('off');
    }
});
