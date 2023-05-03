<html>

<head>
    <style>
        @page {
            background-color: #ffffff;
            sheet-size: 70mm 250mm;
            /* size: auto; */
            /* background-color: azure; */
            vertical-align: top;
            margin-top: 0;
            /* <any of the usual CSS values for margins> */
            margin-left: 0;
            /* <any of the usual CSS values for margins> */
            margin-right: 0;
            /* <any of the usual CSS values for margins> */
            margin-bottom: 0;
            /* <any of the usual CSS values for margins> */
            margin-header: 0;
            /* <any of the usual CSS values for margins> */
            margin-footer: 0;
            /* <any of the usual CSS values for margins> */
            marks: cross;
            /*crop | cross | none*/

            /*https://mpdf.github.io/css-stylesheets/supported-css.html*/
            /*https://mpdf.github.io/paging/different-page-sizes.html*/
        }

        #invoice-POS {
            box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.5);
            padding: 0;
            margin: 0 auto;
            width: 79mm !important;
            background: #fff;
        }

        * {
            letter-spacing: 1px;
            font-family: Arial, Helvetica, sans-serif;
            padding: 0;
            margin: 0;
        }

        body {
            width: 80mm;
            margin: auto
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #fff;
        }

        #invoice-POS h1 {
            font-size: 1em;
            /* color: #222; */
        }

        #invoice-POS h2 {
            font-size: 0.9em;
        }

        #invoice-POS h3 {
            font-size: 0.85em;
            margin: 2px 0;
            text-align: center;
        }

        td {
            padding: 3px;
        }

        #invoice-POS p {
            font-size: 0.7em;
            /* color: #666; */
            line-height: 1em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 0px solid #eee;
        }

        #invoice-POS #top {
            min-height: 0px;
        }

        #invoice-POS #mid {
            min-height: 0px;
        }

        #invoice-POS #bot {
            min-height: 0px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            /* font-size: 0.8em; */
            padding: 5px;
            background: #eee;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #eee;
        }

        #invoice-POS .item {
            width: 2in;
        }

        #invoice-POS .itemtext {
            font-size: 0.8em;
        }

        h3 {
            font-size: 10px;
        }

        h2 {
            font-size: 16px;
        }

        @media print {
            .btn {
                display: none;
            }

            #invoice-POS {
                padding: 0;
                width: 79mm !important;
                background: #fff;
            }
        }
    </style>
</head>

<body>
    <div class="btn" style="text-align: right">
        <button onclick="window.print()">Print</button>
    </div>
    {{-- <br /> --}}

    <div id="invoice-POS">
        <div id="bot">
            <div id="table">
                @php
                    echo DNS1D::getBarcodeHTML('444564565600', 'C128')."<br>";

                @endphp

                <table cellpadding="0" cellspacing="0" style="margin-top: 3px;">
                    <tr style="text-align: center; margin-bottom:3px;">
                        <td>
                            <h5>Note: Vat Included With Price.</h5>
                            <h5 style="margin-bottom:10px;">Thanks For Coming!</h5>
                        </td>
                    </tr>

                </table>
            </div>
            <!--End Table-->
        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->
    <br />
    <hr />
    <br />
</body>
<script>
    // window.print();
</script>

</html>
