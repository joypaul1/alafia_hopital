<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription Pad</title>
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
        <img src="{{ asset('assets/moneyReceipt/h-doctor.png') }}" style="width: 100%;" alt="">
        <div style="padding: 0 0.5in;">
            <table class="table table-borderless my-2" style="font-size: 12pt;">
                <tbody>
                    <tr>
                        <td style="width: 50%;">
                            <Strong>
                                Name :
                            </Strong>
                            {{ optional($prescription->patient)->name }}
                        </td>
                        <td style="text-align: right; width: 50%;">
                            <strong>Serial No.</strong> : {{ $prescription->serial_number }}
                        </td>
                    </tr>
                    @php
                        $bday = new DateTime(optional($prescription->patient)->dob); // Your date of birth
                        $today = new Datetime(date('m.d.y'));
                        $diff = $today->diff($bday);
                    @endphp
                    <tr>
                        <td>
                            <Strong>
                                Age
                            </Strong>
                            : {{ $diff->y }} Years {{ $diff->m }} Months {{ $diff->d }} Days
                        </td>
                        <td style="text-align: right;">
                            <strong>Date </strong> : {{ date('d-m-Y', strtotime($prescription->appointment_date)) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <Strong>
                                Department
                            </Strong>
                            : {{ optional(optional($prescription->doctor)->department)->name }}
                        </td>
                        <td style="text-align: right;">
                            <strong>Contact Number </strong>
                            : {{ optional($prescription->patient)->mobile }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <Strong>
                                Consultant
                            </Strong>
                            :
                            {{ optional($prescription->doctor)->first_name . ' ' . optional($prescription->doctor)->last_name }}
                            ({{ optional(optional($prescription->doctor)->designation)->name }})

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="padding: 0 0.25in; margin-bottom:0.2in;">
            <div style="border: 1px dashed #ccc;">
            </div>
        </div>
        <div style="padding: 0 0.5in; font-size: 12pt;">
            <div class="row" style="">
                <div class="col-4" style="border-right: 2px solid #333;">
                    <div style="height: 320px">
                        <p style="text-decoration: underline;">
                            <strong>C/C</strong>
                        </p>
                        <div class="px-2">
                            <p>

                                @forelse ($prescription->diseasesSymptoms as $diseases)
                                    {{ optional($diseases->symptom)->name }},
                                @empty
                                @endforelse
                            </p>
                        </div>
                    </div>
                    <div style="height: 320px">
                        <p style="text-decoration: underline;">
                            <strong>O/E</strong>
                        </p>
                        <div class="px-2">

                            <ul class="p-0">

                                @forelse ($prescription->otherSpecifications as $specification)
                                    <li>{{ $specification->name }} : {{ $specification->value }}</li>
                                @empty
                                @endforelse
                            </ul>

                        </div>
                    </div>
                    <div style="height: 320px">
                        <p style="text-decoration: underline;">
                            <strong>
                                Investigation
                            </strong>
                        </p>

                        <div class="pl-4">
                            <ul class="p-0">
                                {{-- @forelse ($prescription->otherSpecifications as $specification)
                                    <li>{{ $specification->name }}</li>
                                @empty
                                @endforelse --}}
                                @forelse ($prescription->labTest as $labTest)
                                    <li>{{ $labTest->test_name }}</li>
                                @empty
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <img src="{{ asset('assets/moneyReceipt/rx.png') }}" style="width: 80px" alt="">

                    <div class="p-3">
                        <ol>
                            @forelse ($prescription->medicines as $medicine)
                                {{-- @dd($medicine) --}}
                                <li class="mb-4">
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
                                            <br>


                                        </div>
                                        @if ($medicine->medicine_note)
                                            <small style="text-align:center;display:block"> [ Note:
                                                {{ $medicine->medicine_note }}
                                                ]</small>
                                        @endif
                                    </div>
                                </li>
                            @empty
                            @endforelse


                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <img src="{{ asset('assets/moneyReceipt/fdoctor.png') }}" style="width: 100%;" alt="">
        </footer>

    </div>

    </div>
</body>
<script>
    // window.print();
</script>

</html>
