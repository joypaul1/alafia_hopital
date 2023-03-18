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
                <img src="{{ asset('assets/moneyReceipt/logo_bipsh.png') }}" style="width: 180px;" alt="">
            </div>
            <h2 style="font-weight: bold; color: #f97316;">
                Al-Afiyah Doctors' Chamber
            </h2>
            <div>
                <img src="{{ asset('assets/moneyReceipt/logo.png') }}" width="90" alt="">
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
                        {{ $prescription->patient->id }}
                    </td>
                    <td>
                        <Strong>
                            Prescription No.
                        </Strong>
                    </td>
                    <td>
                        PS-{{ $prescription->invoice_number }}
                    </td>
                    <td>
                        <Strong>
                            Date
                        </Strong>
                    </td>
                    <td>
                        {{ $prescription->created_at->format('d-m-Y') }}
                    </td>

                </tr>
                <tr>
                    <td>
                        <Strong>
                            Name
                        </Strong>
                    </td>
                    <td colspan="3">
                        {{ $prescription->patient->name }}
                    </td>
                    <td>
                        <Strong>
                            Age
                        </Strong>
                    </td>
                    <td>
                        {{ $prescription->patient->age }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <Strong>
                            Sex
                        </Strong>
                    </td>
                    <td>
                        {{ $prescription->patient->gender }}
                    </td>
                    <td>
                        <Strong>
                            Contact No.
                        </Strong>
                    </td>
                    <td>
                        {{ $prescription->patient->mobile }}

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
                        {{ $prescription->doctor->first_name }} {{ $prescription->doctor->last_name }}
                    </td>
                    <td>
                        Dhaka
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="my-2 p-2" style="font-size: 14px; border: 2px dashed #c5c5c5;">
            <div class="row">
                <div class="col-4" style="border-right: 2px dashed #c5c5c5;">
                    <p>
                        <Strong>
                            Patient History
                        </Strong>
                    </p>
                    <ul>
                        @forelse ($prescription->otherSpecifications as $otherSpecification)
                            <li>
                                {{ $otherSpecification->name }} : {{ $otherSpecification->value }}
                            </li>
                        @empty
                        @endforelse

                    </ul>
                    <p>
                        <Strong>
                            Chief Complaint
                        </Strong>
                    </p>
                    <ul>
                        @foreach ($prescription->diseasesSymptoms as $diseases)
                            <li>
                                {{ $diseases->symptom->name }}
                        @endforeach


                    </ul>
                    <p>
                        <Strong>
                            Test
                        </Strong>
                    </p>
                    <ol>
                        <li>
                            <!-- Medicine Diagnosis -->
                            Test name will be here...
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
                        @forelse ($prescription->medicines as $medicine)
                            <li>
                                <div>
                                    <p>
                                        <strong>
                                            {{ $medicine->item->name }} {{ $medicine->item->strength->name }}
                                        </strong>
                                    </p>
                                    <div class="d-flex justify-content-between my-1">
                                        <p>
                                            {{ $medicine->how_many_quantity }}
                                        </p>
                                        <p class="mx-2">
                                            {{ ucfirst(Str::replaceFirst('_', ' ', $medicine->before_after_meal)) }}
                                        </p>
                                        <p>
                                            {{ $medicine->how_many_days }} Days
                                        </p>
                                        {{-- <br> --}}


                                    </div>
                                    @if ($medicine->medicine_note)
                                        <span style="text-align:center;display:block"> [ Note:
                                            {{ $medicine->medicine_note }}]</span>
                                    @endif
                                </div>
                            </li>

                        @empty
                        @endforelse


                    </ol>

                    <p>
                        <Strong>
                            Advice
                        </Strong>
                    </p>
                    <ul>
                        <li>
                            {{ $prescription->advice }}
                        </li>

                    </ul>

                    <p>
                        <Strong>
                            Next Follow Up :
                        </Strong>
                        {{ $prescription->next_visit ?? '―' }}
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
<script>
    window.print();
</script>

</html>
