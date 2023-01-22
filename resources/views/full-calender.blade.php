@extends('backend.layout.app')
@push('css')
{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/nestable/jquery-nestable.css" /> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.css" />
{{-- <link rel="stylesheet" href="{{ asset('assets/backend') }}/vendor/sweetalert/sweetalert.css" /> --}}
<style>
   .dd-empty{
      display: none;
   }
</style>
@endpush

@section('page-header')
<i class="fa fa-file"></i>Work flow System
@stop
@section('content')

@include('backend._partials.page_header', [
'fa' => 'fa fa-plus-circle',
'name' => 'Work flow System',
'route' => '#'
])
 <div class="row clearfix">

        <!-- Start lane -->
        <div class="col-12 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-light">
              <h3 class="card-title h5 mb-1">
                Backlog
              </h3>
             
            </div>
            <div class="card-body">
              <div class="tasks" id="backlog">
                <!-- Start task -->
                <div class="card"></div>
                <div class="card mb-3 cursor-grab">
                  <div class="card-body">
                    <p class="mb-0">You can move these elements between the containers</p>
                    <div class="text-right">
                      <small class="text-muted mb-1 d-inline-block">25%</small>
                    </div>
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <!-- End task -->
               
              </div>
              <div class="btn btn-primary btn-block">Add task</div>
            </div>
          </div>
        </div>
        <!-- End lane -->
    
        <!-- Start lane -->
        <div class="col-12 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-light">
               <h3 class="card-title h5 mb-1">
                  In Progress
               </h3>
             
            </div>
            <div class="card-body">
              <div class="tasks" id="progress">
                <!-- Start task -->
                <div class="card mb-3 cursor-grab">
                  <div class="card-body">
                    <span class="badge bg-danger text-white mb-2">Bug</span>
                    {{-- <p class="mb-0">Moving them anywhere else isn't quite possible</p> --}}
                   
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <!-- End task -->
                <!-- Start task -->
                <div class="card mb-3 cursor-grab">
                  <div class="card-body">
                    <p class="mb-0">Anything can be moved around. That includes images, links or any other nested elements.</p>
                    <div class="text-right">
                      <small class="text-muted mb-1 d-inline-block">75%</small>
                    </div>
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <!-- End task -->
              </div>
              <div class="btn btn-primary btn-block">Add task</div>
            </div>
          </div>
        </div>
        <!-- End lane -->
    
        <!-- Start lane -->
        <div class="col-12 col-lg-4">
          <div class="card mb-3">
            <div class="card-header bg-light">
              <h3 class="card-title h5 mb-1">
                Completed
              </h3>
              <small class="mb-0 text-muted">
                Curabitur ligula sapien, tincidunt non.
              </small>
            </div>
            <div class="card-body">
              <div class="tasks" id="completed">
                <!-- Start task -->
                <div class="card mb-3 cursor-grab">
                  <img class="card-img-top" src="https://source.unsplash.com/zNRITe8NPqY/400x200" alt="Bootstrap Kanban Board" />
                  <div class="card-body">
                    <span class="badge bg-warning text-white mb-2">Enhancement</span>
                    <p class="mb-0">Moving them anywhere else isn't quite possible</p>
                    <div class="text-right">
                      <small class="text-muted mb-1 d-inline-block">95%</small>
                    </div>
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 95%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <!-- End task -->
                <!-- Start task -->
                <div class="card mb-3 cursor-grab">
                  <div class="card-body">
                    <p class="mb-0">You can move these elements between the containers</p>
                    <div class="text-right">
                      <small class="text-muted mb-1 d-inline-block">80%</small>
                    </div>
                    <div class="progress" style="height: 5px;">
                      <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <!-- End task -->
              </div>
              <div class="btn btn-primary btn-block">Add task</div>
            </div>
          </div>
        </div>
        <!-- End lane -->


 </div>


@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js"></script>
{{-- <script src="{{ asset('assets/backend') }}/vendor/nestable/jquery.nestable.js"></script> 
<script src="{{ asset('assets/backend') }}/vendor/sweetalert/sweetalert.min.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/ui/sortable-nestable.js"></script>
<script src="{{ asset('assets/backend') }}/js/pages/ui/dialogs.js"></script> --}}
<script>
  dragula([
      document.querySelector('#backlog'),
      document.querySelector('#progress'),
      document.querySelector('#completed')
   ]);
</script>

@endpush
