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
                        <td colspan="7">
                          <div class="alert alert-dismissible alert-success">{{ session('success') }}</div>
                        </td>
                      </tr>
                      @endif

                      @error('email')
                        <tr>
                          <td colspan="7">
                            <div class="alert alert-dismissible alert-danger">{{ $message }}</div>
                          </td>
                        </tr>
                      @enderror

                      <tr>
                          <th class="border-top-0" colspan="3">Contest Name</th>
                         
                          
                          <th colspan="2">Actions</th>
                      </tr>
                  </thead>
                  {{-- --}}
                  <tbody style=" justify-content:center; text-align:center;" >
                            
                          
                    @foreach ($contests as $contest)
                      <tr >
                        <td colspan="4">{{  $contest->contest_name }}</td>

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
                        

                        
                        <td colspan="" id="{{ $contest->id }}" colspan="2">
                          <button class="btn btn-outline-info  view_sub_cons" >View Judges</button>
                        </td>
                        
                          
                      </tr>
                      <tr class="con_header con_header_{{ $contest->id }}" >
                        <th colspan="4">Judge Name</th>
                        <th colspan="2">Actions</th>
                      </tr>
                        
                      
                        @foreach ($judges as $judge) 
                          
                          @if($judge->contest_id != $contest->id)
                            @continue
                          @endif 
                          {{--  class="subcontests_tr" id="subcontests_tr_{{ $contest->id }}" --}}
                          {{-- Contestant Action Buttons --}}
                            <tr style="border:1px solid skyblue" class=" subcontests_tr subcontests_tr_{{ $contest->id }}">

                              @foreach($users as $user)
                                @if($user->id == $judge->user_id)
                                  @php 
                                    $u_imgsrc = $user->photo;
                                    $u_name = $user->name;
                                    $u_id = $user->id;
                                  @endphp
                                @endif
                              @endforeach

                              
                              
                               
                              <td colspan="4" class="bg-light " style="color:gray; letter-spacing:0.1rem;">
                                <p class="text-truncate">{{ $u_name }}</p>
                              </td>

                             

                              
                              
                              <td colspan="2" id="{{ $judge->id }}">
                                <a href="/admin/judgement/index/{{ $contest->id }}/{{ $judge->id }}" class="btn btn-info text-light subcon_update_btn" >Make Judgement</a>
                              </td>
                              
                            </tr>
                            
                          {{--end of Contestant Action Buttons --}}


                        @endforeach
                        
                      
                      
                      <tr class="sub_con_hide_btn_con " id="sub_con_hide_btn_con_{{ $contest->id }}">
                        <td colspan="7"> 
                          <button class="btn btn-light sub_con_hide_btn" >Hide Contestants</button>
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
