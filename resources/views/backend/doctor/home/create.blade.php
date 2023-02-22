@extends('backend.layout.app')
@push('css')
    <style>
        .user-profile {
            height: 150px;
            width: 150px;
            overflow: hidden;
        }

        .user-profile img {
            height: 100%;
            width: 100%;
        }

        .user-profile .profile-upload {
            top: 0;
            cursor: pointer;
            opacity: 0;
            transition: all 0.3s ease-in-out;
            color: #fff;
            background-color: #5744765f;
            backdrop-filter: blur(5px);
        }

        .user-profile:hover .profile-upload {
            opacity: 1;
        }
    </style>
@endpush
@section('page-header')
    <i class="fa fa-plus-circle"></i> Doctor Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Doctor List',
        'route' => route('backend.doctor.index'),
    ])

<form action="{{ route('backend.doctor.store') }}" method="post">
    @csrf
    @method('POST')
    <div class="row clearfix">
        {{-- laravel error message --}}
        @foreach ($errors->all() as $error)
        @dd($error);
        @endforeach


            <div class="col-lg-4 col-md-12">
                <div class="card profile-header">
                    <div class="body text-center">
                        <div class="rounded-circle mx-auto position-relative mb-3 user-profile" style="">
                            <img id="userProfile-image"  style="object-fit: cover;"

                                src="https://i.ibb.co/1nHdqjf/813844-people-512x512.png" class="rounded-circle" alt="">
                            <label for="userProfile"
                                class="position-absolute profile-upload display-4 h-100 w-100 d-flex justify-content-center align-items-center"
                                style="">
                                <input id="userProfile" type="file" name="userProfileImage" accept="image/*" hidden>
                                <i class="fa fa-camera"></i>
                            </label>
                        </div>
                    </div>
                    <div class="body">
                        <h6>Basic Information</h6>
                        <div class="row clearfix">
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                </div>
                                <div class="form-group">
                                    <div>
                                        <label class="fancy-radio">
                                            <input name="gender" value="male" type="radio" checked="" required>
                                            <span><i></i>Male</span>
                                        </label>
                                        <label class="fancy-radio">
                                            <input name="gender" value="female" type="radio" >
                                            <span><i></i>Female</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dob">
                                        Birthdate
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="icon-calendar"></i></span>
                                        </div>
                                        <input type="date" name="dob" required data-provide="datepicker"
                                            data-date-autoclose="true" class="form-control" placeholder="Birthdate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" required name="mobile" placeholder="Mobile Number">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Contact Email">
                                </div>

                                <div class="form-group">
                                    <input type="number" class="form-control" name="emergency_mobile"
                                        placeholder="Emergency Mobile Number">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="department_id"  id='department_id' required>
                                        <option value="{{ null }}" hidden>-- Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="designation_id" id="designation_id" required>
                                        <option value="{{ null }}" hidden>-- Select Designation</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="license_number"placeholder="License number">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="nid_number" placeholder="NID number">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="marital_status" required>
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="date" class="form-control" name="joining_date" required>
                                </div>
                            </div>
                        </div>

                        <h6>Present Address</h6>
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="present_address_1"
                                        placeholder="Address Line 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="present_address_2"
                                        placeholder="Address Line 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="present_address_city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="present_address_state"
                                        placeholder="State/Province">
                                </div>
                            </div>
                        </div>

                        <h6>Parmanent Address</h6>
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="permanent_address_1"
                                        placeholder="Address Line 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="permanent_address_1"
                                        placeholder="Address Line 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="permanent_address_city" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="permanent_address_state"
                                        placeholder="State/Province">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <h6>Login Account Data</h6>

                                        <div class="form-group">
                                            <input type="email" name="login_email" autocomplete="off" class="form-control"
                                                placeholder="alizee.info@yourdomain.com" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" autocomplete="off" class="form-control"
                                                placeholder="New Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" autocomplete="off" name="confirm_password" class="form-control"
                                                placeholder="Confirm New Password">
                                        </div>
                                    </div>


                                    <div class="col-lg-12 col-md-12">
                                        <h6>Define User Role</h6>
                                        <div class="form-group">
                                            <select class="form-control show-tick" name="role_id">
                                                <option value="{{ null }}" hidden>-- Please select --</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="body">
                                <h5>Doctor Charges</h5>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                        <h6>Consultation Fee</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="col-5 p-0">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" name="consultation_name[]"
                                                        readonly value="1st">
                                                </div>
                                            </div>
                                            <div class="col-1 p-0 text-center">
                                                =
                                            </div>
                                            <div class="col-6 p-0">
                                                <div class="form-group mb-0">
                                                    @include('components.backend.forms.input.input-type2',[ 'name' => 'consultation_fee[]', 'number' =>true,
                                                    'value'=>old('consultation_fee'),'placeholder' => 'consultation fee', 'required'=> 'yes' ])
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center ">
                                            <div class="col-5 p-0">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" name="consultation_name[]"
                                                        placeholder="Next Visit Day">
                                                </div>
                                            </div>
                                            <div class="col-1 p-0 text-center">
                                                =
                                            </div>
                                            <div class="col-6 p-0">
                                                <div class="form-group mb-0">
                                                    @include('components.backend.forms.input.input-type2',[ 'name' => 'consultation_fee[]', 'number' =>true,
                                                    'value'=>old('consultation_fee'),'placeholder' => 'consultation fee', 'required'=> 'yes' ])
                                                </div>
                                            </div>

                                        </div>
                                        <div class="mt-2 mb-3">
                                            <small>
                                                Select fee for next visit under certain days. For example, if you want to charge
                                                1000 for next visit after 7 days, then set 7 days and 1000 as charge.
                                            </small>
                                        </div>

                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="consultation_duration"
                                                placeholder="Consultation Duration">
                                        </div>
                                        {{-- <h6>Service Fee</h6>
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option value="">-- Please select --</option>
                                                <option value="1">Service 1</option>
                                                <option value="2">Service 2</option>
                                                <option value="3">Service 3</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Charge">
                                        </div> --}}

                                        <h6>Doctor Commission</h6>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="col-5 p-0">
                                                <div class="form-group mb-0">
                                                    <select class="form-control" name="commission_type">
                                                        <option value="parcent">Parcent</option>
                                                        <option value="fixed">Fixed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-1 p-0 text-center">
                                                =
                                            </div>
                                            <div class="col-6 p-0">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" name="commission_amount"
                                                        placeholder="Amount">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <h6>Appointment Schedule</h6>
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <div class="form-group">
                                            <label>Day</label>
                                            <select name="appointment_days[]" id=""  class="form-control">
                                                @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                                    <option value="{{ $day }}">{{ $day }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-12">
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select name="appointment_days[]" id=""  class="form-control">
                                                @foreach ($shifts as $shift)
                                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3   col-md-12">
                                        <div class="form-group">
                                            <label for="start_time">Start Time</label>
                                            <input type="time" id="start_time" name="appointment_day_start_time[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-12">
                                        <div class="form-group">
                                            <label for="end_time">End Time</label>
                                            <input type="time" id="end_time" name="appointment_day_end_time[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-right">
                                            <button type="button" id="appointmentIncrement" class="btn btn-primary">+</button> &nbsp;&nbsp;
                                            <button type="button" class="btn btn-danger" id="appointmentDecrement" >-</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="body">
                                <h6>Petaint Visit Schedule</h6>
                                <div class="row">
                                    <div class="col-lg-3  col-md-12">
                                        <div class="form-group">
                                            <label>Day</label>
                                            <select name="visit_schedule_days[]" id="" class="form-control">
                                            @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-12">
                                        <div class="form-group">
                                            <label>Shift</label>
                                            <select name="appointment_days[]" id=""  class="form-control">
                                                @foreach ($shifts as $shift)
                                                    <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-12">
                                        <div class="form-group">
                                            <label for="start_time">Start Time</label>
                                            <input type="time" id="start_time" name="visit_schedule_day_start_time[]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3  col-md-12">
                                        <div class="form-group">
                                            <label for="end_time">End Time</label>
                                            <input type="time" id="end_time" name="visit_schedule_day_end_time[]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="text-right">
                                            <button type="button" class="btn btn-primary" id="scheduleIncrement">+</button> &nbsp;&nbsp;
                                            <button  type="button" class="btn btn-danger" id="scheduleDecrement">-</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>




@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $image = $('#userProfile');
            $imageFile = $('#userProfile-image');
            // Grab image link when input change
            $image.change(function() {
                var input = this;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $imageFile.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var appointmentIncrement = 1;
            var scheduleIncrement = 1;
            $('#appointmentIncrement').click(function() {
                appointmentIncrement++;
                var html = '';
                html += '<div class="row" id="appointmentRow' + appointmentIncrement + '">';
                html += '<div class="col-lg-4 col-md-12">';
                html += '<div class="form-group">';
                html += '<label>Day</label>';
                html += '<select name="appointment_days[]" id="" class="form-control">';
                html += '<option value="Sunday">Sunday</option>';
                html += '<option value="Monday">Monday</option>';
                html += '<option value="Tuesday">Tuesday</option>';
                html += '<option value="Wednesday">Wednesday</option>';
                html += '<option value="Thursday">Thursday</option>';
                html += '<option value="Friday">Friday</option>';
                html += '<option value="Saturday">Saturday</option>';
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-lg-4 col-md-12">';
                html += '<div class="form-group">';
                html += '<label for="start_time">Start Time</label>';
                html += '<input type="time" id="start_time" name="appointment_day_start_time[]" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-lg-4 col-md-12">';
                html += '<div class="form-group">';
                html += '<label for="end_time">End Time</label>';
                html += '<input type="time" id="end_time" name="appointment_day_end_time[]" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#appointmentIncrement').before(html);
            });
            $('#appointmentDecrement').click(function() {
                $('#appointmentRow' + appointmentIncrement + '').remove();
                appointmentIncrement--;
            });
            $('#scheduleIncrement').click(function() {
                scheduleIncrement++;
                var html = '';
                html += '<div class="row" id="scheduleRow' + scheduleIncrement + '">';
                html += '<div class="col-lg-4 col-md-12">';
                html += '<div class="form-group">';
                html += '<label>Day</label>';
                html += '<select name="visit_schedule_days[]" id="" class="form-control">';
                html += '<option value="Sunday">Sunday</option>';
                html += '<option value="Monday">Monday</option>';
                html += '<option value="Tuesday">Tuesday</option>';
                html += '<option value="Wednesday">Wednesday</option>';
                html += '<option value="Thursday">Thursday</option>';
                html += '<option value="Friday">Friday</option>';
                html += '<option value="Saturday">Saturday</option>';
                html += '</select>';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-lg-4 col-md-12">';
                html += '<div class="form-group">';
                html += '<label for="start_time">Start Time</label>';
                html += '<input type="time" id="start_time" name="visit_schedule_day_start_time[]" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '<div class="col-lg-4 col-md-12">';
                html += '<div class="form-group">';
                html += '<label for="end_time">End Time</label>';
                html += '<input type="time" id="end_time" name="visit_schedule_day_end_time[]" class="form-control">';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                $('#scheduleIncrement').before(html);
            });
            $('#scheduleDecrement').click(function() {
                $('#scheduleRow' + scheduleIncrement + '').remove();
                scheduleIncrement--;
            });
        });
    </script>


@endpush
