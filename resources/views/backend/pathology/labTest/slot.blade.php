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
                    Slot RECEIPT
                </span>
            </div>

            <table class="table table-borderless my-2" style="font-size: 12pt;">
                <tbody>
                    <tr>
                        <td style="width: 40%;">
                            <Strong>
                                {{-- Slot No: {{ $labInvoices[0]->slot_number }} --}}
                            </Strong>

                        </td>
                        <td rowspan="5">

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <Strong>
                                Date
                            </Strong>
                            : {{ date('d-M-Y h:i A') }}
                        </td>

                    </tr>

                </tbody>
            </table>


            <table style="font-size: 12pt;" class="table table-bordered t">
                <tbody>
                    <tr>
                        <th style="width: 5%;">
                            PI
                        </th>
                        <th>
                            Invoice No.
                        </th>
                        <th >
                            PId.
                        </th>
                        <th >
                            Name
                        </th>
                        <th style="width: 40%;">
                            Test Name
                        </th>

                        <th >
                            Status
                        </th>

                    </tr>

                    @foreach ($labInvoices as $key => $labInvoice)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td class="text-center">{{ $labInvoice->invoice_no }}</td>
                            <td class="text-center">{{ $labInvoice->patient->id }}</td>
                            <td class="text-center">{{ $labInvoice->patient->name }}</td>
                            {{-- @dd($labInvoice->labTestDetails->pluck('testName')) --}}
                            <td class="text-center">
                                @foreach ($labInvoice->labTestDetails->pluck('testName') as $item)
                                    {{ $item->name }} ,
                                @endforeach
                            </td>
                            {{-- <td class="text-center">{{  }}</td> --}}

                        </tr>
                        {{-- @foreach ($labInvoice->labTestDetails as $labTest)
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



                                <td>
                                    {{ date_format(date_create($labTest->delivery_time), 'd-m-Y h:i A') }}
                                </td>
                            </tr>
                        @endforeach --}}
                    @endforeach



                </tbody>

            </table>
            <footer>

                <img src="{{ asset('assets/moneyReceipt/fpathology.png') }}" style="width: 100%;" alt="">
            </footer>








        </div>



    </div>

    </div>
</body>


</html>
<script>
    $(document).ready(function() {
        window.print();
    });
</script>
