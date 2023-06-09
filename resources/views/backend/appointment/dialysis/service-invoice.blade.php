<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        p {
            margin: 0;
        }

        td,
        th {
            padding: 0.25rem 0.5rem !important;
        }

        .t td,
        .t tr,
        .t th {
            border: 1pt solid #a3a3a3 !important;
        }

        * {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: aliceblue;
        }

        .prescription {
            width: 19cm;
            margin: 0 auto 0 auto;
            background-color: white;
        }

        /* Style for print media */
        @media print {
            body * {
                visibility: hidden;
            }

            body {
                background-color: #fff;
            }

            .prescription,
            .prescription * {
                visibility: visible;
            }

            .prescription {
                width: 100% !important;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                margin: 0 !important;
                padding: 0 !important;
            }

            hr {
                border-top: 2px dashed #c2c2c2;
            }

            footer {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="prescription">
        <img src="{{ asset('assets/moneyReceipt/hdilysis.png') }}" style="width: 100%;" alt="">
        <div style="padding: 0 0.5in;">
            <div class="text-center mt-3 mb-4">
                <span class="px-4 py-2" style="font-family: monospace; border: 2pt #a3a3a3 solid !important;">
                    MONEY RECEIPT
                </span>
            </div>
            <table class="table table-borderless my-2" style="font-size: 12pt;">
                <tbody>
                    <tr>
                        <td style="width: 40%">
                            <Strong>
                                Invoice No.
                            </Strong>
                            DIA-{{ $serviceInvoice->invoice_no }}
                        </td>
                        <td rowspan="4">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('#Al-Afiyah-Dialysis-Center# DIA-' . $serviceInvoice->invoice_no . ' PID-' . optional($serviceInvoice->patient)->patientId, 'QRCODE') }}"
                                    alt="barcode" style="width: 100px;" />
                            </div>
                        </td>
                        <td style="text-align: right; width: 40%">
                            <strong>Bill Date</strong> : {{ date('d-m-Y h.i A', strtotime($serviceInvoice->date)) }}
                        </td>
                    </tr>
                    {{-- @dd($serviceInvoice->patient); --}}
                    <tr>
                        <td>
                            <Strong>
                                PID
                            </Strong>
                            : {{ optional($serviceInvoice->patient)->patientId }}
                        </td>
                        <td style="text-align: right; width: 40%">
                            <strong>Mobile</strong> : {{ optional($serviceInvoice->patient)->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Strong>
                                Name
                            </Strong>
                            : {{ optional($serviceInvoice->patient)->name }}
                        </td>
                        @php
                            $bday = new DateTime(optional($serviceInvoice->patient)->dob); // Your date of birth
                            $today = new Datetime(date('m.d.y'));
                            $diff = $today->diff($bday);
                        @endphp
                        <td style="text-align: right;">
                            <strong>Age </strong> : {{ $diff->y }} Years {{ $diff->m }} Months
                            {{ $diff->d }} Days
                        </td>
                    </tr>
                    <tr>
                        {{-- @if (optional($serviceInvoice->asignEmp)->name) --}}
                        <td>
                            <Strong>
                                Sex
                            </Strong>
                            : <span
                                style="text-transform: capitalize;">{{ optional($serviceInvoice->patient)->gender }}</span>
                        </td>
                        {{-- @endif --}}


                    </tr>
                    {{-- <tr>
                                                <td colspan="3">
                            <Strong>
                                Asign To
                            </Strong>
                            : {{ optional($serviceInvoice->asignEmp)->name}} {{ optional(optional($serviceInvoice->asignEmp)->designation)->name??' '}}
                        </td>
                    </tr> --}}
                </tbody>
            </table>


            <table style="font-size: 12pt;" class="table table-bordered t">
                <tbody>
                    <tr>
                        <th>
                            Sl.
                        </th>
                        <th>
                            Particular Service
                        </th>
                        <th class="text-right">
                            Qty
                        </th>
                        <th class="text-right">
                            U.Price
                        </th>
                        <th class="text-right" style="width: 150px">
                            Sub Total
                        </th>
                    </tr>
                    {{-- @dd($serviceInvoice->itemDetails ); --}}
                    @foreach ($serviceInvoice->itemDetails as $key => $item)
                        <tr>
                            <td>
                                {{ $key + 1 }}
                            </td>
                            <td>
                                {{ $item->serviceName->name }}
                            </td>
                            <td class="text-right">
                                {{ number_format($item->qty, 2) }}

                            </td>
                            <td class="text-right">
                                {{ number_format($item->service_price, 2) }}
                            </td>
                            <td class="text-right">
                                {{ number_format($item->subtotal, 2) }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <div class="row">
                <div class="col-6">
                    <div class="d-flex justify-content-center align-items-center h-100">
                        <div style="border: 2px solid #333; font-weight: bold; outline: 1px solid #333; outline-offset: 2px;"
                            class="h2 px-4 py-2">
                            PAID
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <table class="table table-bordered t" style="font-size: 12pt;">
                        <tbody>
                            <tr>
                                <td>
                                    Bill Amount
                                </td>
                                <td class="text-right" style="width: 150px">
                                    {{ number_format($serviceInvoice->total, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Discount
                                    @if ($serviceInvoice->discount_type == 'percentage')
                                        ({{ number_format($serviceInvoice->discount, 2) }}%)
                                    @else
                                        ({{ number_format($serviceInvoice->discount, 2) }} 'TK')
                                    @endif
                                </td>
                                <td class="text-right">
                                    {{ number_format($serviceInvoice->discount_amount, 2) }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Payable Amount
                                </td>
                                <td class="text-right">
                                    {{ number_format($serviceInvoice->total, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cash Paid
                                </td>
                                <td class="text-right">
                                    {{ number_format($serviceInvoice->total, 2) }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                    <strong>
                                        Due Amount
                                    </strong>
                                </td>
                                <td class="text-right">
                                    <strong>
                                        0.00
                                    </strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <p class="text-center">
                <i style="color: #000000;">
                    <small style="text-transform:capitalize;">
                        Received with thanks : {!! Helper::wordConvertor(round($serviceInvoice->total)) !!} Taka Only
                    </small>
                </i>
            </p>
            {{-- <p class="mt-5 pt-4">
                Room You have to visit:
            </p>
            <table style="font-size: 12pt;" class="table table-bordered mt-0 t">

                <tbody>
                    <tr>
                        <th>
                            1st Floor
                        </th>
                        <th>
                            2nd Floor
                        </th>
                    </tr>
                    <tr>
                        <td>
                            103, 106
                        </td>
                        <td>
                            212, 215
                        </td>
                    </tr>
                </tbody>
            </table> --}}

        </div>

        <footer>
            <div class="pt-5" style="padding:0 0.5in;">
                <div class="col-3 p-0 ml-auto">
                    <div class="d-flex">
                        <p>
                            <Strong>
                                Signature:
                            </Strong>
                        </p>
                        <p class="text-center" style="border-bottom: 2px dashed #727272; width: 100%;">
                        </p>
                    </div>
                    <div class="text-center">
                        Prepared By : {{ auth('admin')->user()->name }}
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/moneyReceipt/fdilysis.png') }}" style="width: 100%;" alt="">
        </footer>

    </div>

    </div>
</body>

</html>
<script>
    window.print();
</script>
