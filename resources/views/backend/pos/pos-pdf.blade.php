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
            margin-left: 1mm;
            /* <any of the usual CSS values for margins> */
            margin-right: 1mm;
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
    <div style="width: 100%; text-align: center;">
        <img src="{{ asset('assets/cafe_logo.svg') }}" style="width: 100px; transform: scale(2);" alt="" /> <br />
        <p style="font-size: 22px; margin: 20px 0px 5px 0px;">
            <b>Penny & Peter's Cafe</b>
        </p>
        <p style="font-size: 12px; margin: 0px 5px 5px 5px; text-align: center; text-justify: inter-word;">
            Anam Rangs Plaza (Level - 5), House # 61, Satmasjid Road, Dhaka 1209 , Bangladesh
        </p>
        <p style="font-size: 12px; margin: 0px 5px 5px 5px; text-align: center;">
            Phone: +880 1926-248950
        </p>
        <h2 style="margin-top: 5px;">
            Invoice Number: #{{ $order->invoice_number }}
        </h2>

    </div>
    <table style="font-size: 14px;">
        {{-- <tr>
            <td>
                Schedule:
            </td>
            <td></td>
        </tr> --}}
        <tr>
            <td colspan="2" style="text-align: center">
                Date: {{ date('d-m-Y', strtotime($order->date)) }} | Time: {{ date('h:i:s A') }}
            </td>

        </tr>
        <tr>
            <td style="width:30%">
                <p style="display:flex;justify-content:space-between;">
                    <span>Name</span>
                    <span>:</span>
                </p>
                <p style="display:flex;justify-content:space-between;">
                    <span>Email</span>
                    <span>:</span>
                </p>
                <p style="display:flex;justify-content:space-between;">
                    <span>Mobile</span>
                    <span>:</span>
                </p>
                <p style="display:flex;justify-content:space-between;">
                    <span>Table No.</span>
                    <span>:</span>
                </p>
                {{--  :{{ optional($order->user)->email??' ' }} <br /> --}}
                {{-- Mobile  :{{ optional($order->user)->mobile??' ' }} <br /> --}}
                {{-- Table   :{{implode(', ', $order->orderTables->pluck('table.name')->toArray())}} --}}

            </td>
            <td>
                <p>
                    {{ optional($order->user)->name }}
                </p>
                <p>
                    {{ optional($order->user)->email }}
                </p>
                <p>
                    {{ optional($order->user)->mobile }}
                </p>
                <p>
                    {{ implode(', ', $order->orderTables->pluck('table.name')->toArray()) }}
                </p>

            </td>
        </tr>
    </table>
    <div id="invoice-POS">
        <div id="bot">
            <div id="table">
                <table style="width: 100%; margin: 6px 0;">
                    <tr class="tabletitle" style="width: 100%;">
                        <td style="text-align: left;min-width:">
                            <h3>Item</h3>
                        </td>
                        <td style="text-align: right;">
                            <h3>QTY</h3>
                        </td>
                        <td style="text-align: center;">
                            <h3>Price</h3>
                        </td>

                        {{-- <td style="text-align: center;">
                            <h3>VAT </h3>
                        </td> --}}
                        <td style="text-align: center;">
                            <h3>Total</h3>
                        </td>
                    </tr>
                    @php
                        $totalVat = 0;

                    @endphp
                    @foreach ($order->orderItems as $key => $orderitem)
                        @php
                            $vat = $orderitem->unit_price - $orderitem->unit_price / 1.15;
                            $qtyVat = $vat * $orderitem->qty;
                            // $totalVat+=$qtyVat;
                        @endphp
                        <tr class="item last" style="width: 100% !important;">
                            <td style="text-align: left;">{{ optional($orderitem->item)->name }}</td>
                            <td style="text-align: center;"> {{ round($orderitem->qty) }}</td>
                            <td style="text-align: right;">{{ number_format($orderitem->unit_price, 2) }}
                            </td>
                            {{-- <td style="text-align: left;">{{ number_format($vat, 2) }}</td> --}}
                            <td style="text-align: right;">{{ number_format($orderitem->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                    {{-- @dd($totalVat); --}}

                </table>
                <hr />
                <table>
                    <tr class="">
                        <td class="Rate" style="width: 50%; text-align: left;">
                            <h2>Sub total</h2>
                        </td>
                        <td class="payment" style="width: 50%; text-align: right;">
                            {{ number_format($order->sub_total, 2) }} BDT
                        </td>
                    </tr>
                    <tr class="">
                        <td class="Rate">
                            <h2>Discount ({{ round($order->discount) }}@if ($order->discount_type == 'percent')
                                %@else৳
                                @endif)
                            </h2>
                        </td>
                        <td class="payment" style="text-align: right;">
                            ({{ number_format($order->discount_amount, 2) }}) BDT
                        </td>
                    </tr>

                    <tr class="">
                        <td class="Rate">
                            <h2>Service Charge:</h2>
                        </td>
                        <td class="payment" style="text-align: right;">
                            {{ number_format($order->service_charge ?? 0, 2) }} BDT
                        </td>
                    </tr>
                    <tr class="">
                        <td class="Rate">
                            <h2>Payble Amount:</h2>
                        </td>
                        <td class="payment" style="text-align: right;">
                            {{ number_format($order->payable_amount, 2) }} BDT
                        </td>
                    </tr>
                    {{-- <tr class="">
                        <td class="Rate">
                            <h2>Advance Paid:</h2>
                        </td>
                        <td class="payment" style="text-align: right;">
                            32434b BDT
                        </td>
                    </tr>
                    <tr class="">
                        <td class="Rate">
                            <h2>Recent pay:</h2>
                        </td>
                        <td class="payment" style="text-align: right;">
                            23434324 BDT
                        </td>
                    </tr> --}}
                    <tr class="">
                        <td class="Rate">
                            <h2>Payment method</h2>
                        </td>
                        {{-- @dd($order->paymentHistories->pluck('paymentSystem.name')) --}}
                        <td class="payment" style="text-align: right;">
                            {{ implode(', ', $order->paymentHistories->pluck('paymentSystem.name')->toArray()) }}
                        </td>
                    </tr>
                </table>

                <table cellpadding="0" cellspacing="0" style="margin-top: 30px;">
                    <tr style="text-align: center; margin-bottom:30px;">
                        <td>
                            <h5>Note: Vat Included With Price.</h5>
                            <h5 style="margin-bottom:10px;">Thanks For Coming!</h5>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Software By <br />
                            <a href="https://www.iciclecorporation.com/"
                                style="color:rgb(43, 43, 43); text-decoration:none; letter-spacing:2px" target="_blank">
                                <span>iciclecorporation.com</span>
                            </a>
                        </th>
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
    window.print();
</script>

</html>
