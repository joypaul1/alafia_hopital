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
            padding-top: 0;
            box-sizing: border-box;
        }

        .bot-body>div {
            margin: auto;
        }

        p {
            font-size: 10px;
            /* font-weight: 900; */
            width: max-content;
            margin: auto;
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

            .pagebreak {
                clear: both;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="btn" style="text-align: right">
        <button onclick="window.print()">Print</button>
    </div>

    @php
        $bday = new DateTime(optional($labInvoice->patient)->dob??''); // Your date of birth
        $today = new Datetime(date('m.d.y'));
        $diff = $today->diff($bday);
    @endphp
    @foreach ($printData as $key => $details)
        @foreach ($details as $index => $testData)

            <div id="invoice-Body">
                <div id="bot" style="display: flex;align-items:flex-end;">
                    <div class="bot-body" style="transform: scale(1); width:100%; margin: auto;margin-top:8px;">
                        @php
                            echo DNS1D::getBarcodeHTML(strval($labInvoice->id), 'C128');
                        @endphp
                        <p style="font-size: 13px; text-align:center;font-weight:bolder;">
                            {{ optional($labInvoice->patient)->patientId??' ' }}
                        </p>
                        <div>
                            <div class="text" style=" text-align:center; ">
                                <p>
                                    {{ optional($labInvoice->patient)->name??' ' }} <span style="margin-left: 8px;">{{ $diff->y }}
                                        Y / {{ substr(optional($labInvoice->patient)->gender ?? '-', 0, 1) }} </span>
                                </p>
                                <p style="width:100%; margin:auto; font-size:8px !important;">
                                    {{ implode(', ', $testData) }}
                                </p>
                                <p>
                                    <span style="font-size: 8px;">
                                        {{ date('d-m-y h:i A') }}
                                    </span>
                                    <br>
                                    <strong style="margin-left: 8px; font-size:13px;">IN:{{ $labInvoice->invoice_no }}</strong>
                                </p>
                                <p>
                                    @php
                                        $dep = str_replace('(', '', $key);
                                        $dep = str_replace(')', '', $key);
                                        $dep = preg_replace("/[0-9]+/", '', $dep);
                                    @endphp
                                   DEP: {{ $dep }}
                                </p>

                            </div>
                        </div>
                    </div>

                    <!--End Table-->
                </div>
                <!--End InvoiceBot-->
            </div>
            <div class="pagebreak"> </div>
        @endforeach
    @endforeach

    <!--End Invoice-->
    <script>
        // window.print();
    </script>
</body>


</html>
