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
                          <th class="border-top-0" colspan="5">Contest Name</th>
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
                        <td colspan="5">{{  $contest->contest_name }}</td>

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
                          <button class="btn btn-outline-info  view_sub_cons" >View Contestants</button>
                        </td>
                        
                          
                      </tr>
                      <tr class="con_header con_header_{{ $contest->id }}" >
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Number</th>
                        <th>Message</th>
                        <th>Representing</th>
                        <th colspan="2"></th>
                      </tr>
                        
                      
                        @foreach ($contestants as $contestant) 
                          
                          @if($contestant->contest_id != $contest->id)
                            @continue
                          @endif 
                          {{--  class="subcontests_tr" id="subcontests_tr_{{ $contest->id }}" --}}
                          {{-- Contestant Action Buttons --}}
                            <tr style="border:1px solid skyblue" class=" subcontests_tr subcontests_tr_{{ $contest->id }}">
                              <td>

                                @foreach($users as $user)
                                  @if($user->id == $contestant->user_id)
                                    @php  
                                      $imgsrc = $user->photo; 
                                    @endphp
                                  @endif
                                @endforeach
                                <img src="{{ (!empty($imgsrc)) ? url('upload/'.$imgsrc) : url('upload/no_image.jpg') }}" alt="user-img" class="w-50" style="max-width:200px;">
                              </td>

                              {{-- to be repaired
                              <td colspan="" class="bg-light" style="color:gray; letter-spacing:0.1rem; font-weight:bold;">{{ $users[($contestant->user_id - 1)]->name }}</td>
                                 --}}

                              <td class="bg-light" style="color:gray; letter-spacing:0.1rem; font-weight:bold;">
                                @foreach($users as $user)
                                  @if($user->id == $contestant->user_id)
                                    {{ $user->name }}
                                  @endif
                                @endforeach
                              </td>

                              <!-- -1 on the index because arrays starts at 0 -->

                              <td colspan="" class="bg-light" style="color:gray; letter-spacing:0.1rem; font-weight:bold;">{{ $contestant->contestant_number }}</td>
                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; max-width:15vw;"><p class="text-wrap">{{ $contestant->contestant_message }}</p></td>
                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; font-weight:bold;">{{ $contestant->contestant_representing }}</td>

                              <td id="{{ $contestant->id }}">
                                <button class="btn btn-info text-light subcon_update_btn" >Update</button>
                              </td>
                              <td>
                                  <form action="/admin/contestant/delete/{{ $contestant->id }}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-danger text-light" >Delete</button>
                                  </form>
                              </td>
                            </tr>
                          {{--end of Contestant Action Buttons --}}


                          {{-- Contestant Update Form --}}
                            <tr class="subcon_upf subcon_upf_{{ $contest->id }}_{{ $contestant->id }}">
                              <td colspan="7">
                                
                                <form method="post" action="/admin/contestant/update/{{ $contestant->id }}" class="text-light bg-info w-50 p-3 rounded rounded-3 mx-auto text-center" enctype="multipart/form-data">
                                  @csrf
                                  <legend>Update Contestant</legend>

                                
                                  @foreach($users as $user)
                                    @if($user->id == $contestant->user_id)
                                      @php 
                                        $u_id = $user->id;
                                        $u_name = $user->name;
                                        $u_photo = $user->photo;
                                      @endphp
                                    @endif
                                  @endforeach
                                  <input type="hidden" name="user_id" value="{{ $u_id }}">
                                  

                                  <input value="{{ $u_name }}" type="text" name="contestant_name" class="form-control text-center mb-0" id="" placeholder="Contestant name..." style="font-size: 1.5rem;">
                                  <label class="mb-3 form-label-control">Contestant Name</label>
                                  
                                  <!-- -1 on the index because arrays starts at 0 -->

                                  
                                  <input value="{{ $u_photo }}" type="file" name="photo" id="photo" class="form-control text-center mb-0" id="" placeholder="Contestant photo..." >
                                  <label class="mb-3 form-label-control">Upload new Contestant Photo</label>

                                  {{-- 
                                  <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                                     --}}
                                     {{-- for updating the contest for the contestant --}}
                                  <input type="hidden" name="contest_id" value="{{ $contest->id }}">


                                  <input value="{{ $contestant->contestant_number }}" type="number" name="contestant_number" class="form-control text-center mb-0" id="" placeholder="Contestant number...">
                                  <label class="mb-3 form-label-control">Contestant Number</label>
                                  
                                  <textarea name="contestant_message" id="" class="form-control text-center mb-0" cols="10" placeholder="Contestant Message...">{{ $contestant->contestant_message }}</textarea>
                                  <label class="mb-3 form-label-control">Contestant Message</label>

                                  <input value="{{ $contestant->contestant_representing }}" type="text" name="contestant_representing" class="form-control text-center mb-0" id="" placeholder="Contestant representing...">
                                  <label class="mb-3 form-label-control">Contestant Representing</label>
                                  
                                  <button type="submit" class="btn btn-dark mt-1 d-block mx-auto">Update</button>


                                </form>
                              </td>
                              
                            </tr>
                          {{--end of Contestant Update Form --}}
                          

                        @endforeach
                        
                      {{-- Add Contestant --}}
                        <tr class="add_sub_con" id="add_sub_{{ $contest->id }}">
                          <td colspan="7"> 
                            <button class="btn btn-dark add_con_btn" >Add Contestant</button>
                          </td>
                        </tr>

                        <tr class="add_form_con" id="add_form_{{ $contest->id }}">
                          <td colspan="7">
                            <form action="/admin/contestant/create" method="post" class="w-75 bg-warning rounded rounded-1 mx-auto p-5 text-light " enctype="multipart/form-data">
                              @csrf
                              <legend>Add Contestant</legend>
                              
                              <input type="hidden" name="contest_id" value="{{ $contest->id }}" >
                              <input type="text" name="contestant_name" class="form-control text-center mb-1" id="" placeholder="Contestant name..." required>
                              
                              <input type="file" name="con_photo" class="form-control text-center mb-1" id="" placeholder="Contestant image..." required>
                              <p class="mt-0 mb-1">Contestant image</p>

                              <input type="number" name="contestant_number" class="form-control text-center mb-1" id="" placeholder="Contestant number..." required>
                              
                              <textarea name="contestant_message" id="" class="form-control text-center mb-1" cols="10" placeholder="Contestant Message..." required></textarea>
                              <input type="text" name="contestant_representing" class="form-control text-center mb-1" id="" placeholder="Contestant representing..." required>

                              <p class="mb-0 mt-2">Login Credentials</p>
                              <!-- contestant login credentials-->
                                <input type="email" name="email" class="form-control text-center mb-1 mx-auto bg-light text-dark" style="width:90%;" id="" placeholder="Contestant login email..." required>
                                <input type="password" name="password" class="form-control text-center mb-1 mx-auto bg-light text-dark" style="width:90%;" id="" placeholder="Contestant login password..." required>
                              <!-- end of contestant login credentials-->
                              <button type="submit" class="btn btn-outline-light mt-2">Create</button>
                            </form>
                          </td>
                        </tr>


                      {{-- end of Add Contestant --}}
                      
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
