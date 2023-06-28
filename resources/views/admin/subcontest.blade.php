@extends('layouts.admin_layout')
@section('content')

  @auth
    @if(auth()->user()->role == 'admin')
      <div class="row">

        {{-- date table --}}

        <div class="col-sm-12">
            
          <div class="table-responsive mx-auto mt-2" style="width:95%;">
              <table class="table table-light no-wrap" id="table">
                  <thead style="text-align:center;">

                      @if(session('success'))
                      <tr>
                        <td colspan="3">
                          <div class="alert alert-dismissible alert-success">{{ session('success') }}</div>
                        </td>
                      </tr>
                      @endif

                      <tr>
                          <th class="border-top-0">Contest Name</th>
                          {{-- 
                          <th class="border-top-0">Announcement Date</th>
                          <th class="border-top-0">Show Contest Result</th>
                             --}}
                          
                          <th colspan="2">Actions</th>
                      </tr>
                  </thead>
                  <tbody style=" justify-content:center; text-align:center;" >
                            
                           
                    @foreach ($contests as $contest)
                      <tr >
                        <td >{{ $contest->contest_name }}</td>

                        {{-- 
                        <td >{{ $contest->announcement_date }}</td>
                        <td >
                            @if($contest->show_contest_result == true) 
                                Show
                            @else
                                Hide
                            @endif
                        </td>
                         --}}

                        
                        <td id="{{ $contest->id }}" colspan="2">
                          <button class="btn btn-outline-info  view_sub_cons" >View Sub-Contest</button>
                        </td>
                        
                          
                      </tr>

                      
                      
                        @foreach ($subcontests as $subcontest) 

                          @if($subcontest->contest_id != $contest->id)
                            @continue
                          @endif 
                          {{--  class="subcontests_tr" id="subcontests_tr_{{ $contest->id }}" --}}
                          {{-- SubContest Action Buttons --}}
                            <tr class="subcontests_tr subcontests_tr_{{ $contest->id }}">
                              <td colspan="" class="bg-secondary" style="color:#fff;">{{ $subcontest->subcontest_name }}</td>

                              <td id="{{ $subcontest->id }}">
                                <button class="btn btn-info text-light subcon_update_btn" >Update</button>
                              </td>
                              <td>
                                  <form action="/admin/subcontest/delete/{{ $subcontest->id }}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-danger text-light" >Delete</button>
                                  </form>
                              </td>
                            </tr>
                          {{--end of SubContest Action Buttons --}}


                          {{-- SubContest Update Form --}}
                            <tr class="subcon_upf subcon_upf_{{ $contest->id }}_{{ $subcontest->id }}">
                              <td colspan="3">
                                <form method="post" action="/admin/subcontest/update/{{ $subcontest->id }}" class="text-light bg-info w-75 p-3 rounded rounded-3 mx-auto">
                                  @csrf
                                  <legend>Update SubContest</legend>
                                  <input name="subcontest_name" type="text" class="form-control text-center" value="{{ $subcontest->subcontest_name }}">
                                  <button type="submit" class="btn btn-dark mt-1">Update</button>
                                </form>
                              </td>
                              
                            </tr>
                          {{--end of SubContest Update Form --}}
                          

                        @endforeach
                        
                      {{-- Add SubContest --}}
                        <tr class="add_sub_con" id="add_sub_{{ $contest->id }}">
                          <td colspan="5"> 
                            <button class="btn btn-dark add_con_btn" >Add SubContest</button>
                          </td>
                        </tr>

                        <tr class="add_form_con" id="add_form_{{ $contest->id }}">
                          <td colspan="5">
                            <form action="/admin/subcontest/create" method="post" class="w-75 bg-dark rounded rounded-1 mx-auto p-5 text-light ">
                              @csrf
                              <legend>Add SubContest</legend>
                              <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                              <input type="text" name="subcontest_name" class="form-control text-center" id="" placeholder="SubContest name...">
                              <button class="btn btn-outline-light mt-2">Create</button>
                            </form>
                          </td>
                        </tr>


                      {{-- end of Add Subcontest --}}
                      
                      <tr class="sub_con_hide_btn_con " id="sub_con_hide_btn_con_{{ $contest->id }}">
                        <td colspan="5"> 
                          <button class="btn btn-light sub_con_hide_btn" >Hide SubContest</button>
                        </td>
                      </tr>
                        
                    @endforeach
                  

                </tbody>

              </table>
          </div>
        </div>

        <div class="text-bg-light mx-5" > 
          {{ $contests->links() }}
        </div>

      </div>
      
    @endif
  @endauth

@endsection