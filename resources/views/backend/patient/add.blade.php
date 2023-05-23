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
    <i class="fa fa-plus-circle"></i> Patient Create
@stop

@section('content')
    @include('backend._partials.page_header', [
        'fa' => 'fa fa-list',
        'name' => 'Patient List',
        'route' => route('backend.patientlist'),
    ])

<form action="{{ route('backend.savepatient') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('POST')
    <div class="row clearfix">
        {{-- laravel error message --}}
        @foreach ($errors->all() as $error)
        @dd($error);
        @endforeach


            <div class="col-lg-8 col-md-12">
                <div class="card profile-header">
                    
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
                                @include('components.backend.forms.input.input-type', [
                        'name' => 'mobile',
                        'required' => 'true',
                        'number' => true,
                        'placeholder' => 'Enter Mobile'
                        ])
                                </div>
                                <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                        'name' => 'email',
                        'placeholder' => 'Enter Email'
                        ])
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
                                @include('components.backend.forms.input.input-type', [
                        'name' => 'emergency_contact',
                        'placeholder' => 'Enter Emargency Contact'
                        ])
                                </div>
                                <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                        'name' => 'guardian_name',
                        'placeholder' => 'Enter Guardian Name'

                        ])
                                </div>
                               
                                
                                <div class="form-group">
                                @include('components.backend.forms.select2.option', [
                        'name' => 'marital_status',
                        'optionData' => $marital_status,
                        ])
                                </div>
                                <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                            'name' => 'age',
                        ])
                                </div>
                                <div class="form-group">
                                @include('components.backend.forms.select2.option', [
                        'name' => 'blood_group',
                        'optionData' => $blood_group,
                        ])
                                </div>
                            </div>
                        </div>

                        <h6>Address</h6>
                        <div class="row clearfix">

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                @include('components.backend.forms.input.input-type', [
                        'name' => 'address',
                        'placeholder' => 'Enter Address'
                        ])
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
