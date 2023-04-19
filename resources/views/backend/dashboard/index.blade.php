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
    </style>
@endpush


@section('content')
    <div class="row mb-4 clearfix">
        {{-- <div class="card py-3 text-center"><strong>Doctor Appointment</strong> </div> --}}
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon text-info"><i class="fa fa-user"></i> </div>
                    <div class="content">
                        {{-- <div class="text">Today's Patients</div> --}}
                        {{-- <h5 class="number">1</h5> --}}
                    </div>

                </div>
            </div>
        </div>



    </div>

@endsection

@push('js')
    {{-- <script src="{{ asset('assets/backend/clock/clock.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


@endpush
