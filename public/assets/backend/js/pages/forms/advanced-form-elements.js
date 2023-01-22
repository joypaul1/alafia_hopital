$(function () {
    $(".colorpicker").colorpicker();
    var $demoMaskedInput = $(".demo-masked-input");
    $demoMaskedInput
        .find(".date")
        .inputmask("dd/mm/yyyy", { placeholder: "__/__/____" });
    $demoMaskedInput
        .find(".time12")
        .inputmask("hh:mm t", {
            placeholder: "__:__ _m",
            alias: "time12",
            hourFormat: "12",
        });
    $demoMaskedInput
        .find(".time24")
        .inputmask("hh:mm", {
            placeholder: "__:__ _m",
            alias: "time24",
            hourFormat: "24",
        });
    $demoMaskedInput
        .find(".datetime")
        .inputmask("d/m/y h:s", {
            placeholder: "__/__/____ __:__",
            alias: "datetime",
            hourFormat: "24",
        });
    $demoMaskedInput
        .find(".mobile-phone-number")
        .inputmask("+99 (999) 999-99-99", {
            placeholder: "+__ (___) ___-__-__",
        });
    $demoMaskedInput
        .find(".phone-number")
        .inputmask("+99 (999) 999-99-99", {
            placeholder: "+__ (___) ___-__-__",
        });
    $demoMaskedInput
        .find(".money-dollar")
        .inputmask("99,99 $", { placeholder: "__,__ $" });
    $demoMaskedInput
        .find(".ip")
        .inputmask("999.999.999.999", { placeholder: "___.___.___.___" });
    $demoMaskedInput
        .find(".credit-card")
        .inputmask("9999 9999 9999 9999", {
            placeholder: "____ ____ ____ ____",
        });
    $demoMaskedInput.find(".email").inputmask({ alias: "email" });
    $demoMaskedInput
        .find(".key")
        .inputmask("****-****-****-****", {
            placeholder: "____-____-____-____",
        });
    $("#phone").mask("(999) 999-9999");
    $("#phone-ex").mask("(999) 999-9999? x99999");
    $("#tax-id").mask("99-9999999");
    $("#ssn").mask("999-99-9999");
    $("#product-key").mask("a*-999-a999");
    $(
        "#multiselect1, #multiselect2, #single-selection, #multiselect5, #multiselect6"
    ).multiselect({ maxHeight: 300 });
    $("#optgroup").multiSelect({ selectableOptgroup: true });
    var sliderBasic = document.getElementById("nouislider_basic_example");
    noUiSlider.create(sliderBasic, {
        start: [30],
        connect: "lower",
        step: 1,
        range: { min: [0], max: [100] },
    });
    getNoUISliderValue(sliderBasic, true);
    var rangeSlider = document.getElementById("nouislider_range_example");
    noUiSlider.create(rangeSlider, {
        start: [32500, 62500],
        connect: true,
        range: { min: 25000, max: 100000 },
    });
    getNoUISliderValue(rangeSlider, false);
    $(".select2").select2();
    $(".search-select").select2({ allowClear: true });
    $("#max-select").select2({
        placeholder: "Select",
        maximumSelectionSize: 2,
    });
    $("#loading-select").select2({
        placeholder: "Select",
        minimumInputLength: 1,
        query: function (query) {
            var data = { results: [] },
                i,
                j,
                s;
            for (i = 1; i < 5; i++) {
                s = "";
                for (j = 0; j < i; j++) {
                    s = s + query.term;
                }
                data.results.push({ id: query.term + i, text: s });
            }
            query.callback(data);
        },
    });
    var data = [
        { id: 0, tag: "enhancement" },
        { id: 1, tag: "bug" },
        { id: 2, tag: "duplicate" },
        { id: 3, tag: "invalid" },
        { id: 4, tag: "wontfix" },
    ];
    function format(item) {
        return item.tag;
    }
    $("#array-select").select2({
        placeholder: "Select",
        data: { results: data, text: "tag" },
        formatSelection: format,
        formatResult: format,
    });
    $("#multiselect3-all").multiselect({ includeSelectAllOption: true });
    $("#multiselect4-filter").multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        maxHeight: 200,
    });
    $("#multiselect-size").multiselect({
        buttonClass: "btn btn-default btn-sm",
    });
    $("#multiselect-link").multiselect({ buttonClass: "btn btn-link" });
    $("#multiselect-color").multiselect({ buttonClass: "btn btn-primary" });
    $("#multiselect-color2").multiselect({ buttonClass: "btn btn-success" });
    $(".inline-datepicker").datepicker({ todayHighlight: true });
});
function getNoUISliderValue(slider, percentage) {
    slider.noUiSlider.on("update", function () {
        var val = slider.noUiSlider.get();
        if (percentage) {
            val = parseInt(val);
            val += "%";
        }
        $(slider).parent().find("span.js-nouislider-value").text(val);
    });
}
