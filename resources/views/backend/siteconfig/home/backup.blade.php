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
'fa' => 'fa fa-info-circle',
])


<form class="needs-validation" action="{{ route('backend.siteconfig.update') }}" method="Post" enctype="multipart/form-data">
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
                        @include('components.backend.forms.input.errorMessage', ['message' =>
                        $errors->first('name')])
                    </div>

                    <div class="form-group">
                        @include('components.backend.forms.input.input-type',[ 'name' => 'email',
                        'value'=>old('name',$siteInfo->email), 'placeholder' => 'Email will be here...', 'required'=> 'yes'
                        ])
                        @include('components.backend.forms.input.errorMessage', ['message' => $errors->first('email')])
                    </div>
                    <div class="form-group">
                        @include('components.backend.forms.input.input-type',[ 'name' => 'mobile', 'number' =>true,
                        'value'=>old('name',$siteInfo->mobile), 'placeholder' => 'Mobile will be here...', 'required'=>
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


@push('js')

<script src="{{ asset('assets/backend') }}/vendor/select2/select2.min.js"></script>

<script>
    $("#country").select2();
    $("#currency").select2();
    $("#dateTimeZone").select2();
</script>