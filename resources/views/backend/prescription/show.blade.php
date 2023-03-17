
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            font-size: 16pt !important;
        }

        p {
            margin: 0;
        }

        td {
            padding: 0.25rem 0.5rem !important;
        }

        * {
            font-family: 'Times New Roman', Times, serif;
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
                <img src="{{ asset("assets/moneyReceipt/logo_bipsh.png") }}" style="width: 180px;" alt="">
            </div>
            <h2 style="font-weight: bold;color: #f97316;">
                Al-Afiyah Dialysis Unit
            </h2>
            <div>
                <img src="src="{{ asset("assets/moneyReceipt/logo.png") }}" " width="90" alt="">
            </div>
        </div>
        <table class="table table-bordered my-3" style="font-size: 12px;">
            <tbody>
                <tr>
                    <td>
                        <Strong>
                            PID
                        </Strong>
                    </td>
                    <td>
                        0000002
                    </td>
                    <td>
                        <Strong>
                            Prescription No.
                        </Strong>
                    </td>
                    <td>
                        PS-0000001
                    </td>
                    <td>
                        <Strong>
                            Date
                        </Strong>
                    </td>
                    <td>
                        19-03-2023 02:00 PM
                    </td>

                </tr>
                <tr>
                    <td>
                        <Strong>
                            Name
                        </Strong>
                    </td>
                    <td colspan="3">
                        Joy
                    </td>
                    <td>
                        <Strong>
                            Age
                        </Strong>
                    </td>
                    <td>
                        25 Years 0 Months 23 Days
                    </td>
                </tr>
                <tr>
                    <td>
                        <Strong>
                            Sex
                        </Strong>
                    </td>
                    <td>
                        Female
                    </td>
                    <td>
                        <Strong>
                            Contact No.
                        </Strong>
                    </td>
                    <td>
                        01700000000
                    </td>
                    <td>
                        <Strong>
                            Weight
                        </Strong>
                    </td>
                    <td>
                        ―
                    </td>
                </tr>
                <tr>
                    <td>
                        <Strong>
                            Ref By
                        </Strong>
                    </td>
                    <td colspan="4">
                        Dr. Abdul Hai (Medicine)
                    </td>
                    <td>
                        Dhaka
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <img src="./code.png" style="width: 100px;" alt="">
            <img src="./code.png" style="width: 100px;" alt="">
        </div>

        <div class="my-2 p-2" style="font-size: 14px; border: 2px dashed #c5c5c5;">
            <div class="row">
                <div class="col-4" style="border-right: 2px dashed #c5c5c5;">
                    <p>
                        <Strong>
                            Patient History
                        </Strong>
                    </p>
                    <ul>
                        <li>
                            BP : 120/80
                        </li>
                        <li>
                            Pulse : 80
                        </li>
                        <li>
                            Temperature : 101.6˚ F
                        </li>
                    </ul>
                    <p>
                        <Strong>
                            Chief Complaint
                        </Strong>
                    </p>
                    <ul>
                        <li>
                            Fever
                        </li>
                        <li>
                            Cough
                        </li>
                        <li>
                            Cold
                        </li>
                    </ul>
                    <p>
                        <Strong>
                            Diagnosis
                        </Strong>
                    </p>
                    <ol>
                        <li>
                            <!-- Medicine Diagnosis -->
                            Viral Infection
                        </li>
                        <li>
                            Bacterial Infection
                        </li>
                    </ol>
                </div>
                <div class="col-8">
                    <h5>
                        <strong>
                            Rx,
                        </strong>
                    </h5>
                    <ol>
                        <li>
                            <div>
                                <p>
                                    <strong>
                                        Nape Extra 500 mg
                                    </strong>
                                </p>
                                <div class="d-flex justify-content-between my-1">
                                    <p>
                                        1-0-1
                                    </p>
                                    <p class="mx-2">
                                        After Meal
                                    </p>
                                    <p>
                                        5 Days
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <p>
                                    <strong>
                                        Paracetamol 500 mg
                                    </strong>
                                </p>
                                <div class="d-flex justify-content-between my-1">
                                    <p>
                                        1-0-1
                                    </p>
                                    <p class="mx-2">
                                        After Meal
                                    </p>
                                    <p>
                                        5 Days
                                    </p>
                                </div>
                            </div>
                        </li>

                    </ol>

                    <p>
                        <Strong>
                            Advice
                        </Strong>
                    </p>
                    <ul>
                        <li>
                            Do not drink cold water or cold drinks or eat ice cream.
                        </li>
                        <li>
                            Do not carry heavy weight or do heavy work. Take rest for 2-3 days.
                        </li>
                    </ul>

                    <p>
                        <Strong>
                            Next Follow Up :
                        </Strong>
                        After 5 Days
                    </p>
                    <small style="color: #727272;">
                        <i>
                            [ Note : Please make appointment before next visit. ]
                        </i>
                    </small>
                </div>
            </div>
        </div>

        <div class="position-fixed" style="bottom: 10px; left:0; right: 0; width: 95%; margin: 0 auto; ">
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
