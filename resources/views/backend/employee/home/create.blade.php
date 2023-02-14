@extends('backend.layout.app')
@push('css')
<style>
    .user-profile{
        height:150px; width:150px; overflow:hidden;
    }
    .user-profile img {
        height:100%; width:100%;
    }
    .user-profile .profile-upload {
        top:0; cursor:pointer;
        opacity: 0;
        transition: all 0.3s ease-in-out;
        color: #fff;
        background-color: #5744765f ;
        backdrop-filter: blur(5px);
    }
    .user-profile:hover .profile-upload {
        opacity: 1;
    }
</style>
@endpush
@section('page-header')
<i class="fa fa-plus-circle"></i> Slider Create
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-list',
'name' => 'Slider List',
'route' => route('backend.siteconfig.slider.index')
])


<div class="row clearfix">

    <div class="col-lg-4 col-md-12">
        <div class="card profile-header">
            <div class="body text-center">
                <div class="rounded-circle mx-auto position-relative mb-3 user-profile" style="">
                    <img src="https://www.wrraptheme.com/templates/lucid/html/assets/images/user.png" class="rounded-circle" alt="">
                    <div class="position-absolute profile-upload display-4 h-100 w-100 d-flex justify-content-center align-items-center" style="">
                        <i class="fa fa-camera"></i>
                    </div>
                </div>
                <div>
                    <h4 class="m-b-0"><strong>Alizee</strong> Thomas</h4>
                    <span>Washington, d.c.</span>
                </div>
                <div class="m-t-15">
                    <button class="btn btn-primary">Follow</button>
                    <button class="btn btn-outline-secondary">Message</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="header">
                <h2>Info</h2>
                <ul class="header-dropdown">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:void(0);">Action</a></li>
                            <li><a href="javascript:void(0);">Another Action</a></li>
                            <li><a href="javascript:void(0);">Something else</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="body">
                <small class="text-muted">Address: </small>
                <p>795 Folsom Ave, Suite 600 San Francisco, 94107</p>
                <div>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1923731.7533500232!2d-120.39098936853455!3d37.63767091877441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1522391841133" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen=""></iframe>
                </div>
                <hr>
                <small class="text-muted">Email address: </small>
                <p>michael@gmail.com</p>
                <hr>
                <small class="text-muted">Mobile: </small>
                <p>+ 202-555-2828</p>
                <hr>
                <small class="text-muted">Birth Date: </small>
                <p class="m-b-0">October 22th, 1990</p>
                <hr>
                <small class="text-muted">Social: </small>
                <p><i class="fa fa-twitter m-r-5"></i> twitter.com/example</p>
                <p><i class="fa fa-facebook  m-r-5"></i> facebook.com/example</p>
                <p><i class="fa fa-github m-r-5"></i> github.com/example</p>
                <p><i class="fa fa-instagram m-r-5"></i> instagram.com/example</p>
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="body">
                <h6>Basic Information</h6>
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <div>
                                <label class="fancy-radio">
                                    <input name="gender2" value="male" type="radio" checked="">
                                    <span><i></i>Male</span>
                                </label>
                                <label class="fancy-radio">
                                    <input name="gender2" value="female" type="radio">
                                    <span><i></i>Female</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="icon-calendar"></i></span>
                                </div>
                                <input type="date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="Birthdate">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="http://">
                        </div>
                        <div class="form-group">
                            <select type="text" class="form-control">
                                <option value="">
                                    -- Select Designation --
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select type="text" class="form-control">
                                <option value="">
                                    -- Select Depertment --
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="time" id="start_time" name="start_time" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" id="end_time" name="end_time" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Address Line 1">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Address Line 2">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="City">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="State/Province">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                <button type="button" class="btn btn-default">Cancel</button>
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-md-12">
        <div class="card">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <h6>Account Data</h6>
                        <div class="form-group">
                            <input type="text" class="form-control" value="alizeethomas" disabled="" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" value="alizee.info@yourdomain.com" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12">
                        <h6>Change Password</h6>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Confirm New Password">
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                <button class="btn btn-default">Cancel</button>
            </div>
        </div>

        <div class="card">
            <div class="body">
                <h6>General Information</h6>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <select class="form-control">
                                <option>--Select Language</option>
                                <option value="en_US" lang="en">English (United States)</option>
                                <option value="bn_BD" lang="bn">বাংলা</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date Format</label>
                            <div class="fancy-radio">
                                <label><input name="dateFormat" value="" type="radio"><span><i></i>May 18, 2018</span></label>&nbsp;&nbsp;
                                <label><input name="dateFormat" value="" type="radio"><span><i></i>2018, May, 18</span></label>&nbsp;&nbsp;
                                <label><input name="dateFormat" value="" type="radio" checked=""><span><i></i>2018-03-10</span></label>&nbsp;&nbsp;
                                <label><input name="dateFormat" value="" type="radio"><span><i></i>02/09/2018</span></label>&nbsp;&nbsp;
                                <label><input name="dateFormat" value="" type="radio"><span><i></i>10/05/2018</span></label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary">Update</button> &nbsp;&nbsp;
                <button class="btn btn-default">Cancel</button>
            </div>
        </div>
    </div>
</div>


@endsection

@push('js')


@endpush
