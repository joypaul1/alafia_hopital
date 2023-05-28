@extends('backend.layout.app')
@include('backend._partials.datatable__delete')

@section('page-header')

@stop
@push('css')
@endpush
@section('content')

    {{-- @include('backend._partials.page_header', [
    'fa' => 'fa fa-plus-circle',
    'name' => 'Create Patient',
    'route' => route('backend.patient.add'),
]) --}}


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center p-2">
                    <i class="fa fa-user"></i> <strong>{{  $history->name  }}</strong> , History of Appointment List
                </div>
                <div class="body">
                    @forelse ($history->doctorAppointment as $data)
                        <div class="timeline-item green" date-is="{{ date('m-d-y', strtotime($data->appointment_date)) }}">
                            <h5></h5>
                            <span><a href="javascript:void(0);">{{ optional($data->doctor)->first_name ?? ' ' }}
                                    {{ optional($data->doctor)->last_name ?? ' ' }}</a></span>
                            <div class="msg">
                                <p>
                                    <strong>C/C : </strong>

                                    @forelse ($data->prescription->diseasesSymptoms??[] as $symptomsData)
                                        {{ optional($symptomsData->symptom)->name }},
                                    @empty
                                    @endforelse

                                </p>
                                @if ($data->prescription)
                                    <a href="{{ route('backend.prescription.show', $data->prescription->id) }}"
                                        target="_blank">
                                        <button class="btn btn-primary">View Prescription <i
                                        class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> </button></a>
                                @endif


                            </div>
                        </div>
                    @empty
                    @endforelse

                </div>
            </div>
        </div>
    </div>



@endsection

@push('js')
@endpush
