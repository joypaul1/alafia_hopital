@extends('backend.layout.app')

@section('content')
@push('css')

<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css">

@endpush
@section('page-header')
<i class="fa fa-info-circle"></i> Company Setting Information 2
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-info-circle',
])

@push('css')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    li {
        list-style: none;
    }

    :root {
        --white: #FFF;
        --blue: #17A2B8;
        --light: #F5F5F5;
        --light-blue: #17A2B83B;
        --grey: #eee;
        --dark-grey: #666;
        --black: #222;
    }

    .wrapper {
        display: grid;
        grid-template-columns: 1fr 6fr;
    }

    .indicator {
        padding: 1.5rem 0;
        border-right: 1px solid var(--grey);
    }

    .indicator li {
        display: flex;
        align-items: center;
        grid-gap: .5rem;
        padding: 10px 2rem;
        cursor: pointer;
        font-size: .875rem;
        color: var(--black);
        border-right: 3px solid transparent;
    }

    .indicator li i {
        font-size: 1rem;
    }

    .indicator li:hover {
        background: var(--light-blue);
    }

    .indicator li.active {
        border-right-color: var(--blue);
        color: var(--blue);
        background: var(--light-blue);
    }

    .content {
        padding: 1.5rem 2rem;
    }

    .content li {
        display: none;
    }

    .content li.active {
        display: block;
    }

    .content li h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--black);
        margin-bottom: .75rem;
    }

    .content li p {
        margin-bottom: .5rem;
        color: var(--dark-grey);
        font-size: .875rem;
    }




    @media screen and (max-width: 576px) {
        .wrapper {
            grid-template-columns: 1fr;
        }

        .indicator {
            border-right: none;
        }
    }
</style>
@endpush

<form class="needs-validation" action="{{ route('backend.siteconfig.update') }}" method="Post" enctype="multipart/form-data">
    @method('POST')
    @csrf

    <div class="card">
        <div class="card-body">
            <div class="wrapper">
                <ul class="indicator">
                    <li class="active" data-target="#business">Business</li>
                    <li data-target="#tax">Tax <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Registered Tax Number for yur business"></i></li>
                    <li data-target="#product">Product</li>
                    <li data-target="#contact">Contact</li>
                    <li data-target="#sale">Sale</li>
                    <li data-target="#pos">POS</li>
                    <li data-target="#purchase">Purchases</li>
                    <li data-target="#payment">Payment</li>
                    <li data-target="#dashboard">Dashboard</li>
                    <li data-target="#system">System</li>
                    <li data-target="#prefixes">Prefixes</li>
                    <li data-target="#emailSettings">Email Settings</li>
                    <li data-target="#smsSettings">SMS Settings</li>
                    <li data-target="#rewardPointSettings">Reward Point Settings</li>
                    <li data-target="#modules">Modules</li>
                    <li data-target="#customLabel">Custom Labels</li>
                </ul>
                <ul class="content">
                    <li class="active" id="business">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-type',[ 'name' => 'business_name' , 'placeholder' => 'Business Name here...',
                                    'required'=> 'yes' ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="col-form-label">Start Date: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="date" name="dates" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="col-form-label">Default Profit Percentage: <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Default profit margin of a product. <br><small>Used to calculate selling price based on purchase price entered.<br/> You can modify this value for individual products while adding</small>" data-html="true"></i></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Enter a number">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="col-form-label">Currency: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="null" hidden>Please Select</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    @include('components.backend.forms.input.input-image',[ 'name' => 'upload_logo',
                                    'required'=> 'yes' ])
                                    @include('components.backend.forms.input.errorMessage', ['message' =>
                                    $errors->first('name')])
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="col-form-label">Currency Symbol Placement: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="before">Before Amount</option>
                                        <option value="after">After Amount</option>
                                    </select>
                                </div>
                                <label class="col-form-label">Time Format: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="24">24 Hour</option>
                                        <option value="12">12 Hour</option>
                                    </select>
                                </div>
                                <label class="col-form-label">Transaction Edit Days: <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Number of days from Transaction Date till which a transaction can be edited." data-html="true"></i></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Enter Transaction Edit Days">
                                </div>

                                <label class="col-form-label">Financial year start month: <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="<small>Start Month of the financial year of business</small>" data-html="true"></i></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option hidden>Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="col-form-label">Stock Accounting Method: <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Accounting Methods"></i></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calculator" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option value="fifo">FIFO (First in First Out)</option>
                                        <option value="lifo">LIFO (Last in First Out)</option>
                                    </select>
                                </div>

                                <label class="col-form-label">Time Zone: </label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option hidden>Please Select</option>
                                    </select>
                                </div>


                                <label class="col-form-label">Currency precision: <i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="top" title="Number of digits after decimal point for currency value. Example:0.00 for value 2, 0.000 for value 3, 0.0000 for value 4" data-html="true"></i></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-usd" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Enter Currency precision">
                                </div>

                                <label class="col-form-label">Date Format:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <select class="form-control">
                                        <option hidden>Please Select</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label class="col-form-label">Quantity precision:</label>
                                <select class="form-control">
                                    <option hidden>Please Select</option>
                                </select>
                            </div>

                        </div>
                        <div class="form-group col-lg-12">
                            <div class="d-block text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </li>
                    <li id="tax">tax
                    </li>
                    <li id="product">product
                    </li>
                    <li id="contact">contact
                    </li>
                    <li id="sale">sale
                    </li>
                    <li id="pos">pos
                    </li>
                    <li id="purchase">purchase
                    </li>
                    <li id="payment">payment
                    </li>
                    <li id="dashboard">dashboard
                    </li>
                    <li id="system">system
                    </li>
                    <li id="prefixes">prefixes
                    </li>
                    <li id="emailSettings">emailSettings
                    </li>
                    <li id="smsSettings">smsSettings
                    </li>
                    <li id="rewardPointSettings">
                        rewardPointSettings
                    </li>
                    <li id="modules">
                        modules
                    </li>
                    <li id="customLabel">
                        customLabel
                    </li>
                </ul>
            </div>
        </div>
    </div>

</form>








@endsection

@push('js')

<script src="{{ asset('assets/backend') }}/vendor/select2/select2.min.js"></script>



<script>
    $("#country").select2();
    $("#currency").select2();
    $("#dateTimeZone").select2();


    // Vertical Tabs
    const allIndicator = document.querySelectorAll('.indicator li');
    const allContent = document.querySelectorAll('.content li');

    allIndicator.forEach(item => {
        item.addEventListener('click', function() {
            const content = document.querySelector(this.dataset.target);

            allIndicator.forEach(i => {
                i.classList.remove('active');
            })

            allContent.forEach(i => {
                i.classList.remove('active');
            })

            content.classList.add('active');
            this.classList.add('active');
        })
    })
</script>

@endpush
