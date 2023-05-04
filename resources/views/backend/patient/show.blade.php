@extends('backend.layout.app')
@push('css')
    <style>
        .l-coral {
            background: linear-gradient(45deg, #17a2b8, #f58787) !important;
        }
    </style>
@endpush

@section('page-header')
    <i class="fa fa-list"></i> Patient Info
@stop
@section('content')

    @include('backend._partials.page_header', [
        'fa' => 'fa fa-plus-circle',
        'name' => 'List Patient',
        'route' => route('backend.patient.index'),
    ])

    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            <div class="card member-card">
                <div class="header l-coral">
                    <h4 class="m-t-10 text-light">{{ $patient->name }}</h4>
                </div>
                <div class="member-img">

                    <img src="https://cdn-icons-png.flaticon.com/512/1513/1513062.png" class="rounded-circle"
                        alt="profile-image">
                </div>
                <div class="body">
                    @php
                        $age = null;
                        if (!empty($patient->dob)) {
                            $birthdate = new DateTime($dob);
                            $today = new DateTime('today');
                            $age = $birthdate->diff($today)->y;
                        }
                    @endphp
                    <hr>
                    <strong>Gender</strong>
                    <p>{{ $patient->guardian_name ?? '' }}</p>
                    <strong>Email ID</strong>
                    <p>{{ $patient->email ?? '-' }}</p>
                    <strong>Phone</strong>
                    <p>{{ $patient->mobile ?? '-' }}</p>
                    <strong>Emergency Contact</strong>
                    <p>{{ $patient->emergency_contact ?? '-' }}</p>
                    <strong>Guardian Name</strong>
                    <p>{{ $patient->guardian_name ?? '-' }}</p>
                    <strong>Date oF Birth </strong> / <strong>Age </strong>
                    <p>{{ $patient->dob ?? '-' }} / {{ ($age != null)? $age:'-' }}</p>
                    <strong>Blood Group </strong>
                    <p>{{ $patient->blood_group ?? '-' }}</p>
                    <strong>Marital Status </strong>
                    <p>{{ $patient->blood_group ?? '-' }}</p>

                    <hr>
                    <strong>Address</strong>
                    <address>{{ $patient->address ?? '-' }}</address>
                </div>
            </div>

        </div>

    </div>


@endsection

@push('js')
@endpush
