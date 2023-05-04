<html>

<head>
    <style>
        @page {
            background-color: #ffffff;
            /* sheet-size: 70mm 250mm; */
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

            /*https://mpdf.github.io/css-stylesheets/supported-css.html*/
            /*https://mpdf.github.io/paging/different-page-sizes.html*/
        }

        @font-face {
            font-family: testFont;
            src: url(./kharon.ttf);
        }

        * {
            letter-spacing: 1px;
            font-weight: 900 !important;
            font-family: monospace !important;
            padding: 0;
            margin: 0;
        }

        body {
            /* background: green !important; */

            /* width: 80mm; */
            margin: auto
        }

        #invoice-Body {
            /* padding: 20.57px 95.36px 51.02px 71.56px; */
            /* width: 288px;
            height: 144px; */
            background: #fff;
        }

        #bot {
            margin: 0 auto;
            /* width: 105.50px; */
            /* height: 71.56px; */
            /* border: 1px solid #494949; */
            padding: 10px;
            box-sizing: border-box;
            /* background: blueviolet; */
        }

        .bot-body>div {
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
                /* height: 144px; */
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
                /* width: 105.50px;
                height: 71.56px; */
                /* border: 1px solid #494949; */
                /* background: blueviolet; */
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
            <div class="bot-body text-center" style="transform: scale(0.8); margin-top: 5px;">
                {{-- <div style="font-size:0;position:relative;width:202px;height:30px;">
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:0px;top:0px;">&nbsp;
                    </div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:6px;top:0px;">&nbsp;
                    </div>
                    <div style="background-color:black;width:6px;height:30px;position:absolute;left:12px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:22px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:30px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:6px;height:30px;position:absolute;left:36px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:44px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:6px;height:30px;position:absolute;left:48px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:56px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:66px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:70px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:80px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:6px;height:30px;position:absolute;left:88px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:100px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:104px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:6px;height:30px;position:absolute;left:110px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:122px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:126px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:132px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:138px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:146px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:154px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:162px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:170px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:176px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:6px;height:30px;position:absolute;left:186px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:2px;height:30px;position:absolute;left:194px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:4px;height:30px;position:absolute;left:198px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:0px;height:30px;position:absolute;left:202px;top:0px;">
                        &nbsp;</div>
                    <div style="background-color:black;width:0px;height:30px;position:absolute;left:202px;top:0px;">
                        &nbsp;</div>
                </div> --}}
                @php
                echo DNS1D::getBarcodeHTML('444564565600', 'C128');
            @endphp
                <p style="font-size: 14px; text-align:center;font-weight:bolder; margin-top:5px;">444564565600</p>
            </div>
            <div class="text">
                <p>
                    Nabila Yeasmin <span style="margin-left: 8px;">42 Y / F</span>
                </p>
                <p>
                    OPD
                </p>
                <p>
                    12-02-2023 <span style="margin-left: 8px;">MRD:564687545</span>
                </p>
                <p>
                    Urine
                </p>
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
