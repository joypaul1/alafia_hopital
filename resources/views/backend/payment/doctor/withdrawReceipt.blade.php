<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
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
        <img src="{{ asset("assets/moneyReceipt/h-doctor.png") }}" style="width: 100%;" alt="">
        <div style="padding: 0 0.5in;">
            <div class="text-center mt-3 mb-4">
                <span class="px-4 py-2" style="font-family: monospace; border: 2pt #a3a3a3 solid !important;">
                    WITHDRAW MONEY RECEIPT
                </span>
            </div>
            <table class="table table-borderless my-2" style="font-size: 14pt;">
                <tbody>
                    <tr>
                        <td colspan="3">
                            <Strong>
                                Doctor Name
                            </Strong>
                            : {{ optional($doctorWithDrawHistory->doctor)->first_name.' '. optional($doctorWithDrawHistory->doctor)->last_name}}
                             ({{ optional(optional($doctorWithDrawHistory->doctor)->designation)->name}})
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Strong>
                                Depertment
                            </Strong>
                            : {{ optional(optional($doctorWithDrawHistory->doctor)->department)->name}}

                        </td>

                    </tr>
                    <tr>
                        <td>
                            <strong>Withdraw Date </strong> :
                            {{ date('d-m-Y h:i A', strtotime($doctorWithDrawHistory->date))  }}
                        </td>
                    </tr>


                </tbody>
            </table>


            <table style="font-size: 14pt;" class="table table-bordered t">
                <tbody>
                    <tr>
                        <th style="width: 50px;">
                            Sl.
                        </th>
                        <th>
                            Payment Received Method
                        </th>
                        <th class="text-right" style="width: 120px;">
                            Amount
                        </th>
                    </tr>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            {{ optional($doctorWithDrawHistory->paymentMethod)->name }}

                        </td>
                        <td class="text-right" style="width: 200px;">
                            {{ number_format($doctorWithDrawHistory->amount, 2) }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col-4">

                </div>
                {{-- @dd($doctorWithDrawHistory->discount) --}}
                <div class="col-8">
                    <table class="table table-bordered t" style="font-size: 14pt;">
                        <tbody class="text-right">

                            <tr>
                                <td>
                                   Total Withdraw

                                </td>
                                <td  style="width: 200px;">
                                    {{ number_format($doctorWithDrawHistory->amount, 2) }}
                                </td>
                            </tr>
                            <tr >
                                <td>
                                   Current Balance
                                </td>
                                <td style="width: 200px;">
                                    {{ number_format($doctorWithDrawHistory->doctor->ledger->balance, 2) }}
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>

            <p class="text-center">
                <i style="color: #000;">
                    <small style="text-transform:capitalize;">
                        Withdraw Amount : {!! Helper::wordConvertor(round($doctorWithDrawHistory->amount))!!} Taka Only
                    </small>
                </i>
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
            <img src="{{ asset('assets/moneyReceipt/fdoctor.png') }}" style="width: 100%;" alt="">

            {{-- <img src="{{ asset("assets/moneyReceipt/roomF.png") }}" style="width: 100%;" alt=""> --}}
        </footer>

    </div>

    </div>
</body>
<script>
    window.print();

</script>
</html>
