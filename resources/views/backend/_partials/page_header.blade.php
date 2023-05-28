

<div class="card d-flex clearfix">
    <div class="header">
        <span href="#" style="font-size: 18px;font-weight:700">
            @yield('page-header')
        </span>
        @isset($name)
        <a  href="@isset($route){{ $route }}@else # @endisset" @isset($target) target="_blank"  @endisset class="btn btn-info btn-md pull-right">
            <i class="@isset($fa){{ $fa }}@endisset me-2"></i> {{ $name }}
        </a>
        @endisset
    </div>
</div>

