
<div class="card d-flex clearfix mt-4">
    <div class="header">
        <span href="#" style="font-size: 18px;font-weight:700">
            @yield('page-header')
        </span> 
        <a  href="@isset($route){{ $route }}@else # @endisset" class="btn btn-info btn-md pull-right">
            <i class="@isset($fa){{ $fa }}@endisset me-2"></i> @isset($name){{ $name }}@endisset
        </a>
    </div>
</div>