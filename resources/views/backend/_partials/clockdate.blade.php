@push('css')
<link rel="stylesheet" href="{{ asset('assets/backend/clock/clock.css') }}">
@endpush

<div class="card overflowhidden">
    <div class="body p-0">
        <div id="clockdate">
            <div class="clockdate-wrapper" style="padding: 20px;">
              <div id="clock"></div>
              <div id="date"></div>
            </div>
          </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets/backend/clock/clock.js') }}"></script>
@endpush