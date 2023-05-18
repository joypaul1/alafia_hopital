<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                                Invoice No:
                            </Strong>
                            LB-{{ $radiologyServiceInvoice->invoice_no }}
                        </td>
                        <td rowspan="5">
                            <div class="d-flex justify-content-center align-items-center">

                                @php
                                    echo DNS1D::getBarcodeHTML(strval($radiologyServiceInvoice->id), 'C128');
                                @endphp

                            </div>
                        </td>
                        <td style="text-align: right; width: 40%;">
                            <strong>Bill Date</strong> : {{ date('d-m-Y h:i a', strtotime($radiologyServiceInvoice->date)) }}
                        </td>
                    </tr>
                    @php
                        $bday = new DateTime(optional($radiologyServiceInvoice->patient)->dob); // Your date of birth
                        $today = new Datetime(date('m.d.y'));
                        $diff = $today->diff($bday);
                    @endphp
                    <tr>
                        <td>
                            <Strong>
                                PID
                            </Strong>
                            : {{ optional($radiologyServiceInvoice->patient)->patientId }}
                        </td>
                        <td style="display: flex;text-align: right; justify-content:flex-end;gap:4px;">
                            <p>
                                <strong>Age </strong> :
                                {{ $diff->y }} Years {{ $diff->m }} Months
                                {{ $diff->d }}
                                Days
                            </p>
                            <p style="display: flex">
                                <Strong>
                                    Sex
                                </Strong>
                                : <span
                                    style="text-transform: capitalize;">{{ optional($radiologyServiceInvoice->patient)->gender ? optional($radiologyServiceInvoice->patient)->gender[0] : '' }}</span>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <Strong>
                                Name
                            </Strong>
                            : {{ optional($radiologyServiceInvoice->patient)->name }}
                        </td>
                        <td style="text-align: right;">
                            <strong>Mobile </strong> :
                            {{ optional($radiologyServiceInvoice->patient)->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Emergency Contact </strong> :
                            {{ optional($radiologyServiceInvoice->patient)->emergency_contact }}
                        </td>
                        <td style="text-align: right;">
                            {{-- <strong>Emergency Contact </strong> :
                            {{ optional($radiologyServiceInvoice->patient)->emergency_contact }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <Strong>
                                Referred By
                            </Strong>
                            :
                            {{ optional($radiologyServiceInvoice->doctor)->first_name . ' ' . optional($radiologyServiceInvoice->doctor)->last_name }}
                            ({{ optional(optional($radiologyServiceInvoice->doctor)->designation)->name }})
                        </td>
                    </tr>
                </tbody>
            </table>



            <table style="font-size: 12pt;" class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width: 5%;">
                            Sl.
                        </th>
                        <th style="width: 40%;">
                            Test Name
                        </th>
                        <th class="text-right" style="width: 15%;">
                            Price
                        </th>
                        <th style="width: 10%;" class="text-right">
                            Discount
                        </th>
                        <th style="width: 10%;" class="text-right">
                            SubTotal
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $si = 0;
                    @endphp

                    @foreach ($radiologyServiceInvoice->itemDetails as $labTest)
                        @php
                            $si += 1;
                        @endphp
                        <tr>
                            <td>
                                {{ $si }}
                            </td>

                            <td>
                                {{ $labTest->serviceName->name }}
                            </td>
                            <td class="text-right">
                                {{ number_format($labTest->price, 2) }}
                            </td>
                            <td class="text-right">
                                {{ number_format($labTest->discount_amount, 2) }}
                                <!-- </br> -->
                                ({{ round($labTest->discount) }}{{ $labTest->discount_type == 'percentage' ? '%' : 'TK' }})
                            </td>
                            <td class="text-right">
                                {{ number_format($labTest->subtotal, 2) }}
                            </td>



                        </tr>
                    @endforeach


                </tbody>
            </table>

            <table class="table table-bordered t">
                <tbody>
                    <tr>
                        <td rowspan="6" style="vertical-align: middle; width:20%;">
                            <div class="d-flex justify-content-center align-items-center">
                                <div style="border: 2px solid #333; font-weight: bold; outline: 1px solid #333; outline-offset: 2px;"
                                    class="h2 px-4 py-2">
                                    {{ ucwords($radiologyServiceInvoice->payment_status) }}
                                </div>
                            </div>
                        </td>
                        <td style="width:25%;">
                           Total Bill
                        </td>
                        <td class="text-right" style="width: 35%;">
                            {{ number_format($radiologyServiceInvoice->itemDetails->sum('price'), 2) }}
                        </td>
                        <td style="width: 45%;vertical-align: middle;" rowspan="6">
                            <div class="d-flex justify-content-center align-items-center h-100">
                                <div class="text-center">
                                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG('#Al-Afiyah-Dialysis-Center# AP-' . $radiologyServiceInvoice->invoice_number . ' PID-' . optional($radiologyServiceInvoice->patient)->patientId, 'QRCODE') }}"
                                        alt="QR Code" style="width: 100px;" />
                                    <p>Online Test Report</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Discount Amount
                        </td>
                        <td class="text-right">
                            {{ number_format($radiologyServiceInvoice->itemDetails->sum('discount_amount'), 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Payable Amount
                        </td>
                        <td class="text-right">
                            {{ number_format($radiologyServiceInvoice->total_amount, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Cash Paid
                        </td>
                        <td class="text-right">
                            {{ number_format($radiologyServiceInvoice->paid_amount, 2) }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>
                                Due Amount
                            </strong>
                        </td>
                        <td class="text-right ">
                            <strong>
                                {{ number_format($radiologyServiceInvoice->due_amount, 2) }}
                            </strong>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Payment Type
                        </td>
                        <td class="text-right">
                            Cash
                        </td>
                    </tr>
                </tbody>
            </table>



            <p class="text-center">
                <i style="color: #000;">
                    <small style="text-transform:capitalize;">
                        Received with thanks : {!! Helper::wordConvertor(round($radiologyServiceInvoice->paid_amount)) !!} Taka Only
                    </small>
                </i>
            </p>
            <p class="mt-5 pt-4">
                যে সকল রুমে যাবেন:
            </p>
            <table style="font-size: 12pt;" class="table table-bordered mt-0 t">

                <tbody>
                    <tr>
                        <th style="text-align: center">
                            5th Floor
                        </th>
                        <th style="text-align: center">
                            8th Floor
                        </th>
                        <th style="text-align: center">
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
                            <span style="padding: 4px 8px;">512</span>
                        </td>
                        <td>
                            Dialysis Unit
                        </td>
                        <td>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">901</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">902</span>
                            <span style="border-right: 1px solid #333; padding: 4px 8px;">903</span>
                            <span style="padding: 4px 8px;">904</span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p class="text-center">
                <small>
                    <i>
                        <strong>
                            ডেলিভারী তারিখ হতে ৩০ দিনের মধ্যে রিপোর্ট সংগ্রহ করতে হবে।
                        </strong>
                    </i>
                </small>
            </p>
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
<script>
    $(document).ready(function() {
        window.print();
    });
</script>
