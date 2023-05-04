<html>

<head>
    <style>
        @page {
            background-color: #ffffff;
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

        }

        @font-face {
            font-family: testFont;
        }

        * {
            letter-spacing: 1px;
            font-weight: 900 !important;
            font-family: monospace !important;
            padding: 0;
            margin: 0;
        }

        body {
            margin: auto
        }

        #invoice-Body {
            background: #fff;
        }

        #bot {
            margin: 0 auto;
            padding: 10px;
            box-sizing: border-box;
        }

        .bot-body >div {
            margin: auto;
        }

        p {
            font-size: 11px;
            font-weight: 900;
        }


        @media print {
            .btn {
                display: none;
            }

            #invoice-Body {
                width: 90% !important;
                margin: auto;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #invoice-Body .text {
                width: 92% !important;
                margin-left: auto;
            }

            #bot {
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="btn" style="text-align: right">
        <button onclick="window.print()">Print</button>
    </div>


    <div id="invoice-Body">
        <div id="bot">
            <div class="bot-body" style="transform: scale(0.8); margin-top: 5px;">
                @php
                    echo DNS1D::getBarcodeHTML('444564565600', 'C128');
                @endphp
                <p style="font-size: 14px; text-align:center;font-weight:bolder; margin-top:5px;">444564565600</p>
                <div class="text" style=" text-align:center;">
                    <p>
                        {{ $labinvoice->patient->name }} <span style="margin-left: 8px;">42 Y / F</span>
                    </p>
                    <p>
                        OPD
                    </p>
                    <p>
                        12-02-2023 <span style="margin-left: 8px;">MRD:564687545</span>
                    </p>
                    <p>
                        {{ $labinvoice->patient->name }}
                    </p>
                </div>
            </div>

            <!--End Table-->
        </div>
        <!--End InvoiceBot-->
    </div>
    <!--End Invoice-->
    <script>
        // window.print();
    </script>
</body>


</html>
