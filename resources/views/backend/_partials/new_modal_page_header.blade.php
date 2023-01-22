
{{-- <div class="card d-flex clearfix"> --}}
    <div class="header">
        <span href="#" style="font-size: 18px;font-weight:700">
            @yield('page-header')
        </span> 
        <button href="#" data-href="{{ $route }}"  
            class="btn btn-info btn-md pull-right" id="{{$modelName??'create'}}"  data-container=".{{$modelName??'dataContainer'}}">
            <i class="{{$fa}} me-2"></i> {{ $name }}
        </button>
    </div>
{{-- </div> --}}
