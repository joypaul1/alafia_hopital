@extends('backend.layout.app')

@section('content')
@push('css')

<link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/select2/select2.css" />
<link rel="stylesheet" href="{{ asset('assets/backend') }}/css/main.css">

@endpush
@section('page-header')
<i class="fa fa-info-circle"></i> Company Setting Information
@stop

@section('content')
@include('backend._partials.page_header', [
'fa' => 'fa fa-info-circle',
])

<form class="needs-validation" action="{{ route('backend.siteConfig.update') }}" method="Post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="card">
        <div class="card-body row">
            <div class="col-lg-6">
                <div class="form-validation">
                    <div class="form-group">
                        @include('components.backend.forms.input.input-type',[ 'name' => 'name',
                        'value'=>old('name',$siteInfo->name) , 'placeholder' => ' Name will be here...',
                        'required'=> 'yes' ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('name')])
                    </div>

                    <div class="form-group">
                        @include('components.backend.forms.input.input-type',[ 'name' => 'email',
                        'value'=>old('email',$siteInfo->email), 'placeholder' => 'Email will be here...', 'required'=> 'yes'
                        ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('email')])
                    </div>
                    <div class="form-group">
                        @include('components.backend.forms.input.input-type',[ 'name' => 'mobile',
                        'value'=>old('mobile',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=>
                        'yes' ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('mobile')])

                    </div>
                    <div class="form-group">
                        @include('components.backend.forms.input.input-image',[ 'name' => 'logo', 'placeholder' => 'logo
                        will be here...', 'required'=> 'yes' ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('logo')])
                    </div>

                    <div class="form-group">
                        <label class="col-form-label" for="validationCustom04"> Short Description </label>
                        <textarea class="form-control" id="validationCustom04" rows="5" name="short_desc" placeholder="What would you like to see?" style="height: 152px;">{!! old('short_desc', $siteInfo->short_desc)  !!}</textarea>
                        @error('short_desc')
                        <div class="invalid-feedback" role="alert">
                            <strong>{{ $short_desc }}</strong>
                        </div>
                        @enderror

                    </div>


                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-validation">

                    <div class="form-group">
                        @include('components.backend.forms.input.input-type',[ 'name' => 'service_charge',
                        'value'=>old('mobile',round($siteInfo->service_charge)),
                        'label' => 'Service Charge(%)',
                        'number' => true,
                        'placeholder' => 'service charge will be here...', 'required'=>
                        'yes' ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('service_charge')])
                    </div>
                    <label for="start_date">Business Start Date:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control"
                        value="{{  date('Y-m-d',strtotime($siteInfo["bu_start_date"])) }}"
                         name="bu_start_date" placeholder="date" required >
                    </div>

                    <div class="form-group">
                        <label for="currency_symbol_placement">Balance Shit Type:</label>
                        <select class="form-control select2" required id="balance_shit_type" name="balance_shit_type">
                            <option value="6" {{ $siteInfo->balance_shit_type=="6"?"selected":' '}}  >6 month</option>
                            <option value="12" {{ $siteInfo->balance_shit_type=="12"?"selected":' '}}  >12 month</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency_symbol_placement">Currency Symbol Placement:</label>
                        <select class="form-control select2" required id="currency_symbol_placement" name="currency_symbol_placement">
                            <option value="before" {{ $siteInfo->currency_symbol_placement=="before"?"selected":' '}}  >Before amount</option>
                            <option value="after" {{ $siteInfo->currency_symbol_placement=="after"?"selected":' '}}  >After amount</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label" for="country">Country <span class="text-danger">*</span> </label>
                        <select class="form-control show-tick ms select2" id="country" name="country" data-placeholder="Select" required>
                            @forelse ($countries as $countrieskey=>$country)
                            <option value="{{ $country['name'] }}" {{ $siteInfo->country == $country['name']? 'Selected' : ' '}}>{{ $country['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label" for="country">Default currency <span class="text-danger">*</span> </label>
                        <select class="form-control show-tick ms select2" id="currency" name="currency" data-placeholder="Select" required>
                            @forelse ($currencies as $currencykey=>$currency)
                            <option value="{{ $currency['name'] }}" {{ $siteInfo->currency == $currency['name']? 'Selected' : ' '}}>{{ $currency['name'] }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>

                    <div class="form-group">
                        <label class=" col-form-label" for="country">Timezone <span class="text-danger">*</span> </label>
                        <select class="form-control show-tick ms select2" id="dateTimeZone" name="datetimezone" data-placeholder="Select" required>
                            @forelse ($dateTimeZone as $zonekey=>$dateTimeZone)
                            <option value="{{ $zonekey }}" {{ $siteInfo->datetimezone == $zonekey ? 'Selected' : ' '}}>{{ $dateTimeZone }}</option>
                            @empty
                            @endforelse

                        </select>
                    </div>
                    <div class="form-group">
                        <label class=" col-form-label" for="date_format">Date Format: <span class="text-danger">*</span> </label>
                        <select class="form-control select2" required id="date_format" name="date_format">
                            <option value="dd-mm-yyyy"  {{ $siteInfo->date_format=="dd-mm-yyyy"?"selected":' '}}>dd-mm-yyyy</option>
                            <option value="mm-dd-yyyy"  {{ $siteInfo->date_format=="mm-dd-yyyy"?"selected":' '}}>mm-dd-yyyy</option>
                            <option value="dd/mm/yyyy"  {{ $siteInfo->date_format=="dd/mm/yyyy"?"selected":' '}}>dd/mm/yyyy</option>
                            <option value="mm/dd/yyyy"  {{ $siteInfo->date_format=="mm/dd/yyyy"?"selected":' '}}>mm/dd/yyyy</option>
                        </select>

                    </div>
                    <div class="form-group">
                        <label class=" col-form-label" for="accounting_method">Stock Accounting Method: <span class="text-danger">*</span> </label>
                        <select class="form-control select2" required id="accounting_method" name="accounting_method">
                            <option value="fifo"{{ $siteInfo->currency_symbol_placement=="fifo"?"selected":' '}}>FIFO (First In First Out)</option>
                            <option value="lifo" {{ $siteInfo->currency_symbol_placement=="lifo"?"selected":' '}}>LIFO (Last In First Out)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="currency_precision">Currency precision:*</label> <i class="fa fa-info-circle text-info hover-q no-print " aria-hidden="true"
                            data-container="body" data-toggle="popover" data-placement="auto bottom"
                            data-content="Number of digits after decimal point for currency value. Example:0.00 for value 2, 0.000 for value 3, 0.0000 for value 4" data-html="true" data-trigger="hover"></i>
                        <select class="form-control select2" required id="currency_precision" name="currency_precision">
                            <option value="0" {{ $siteInfo->currency_precision=="0"?"selected":' '}}>0</option>
                            <option value="1" {{ $siteInfo->currency_precision=="1"?"selected":' '}}>1</option>
                            <option value="2" {{ $siteInfo->currency_precision=="2"?"selected":' '}} >2</option>
                            <option value="3" {{ $siteInfo->currency_precision=="3"?"selected":' '}}>3</option>
                            <option value="4" {{ $siteInfo->currency_precision=="4"?"selected":' '}}>4</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="quantity_precision">Quantity precision:*</label>
                        <i class="fa fa-info-circle text-info hover-q no-print" aria-hidden="true"
                            data-container="body" data-toggle="popover" data-placement="auto bottom"
                            data-content="Number of digits after decimal point for quantity value. Example:0.00 for value 2, 0.000 for
                            value 3, 0.0000 for value 4" data-html="true" data-trigger="hover"></i>
                            <select class="form-control select2" required id="quantity_precision" name="quantity_precision">
                                <option value="0" {{ $siteInfo->quantity_precision=="0"?"selected":' '}}>0</option>
                                <option value="1" {{ $siteInfo->quantity_precision=="1"?"selected":' '}}>1</option>
                                <option value="2" {{ $siteInfo->quantity_precision=="2"?"selected":' '}}>2</option>
                                <option value="3" {{ $siteInfo->quantity_precision=="3"?"selected":' '}}>3</option>
                                <option value="4" {{ $siteInfo->quantity_precision=="4"?"selected":' '}}>4</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="default_datatable_page_entries">Default datatable page entries</label>
                        <select class="form-control select2" style="width: 100%;"  required id="default_datatable_page_entries" name="default_datatable_page_entries">
                            <option value="25"  selected="selected">25</option>
                            <option {{ $siteInfo->default_datatable_page_entries=="50"?"selected":' '}} value="50">50</option>
                            <option {{ $siteInfo->default_datatable_page_entries=="100"?"selected":' '}} value="100">100</option>
                            <option {{ $siteInfo->default_datatable_page_entries=="200"?"selected":' '}} value="200">200</option>
                            <option {{ $siteInfo->default_datatable_page_entries=="500"?"selected":' '}} value="500">500</option>
                            <option {{ $siteInfo->default_datatable_page_entries=="1000"?"selected":' '}} value="1000">1000</option>
                            <option {{ $siteInfo->default_datatable_page_entries=="-1"?"selected":' '}} value="-1">All</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group col-lg-12">
                <div class="d-block text-right">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
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
</script>
