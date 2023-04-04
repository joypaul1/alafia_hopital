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
        <img src="{{ asset('assets/moneyReceipt/hpathology.png') }}" style="width: 100%;" alt="">
        <div style="padding: 0 0.5in;">
            <div class="text-center mt-3 mb-4">
                <span class="px-4 py-2" style="font-family: monospace; border: 2pt #a3a3a3 solid !important;">
                    MONEY RECEIPT
                </span>
            </div>

            <table class="table table-borderless my-2" style="font-size: 12pt;">
                <tbody>
                    <tr>
                        <td style="width: 40%;">
                            <Strong>
                                Invoice No.
                            </Strong>
                            LB-{{ $labInvoice->invoice_no }}
                        </td>
                        <td rowspan="4">
                            <div class="d-flex justify-content-center align-items-center">
                                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('#Al-Afiyah-Dialysis-Center# AP-' . $labInvoice->invoice_number . ' PID-' . optional($labInvoice->patient)->patientId, 'QRCODE') }}"
                                    alt="QR Code" style="width: 100px;" />
                            </div>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <strong>Bill Date</strong> : {{ date('d-m-Y h:i:s', strtotime($labInvoice->date)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Strong>
                                PID
                            </Strong>
                            : {{ optional($labInvoice->patient)->patientId }}
                        </td>
                        <td style="text-align: right;">
                            <strong>Sex </strong> :
                            <span
                                style="text-transform: capitalize;">{{ optional($labInvoice->patient)->gender }}</span>
                        </td>
                    </tr>
                    @php
                        $bday = new DateTime(optional($labInvoice->patient)->dob); // Your date of birth
                        $today = new Datetime(date('m.d.y'));
                        $diff = $today->diff($bday);
                    @endphp
                    <tr>
                        <td>
                            <Strong>
                                Name
                            </Strong>
                            : {{ optional($labInvoice->patient)->name }}
                        </td>
                        <td style="text-align: right;">
                            <strong>Mobile </strong> :
                            {{  optional($labInvoice->patient)->mobile}}
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <strong>Age </strong> : {{ $diff->y }} Years {{ $diff->m }} Months
                            {{ $diff->d }}
                            Days
                        </td>

                        <td style="text-align: right;">

                        </td>

                    </tr>
                    <tr>
                        <td colspan="3">
                            <Strong>
                                Referred By
                            </Strong>
                            :
                            {{ optional($labInvoice->doctor)->first_name . ' ' . optional($labInvoice->doctor)->last_name }}
                            ({{ optional(optional($labInvoice->doctor)->designation)->name }})
                        </td>
                    </tr>
                </tbody>
            </table>


            <table style="font-size: 12pt;" class="table table-bordered t">
                <tbody>
                    <tr class="text-center">
                        <th style="width: 50px;">
                            Sl.
                        </th>
                        <th>
                            Particulars
                        </th>
                        <th class="text-right" style="width: 120px;">
                            Amount
                        </th>
                    </tr>
                    @php
                        $si = 0;
                    @endphp

                    @foreach ($labInvoice->labTestDetails as $key => $labTest)
                        @php
                            $si += 1;
                        @endphp
                        <tr>
                            <td>
                                {{ $si }}
                            </td>
                            <td>
                                {{ $labTest->testName->name }}
                            </td>
                            <td class="text-right">
                                {{ number_format($labTest->price, 2) }}
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($labInvoice->labTestTube as $key => $labTest)
                        @php
                            $si += 1;
                        @endphp
                        <tr>
                            <td>
                                {{ $si }}
                            </td>
                            <td>
                                Vacutainer {{ $labTest->tubeName->name }}
                            </td>
                            <td class="text-right">
                                {{ number_format($labTest->price, 2) }}
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
                                <td class="text-right" style="width: 120px;">
                                    {{ number_format($labInvoice->doctor_fee, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Discount Amount
                                </td>
                                <td class="text-right">
                                    00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Vat Amount
                                </td>
                                <td class="text-right ">
                                    00
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Payable Amount
                                </td>
                                <td class="text-right">
                                    {{ number_format($labInvoice->total_amount, 2) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Cash Paid
                                </td>
                                <td class="text-right">
                                    {{ number_format($labInvoice->total_amount, 2) }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>

                                    Due Amount

                                </td>
                                <td class="text-right ">

                                    0.00

                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <p class="text-center">
                <i style="color: #000;">
                    <small style="text-transform:capitalize;">
                        Received with thanks : {!! Helper::wordConvertor(round($labInvoice->total_amount)) !!} Taka Only
                    </small>
                </i>
            </p>
            <p class="mt-5 pt-4">
                Room You have to visit:
            </p>
            <table style="font-size: 12pt;" class="table table-bordered mt-0 t">

                <tbody>
                    <tr>
                        <th>
                            5th Floor
                        </th>
                        <th>
                            8th Floor
                        </th>
                        <th>
                            9th Floor
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">501</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">502</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">503</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">504</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">505</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">506</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">507</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">508</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">509</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">510</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">511</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">512</span>
                        </td>
                        <td>
                            Dialysis Unit
                        </td>
                        <td>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">901</span>
                            <span style="padding: 4px 8px;">902</span>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <footer>
            <div class="pt-5" style="padding:0 0.5in;">
                <div class="col-4 p-0 ml-auto">
                    <div class="d-flex">
                        <p>
                            <Strong>
                                Signature:
                            </Strong>
                        </p>
                        <p class="text-center" style="border-bottom: 2px dashed #727272; width: 100%;">
                        </p>
                    </div>
                    <div class="text-right">
                        Prepared By : {{ auth('admin')->user()->name }}
                    </div>
                </div>
            </div>
            <img src="{{ asset('assets/moneyReceipt/fpathology.png') }}" style="width: 100%;" alt="">
        </footer>

    </div>

    </div>
</body>

</html>


@push('js')
    <script>
        $(document).ready(function() {
            window.print();
        });
    </script>
@endpush
