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
        @media print {
            .print-fixed {
                position: fixed;
            }
        }

        p {
            margin: 0;
        }

        td,
        th {
            padding: 0.25rem 0.5rem !important;
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
            border: 1px solid #ddd;
            padding: 20px;
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
            }

            hr {
                border-top: 2px dashed #c2c2c2;
            }
        }
    </style>
</head>

<body>
    <div class="mt-3 prescription">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <img src="{{ asset('assets/moneyReceipt/logo_bipsh.png') }}" style="width: 180px;" alt="">
            </div>
            <h2 style="font-weight: bold; color: #f97316;">
                Al-Afiyah Lab Unit
            </h2>
            <div>
                <img src="{{ asset('assets/moneyReceipt/logo.png') }}" width="90" alt="">
            </div>
        </div>
        <div class="text-center my-3">
            <span class="border px-4 py-2" style="font-family: monospace;">
                MONEY RECEIPT
            </span>
        </div>

        <table class="table table-borderless my-2" style="font-size: 12px;">
            <tbody>
                <tr>
                    <td>
                        <Strong>
                            Invoice No.
                        </Strong>
                        LB-{{ $labInvoice->invoice_no }}
                    </td>
                    <td rowspan="4">
                        <div class="d-flex justify-content-center align-items-center">
                            <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('#Al-Afiyah-Dialysis-Center# AP-' . $labInvoice->invoice_number . ' PID-' . optional($labInvoice->patient)->patientId, 'QRCODE') }}"
                                alt="barcode"style="width: 100px;" />
                        </div>
                    </td>
                    <td style="text-align: right;">
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
                        <strong>Delivery Date</strong> : {{ date('d-m-Y', strtotime($labInvoice->date)) }}
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
                        <strong>Age </strong> : {{ $diff->y }} Years {{ $diff->m }} Months
                        {{ $diff->d }}
                        Days
                    </td>
                </tr>
                <tr>
                    <td>
                        <Strong>
                            Consultant
                        </Strong>
                        :
                        {{ optional($labInvoice->doctor)->first_name . ' ' . optional($labInvoice->doctor)->last_name }}
                        ({{ optional(optional($labInvoice->doctor)->designation)->name }})
                    </td>
                    <td style="text-align: right;">
                        <strong>Appt. Time </strong> :
                        {{ date('d-m-Y h.i A', strtotime($labInvoice->labInvoice_date)) }}
                    </td>
                </tr>
            </tbody>
        </table>



        <table style="font-size: 12px;" class="table table-bordered">
            <tbody>
                <tr class="text-center">
                    <th>
                        Sl.
                    </th>
                    <th>
                        Particulars
                    </th>
                    <th>
                        Amount
                    </th>
                </tr>
                @foreach ($labInvoice->labTest as $key => $labTest)
                    <tr>
                        <td>
                            {{ $key + 1 }}
                        </td>
                        <td>
                            {{ $labTest->testName->name }}
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
                <table class="table table-bordered" style="font-size: 12px;">
                    <tbody>
                        <tr>
                            <td>
                                Bill Amount
                            </td>
                            <td class="text-right">
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
            <i style="color: #727272;">
                <small>
                    Received with thanks : {!! Helper::wordConvertor($labInvoice->doctor_fee) !!}
                </small>
            </i>
        </p>

        <div class="print-fixed" style="bottom: 10px; left:0; right: 0; width: 95%; margin: 0 auto; ">
            <div class="pt-5">
                <div class="col-6 ml-auto">
                    <div class="d-flex">
                        <p>
                            <Strong>
                                Signature:
                            </Strong>
                        </p>
                        <p style="border-bottom: 2px dashed #727272; width: 100%;">

                        </p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center" style="font-size: 12px; ">
                <strong>
                    Hotline : 01844-5583151
                </strong>

                <p style="text-align: right;">
                    House 13, Road-2, Dhanmondi, Dhaka, Bangladesh
                    <br>
                    Call : 01844-5583151 | Email : alaﬁayah@gmail.com <br> Web : https://www.alaﬁyahbd.com
                </p>
            </div>
        </div>

    </div>
</body>

</html>
