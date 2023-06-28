@extends('layouts.main_layout')
@section('content')
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 p-3">
      <div class="card white-box p-0">
          <div class="card-body">
              <h3 class="box-title mb-0">Judges</h3>
          </div>
          <div class="comment-widgets">
              <!-- Judge Row -->
            @foreach($judges as $judge)

              <div class="d-flex flex-row comment-row p-3 mt-0">
                  <div class="p-2"><img src="{{ asset('upload/'.$judge->photo ) }}" alt="user" width="100" class="rounded-circle"></div>
                  <div class="comment-text ps-2 ps-md-3 w-100">
                      <h5 class="font-medium">{{ $judge->name }}</h5>
                      <span class="mb-3 d-block">{{ $judge->email }}</span>
                      <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                      <span class="mb-3 d-block">Lorem Ipsum is simply dummy text of the printing and type setting industry.It has survived not only five centuries. </span>
                     
                  </div>
              </div>
            @endforeach 
          </div>
      </div>
  </div>

  </div>
@endsection