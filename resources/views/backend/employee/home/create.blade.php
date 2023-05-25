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
    <i class="fa fa-plus-circle"></i> Employee Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Employee List',
        'route' => route('backend.employee.index'),
    ])

<form action="{{ route('backend.employee.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row clearfix">
        {{-- laravel error message --}}
        @foreach ($errors->all() as $error)
        @dd($error);
        @endforeach


            <div class="col-lg-6 col-md-12">
                <div class="card profile-header">
                    <div class="body text-center">
                        <div class="rounded-circle mx-auto position-relative mb-3 user-profile" style="">
                            <img id="userProfile-image"  style="object-fit: cover;"

                                src="{{ asset('assets/backend/add-employee-icon.png')}}" class="rounded-circle" alt="">
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
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                                </div>
                                
                                <div class="form-group">
                                    <div>
                                        <label class="fancy-radio">
                                            <input name="gender" value="male" type="radio" checked="">
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
                                        <input type="date" name="dob" data-provide="datepicker"
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
                                    <select class="form-control" name="marital_status" >
                                        <option value="single">Single</option>
                                        <option value="married">Married</option>
                                        <option value="divorced">Divorced</option>
                                        <option value="widowed">Widowed</option>
                                    </select>
                                </div>
                               
                            </div>
                        </div>

                        <h6>Present Address</h6>
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="present_address"
                                        placeholder="Address">
                                </div>
                               
                            </div>
                        </div>

                        <h6>Permanent Address</h6>
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="permanent_address"
                                        placeholder="Address">
                                </div>
                                
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="body">
                                <h5>Official Information</h5>
                                <hr>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                    <label for="dob">
                                        Login Email
                                    </label>
                                            <input type="email" name="login_email" autocomplete="off" class="form-control"
                                                placeholder="alizee.info@yourdomain.com" placeholder="Email" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="dob">
                                       Password
                                    </label>
                                            <input type="password" name="password" autocomplete="off" class="form-control"
                                                placeholder="New Password" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="dob">
                                       Confirm Password
                                    </label>
                                            <input type="password" autocomplete="off" name="confirm_password" class="form-control"
                                                placeholder="Confirm New Password" required>
                                        </div>
                                    <div class="form-group">
                                    <label for="dob">
                                       National ID
                                    </label>
                                    <input type="number" class="form-control" name="nid"
                                        placeholder="NID">
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
                                <label for="dob">
                                        Joining Date
                                    </label>
                                    <input type="date" class="form-control" name="joining_date"placeholder= "joining date" >
                                </div>
                                <div class="form-group">
                                <label for="dob">
                                    Salary
                                    </label>
                                    <input type="number" class="form-control" name="salary"
                                        placeholder="Salary">
                                </div>
                                <div class="form-group">
                                            <select class="form-control show-tick" name="role_id" required>
                                                <option value="{{ null }}" hidden>-- Select Role--</option>
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
                $('.appointmentIncrement').append(html);
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
                $('.scheduleIncrement').append(html);
            });
            $('#scheduleDecrement').click(function() {
                $('#scheduleRow' + scheduleIncrement + '').remove();
                scheduleIncrement--;
            });
        });
    </script>


@endpush
