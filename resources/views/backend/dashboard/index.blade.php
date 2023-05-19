@extends('backend.layout.app')
@push('css')
    <style>
        /** The Magic **/
        .btn-breadcrumb .btn:not(:last-child):after {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            border-top: 17px solid transparent;
            border-bottom: 17px solid transparent;
            border-left: 10px solid white;
            position: absolute;
            top: 50%;
            margin-top: -17px;
            left: 100%;
            z-index: 3;
        }

        .btn-breadcrumb .btn:not(:last-child):before {
            content: " ";
            display: block;
            width: 0;
            height: 0;
            border-top: 17px solid transparent;
            border-bottom: 17px solid transparent;
            border-left: 10px solid rgb(173, 173, 173);
            position: absolute;
            top: 50%;
            margin-top: -17px;
            margin-left: 1px;
            left: 100%;
            z-index: 3;
        }

        /** The Spacing **/
        .btn-breadcrumb .btn {
            padding: 6px 12px 6px 24px;
        }

        .btn-breadcrumb .btn:first-child {
            padding: 6px 6px 6px 10px;
        }

        .btn-breadcrumb .btn:last-child {
            padding: 6px 18px 6px 24px;
        }



        /** Primary button **/
        .btn-breadcrumb .btn.btn-primary:not(:last-child):after {
            border-left: 10px solid #007bff;
        }

        .btn-breadcrumb .btn.btn-primary:not(:last-child):before {
            border-left: 10px solid #357ebd;
        }

        .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):after {
            border-left: 10px solid #0069d9;
        }

        .btn-breadcrumb .btn.btn-primary:hover:not(:last-child):before {
            border-left: 10px solid #007bff;
        }
        .btn.btn-rounded {
    border-radius: 50px;
}
    </style>
@endpush


@section('content')
{{-- @dd($todaysDocAppointment); --}}
<div class="row mb-4 clearfix">
       <!-- <div class="card py-3 text-center"><strong>Quicklinks</strong> </div>-->
        <div class="col-lg-12 col-md-6">
            <div class="card top_counter">
                <div class="body">
               <a href="{{ route('backend.appointment.index') }}"> <button type="button" class="btn btn-danger btn-lg">
        <i class="fa fa-user"></i> Doctor Appointment
     </button></a>
     <a href="{{ route('backend.dialysis-appointment.index') }}"> <button type="button" class="btn btn-warning btn-lg">
        <i class="fa fa-user"></i> Dialysis Appointment
     </button></a>
     <a href="{{ route('backend.pathology.labTest.create') }}"> <button type="button" class="btn btn-primary btn-lg">
        <i class="fa fa-money"></i> Pathology Invoice
     </button></a>

     <a href="{{ route('backend.pos.index')}}"> <button type="button" class="btn btn-success btn-lg">
        <i class="fa fa-money"></i> POS
     </button></a>

     <a href="{{ route('backend.doctor.create') }}"> <button type="button" class="btn btn-dark btn-lg">
        <i class="fa fa-user"></i> Doctor Create
     </button></a>

     <a href="{{ route('backend.patient.create') }}"> <button type="button" class="btn btn-info btn-lg">
        <i class="fa fa-user"></i> Patient Create
     </button></a>

                    <hr>

                </div>
            </div>
        </div>
</div>

    <div class="row mb-4 clearfix">
        <div class="card py-3 text-center"><strong>Doctor Appointment</strong> </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-info"><i class="fa fa-user"></i> </div>
                    <div class="content">
                        <div class="text">Today's Appointment</div>
                        <h5 class="number">{{$todaysDocAppointment  }}</h5>
                    </div>
                    <hr>
                    <div class="icon text-warning"><i class="fa fa-users"></i> </div>
                    <div class="content">
                        <div class="text">Total Patients</div>
                        <h5 class="number">{{ $totalPatient }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-warning"><i class="fa fa-tags"></i> </div>
                    <div class="content">
                        <div class="text">Today's Income</div>
                        <h5 class="number">৳ {{ number_format($todaysDocAppointmentIncome, 2) }}</h5>
                    </div>
                    <hr>
                    <div class="icon"><i class="fa fa-university"></i> </div>
                    <div class="content">
                        <div class="text">This Month Total Income</div>
                        <h5 class="number">৳ 00</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-danger"><i class="fa fa-credit-card"></i> </div>
                    <div class="content">
                        <div class="text">Today's Expense</div>
                        <h5 class="number">৳ 0.00</h5>
                    </div>
                    <hr>
                    <div class="icon text-danger">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="content">
                        <div class="text">Total Expense This Month</div>
                        <h5 class="number">৳ 0.00</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mb-4 clearfix">
        <div class="card py-3 text-center"><strong>Dialysis Appointment</strong> </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-info"><i class="fa fa-user"></i> </div>
                    <div class="content">
                        <div class="text">Today's Appointment</div>
                        <h5 class="number">{{$todaysDialysisAppointment  }}</h5>
                    </div>
                    <hr>
                    <div class="icon text-warning"><i class="fa fa-users"></i> </div>
                    <div class="content">
                        <div class="text">Total Patients</div>
                        <h5 class="number">{{ $totalDialysisPatient }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-warning"><i class="fa fa-tags"></i> </div>
                    <div class="content">
                        <div class="text">Today's Income</div>
                        <h5 class="number">৳ {{ number_format($todaysDialysisDocAppointmentIncome, 2) }}</h5>
                    </div>
                    <hr>
                    <div class="icon"><i class="fa fa-university"></i> </div>
                    <div class="content">
                        <div class="text">This Month Total Income</div>
                        <h5 class="number">৳ 00</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-danger"><i class="fa fa-credit-card"></i> </div>
                    <div class="content">
                        <div class="text">Today's Expense</div>
                        <h5 class="number">৳ 0.00</h5>
                    </div>
                    <hr>
                    <div class="icon text-danger">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="content">
                        <div class="text">Total Expense This Month</div>
                        <h5 class="number">৳ 0.00</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mb-4 clearfix">
        <div class="card py-3 text-center"><strong>Pathology Appointment</strong> </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-info"><i class="fa fa-user"></i> </div>
                    <div class="content">
                        <div class="text">Today's Appointment</div>
                        <h5 class="number">{{ ($todaysLabAppointment)  }}</h5>
                    </div>
                    <hr>
                    <div class="icon text-warning"><i class="fa fa-users"></i> </div>
                    <div class="content">
                        <div class="text">Total Patients</div>
                        <h5 class="number">{{ $totalLabPatient }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-warning"><i class="fa fa-tags"></i> </div>
                    <div class="content">
                        <div class="text">Today's Income</div>
                        <h5 class="number">৳ {{ number_format($todaysLabAppointmentIncome, 2) }}</h5>
                    </div>
                    <hr>
                    <div class="icon"><i class="fa fa-university"></i> </div>
                    <div class="content">
                        <div class="text">This Month Total Income</div>
                        <h5 class="number">৳ 00</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-danger"><i class="fa fa-credit-card"></i> </div>
                    <div class="content">
                        <div class="text">Today's Expense</div>
                        <h5 class="number">৳ 0.00</h5>
                    </div>
                    <hr>
                    <div class="icon text-danger">
                        <i class="fa fa-money"></i>
                    </div>
                    <div class="content">
                        <div class="text">Total Expense This Month</div>
                        <h5 class="number">৳ 0.00</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="row clearfix my-4">
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center text-white"
                    style="
                    background: #ff5925;
                    font-weight: bold;
                    font-size: 14px;
                ">
                    Weekly Appointment Report</div>
                <canvas id="weeklySell"></canvas>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header text-center text-white"
                    style="
                    background: #8d4df6;
                    font-weight: bold;
                    font-size: 14px;
                ">
                    Weekly Dailyses Report</div>
                <canvas id="userSell"></canvas>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header text-center text-white"
                    style="
                    background: #8d4df6;
                    font-weight: bold;
                    font-size: 14px;
                ">
                    Monthly Sell Report</div>
                <canvas id="monthlySell"></canvas>
            </div>
        </div>

    </div> --}}
    {{-- <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2>University Survey</h2>
                    <ul class="header-dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row text-center">
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$231</h4>
                            <p class="text-muted margin-0"> Today's</p>
                        </div>
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$1,254</h4>
                            <p class="text-muted margin-0">This Week's</p>
                        </div>
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$3,298</h4>
                            <p class="text-muted margin-0">This Month's</p>
                        </div>
                        <div class="col-sm-3 col-6">
                            <h4 class="margin-0">$9,208</h4>
                            <p class="text-muted margin-0">This Year's</p>
                        </div>
                    </div>
                    <div id="m_bar_chart" class="graph m-t-20"></div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <div class="row clearfix">
        <div class="col-12">
            <div class="card">
                <div class="body">
                    <h4>Quick Link</h4>
                    <div class="btn-group btn-breadcrumb ml-0">
                        <a href="/" class="btn btn-primary ml-0"><i class="fa fa-home"></i></a>
                        <a href="appointment" class="btn btn-primary ml-0">Doctor Appointment</a>
                        <a href="dialysis-appointment" class="btn btn-primary ml-0">Dialyses Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/backend/clock/clock.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@endpush
