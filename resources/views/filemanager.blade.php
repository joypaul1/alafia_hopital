@extends('backend.layout.app')
@push('css')

<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>
<style>
    .btn-close::after {
        content: ' \00D7';
        color: red;
    }

</style>
@endpush

@section('page-header')
<i class="fa fa-file"></i> File Management System
@stop
@section('content')

@include('backend._partials.page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'File & Folder Create Here',
'route' => '#'
])

<div class="row">
    <div class="col-md-12" id="fm-main-block">
        <div id="fm"></div>
    </div>

</div>

@endsection

@push('js')

<script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('fm-main-block').setAttribute('style', 'height:' + window.innerHeight + 'px');

        fm.$store.commit('fm/setFileCallBack', function(fileUrl) {
            window.opener.fmSetLink(fileUrl);
            window.close();
        });
    });

</script>


@endpush
