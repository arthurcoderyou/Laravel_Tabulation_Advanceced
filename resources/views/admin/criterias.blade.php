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
                          {{-- 
                          <th class="border-top-0">Announcement Date</th>
                          <th class="border-top-0">Show Contest Result</th>
                            --}}
                          
                          <th colspan="3">Actions</th>
                      </tr>
                  </thead>
                  <tbody style=" justify-content:center; text-align:center;" >
                            
                          
                    @foreach ($contests as $contest)
                      <tr >
                        <td colspan="3">{{  $contest->contest_name }}</td>

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

                        
                        <td id="{{ $contest->id }}" colspan="3">
                          <button class="btn btn-outline-info  view_sub_cons" >View Criterias</button>
                        </td>
                        
                          
                      </tr>
                      <tr class="con_header con_header_{{ $contest->id }}" >
                        
                        <th>Name</th>
                        <th>Description</th>
                        <th>Percent</th>
                        <th colspan="2"></th>
                        <th></th>
                      </tr>
                        
                      
                        @foreach ($criterias as $criteria) 
                          
                          @if($criteria->contest_id != $contest->id)
                            @continue
                          @endif 
                          {{--  class="subcontests_tr" id="subcontests_tr_{{ $contest->id }}" --}}
                          {{-- Contestant Action Buttons --}}
                            <tr style="border:1px solid skyblue" class=" subcontests_tr subcontests_tr_{{ $contest->id }}">


                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; max-width:15vw;"><p class="text-truncate">{{ $criteria->criteria_name }}</p></td>

                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; max-width:15vw;"><p class="text-truncate">{{ $criteria->criteria_description }}</p></td>

                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; max-width:15vw;"><p class="text-truncate">{{ ($criteria->criteria_percent * 100) }} %</p></td>

                              
                              
                              <td id="{{ $criteria->id }}">
                                <button class="btn btn-info text-light subcon_update_btn" >Update</button>
                              </td>
                              <td>
                                  <form action="/admin/criteria/delete/{{ $criteria->id }}" method="post">
                                      @csrf
                                      <button type="submit" class="btn btn-danger text-light" >Delete</button>
                                  </form>
                              </td>
                              <?php 
                                $table = 'sub_criterias';
                                
                              ?>
                              <td><a href="/admin/subcriterias/{{ $criteria->id }}" class="btn btn-warning">Sub-Criterias <x-badge :table_name="$table" :condition_id="$criteria->id"></x-badge> </a></td>
                            </tr>
                          {{--end of Contestant Action Buttons --}}


                          {{-- Contestant Update Form --}}
                            <tr class="subcon_upf subcon_upf_{{ $contest->id }}_{{ $criteria->id }}">
                              <td colspan="7">
                                
                                <form method="post" action="/admin/criteria/update/{{ $criteria->id }}" class="text-light bg-info w-50 p-3 rounded rounded-3 mx-auto text-center" enctype="multipart/form-data">
                                  @csrf
                                  <legend>Update Criteria</legend>

                                
                                  <input value="{{ $criteria->criteria_name }}" type="text" name="criteria_name" class="form-control text-center mb-0" id="" placeholder="Criteria name..." style="font-size: 1.5rem;">
                                  <label class="mb-3 form-label-control">Criteria Name</label>
                                  
                                  <!-- -1 on the index because arrays starts at 0 -->

                                  <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                                  
                                  <textarea name="criteria_description" id="" class="form-control text-center mb-0" cols="10" placeholder="Criteria Description...">{{ $criteria->criteria_description }}</textarea>
                                  <label class="mb-3 form-label-control">Criteria Description</label>

                                  <input value="{{ $criteria->criteria_percent }}" type="number" name="criteria_percent" class="form-control text-center mb-0" id="" placeholder="Criteria Percent..." min="0.01" max="0.99" step="0.01">
                                  <label class="mb-3 form-label-control">Criteria Percent</label>

                                  
                                  <button type="submit" class="btn btn-dark mt-1 d-block mx-auto">Update</button>
                                  

                                </form>
                              </td>
                              
                            </tr>
                          {{--end of Contestant Update Form --}}
                          

                        @endforeach
                        
                      {{-- Add Contestant --}}
                        <tr class="add_sub_con" id="add_sub_{{ $contest->id }}">
                          <td colspan="7"> 
                            <button class="btn btn-dark add_con_btn" >Add Criteria</button>
                          </td>
                        </tr>

                        <tr class="add_form_con" id="add_form_{{ $contest->id }}">
                          <td colspan="7">
                            <form action="/admin/criteria/create" method="post" class="w-75 bg-warning rounded rounded-1 mx-auto p-5 text-light " enctype="multipart/form-data">
                              @csrf
                              <legend>Add Criteria</legend>
                              
                              <input type="hidden" name="contest_id" value="{{ $contest->id }}" >

                              <input type="text" name="criteria_name" class="form-control text-center mb-1" id="" placeholder="Criteria name..." required>
                              
                              <textarea name="criteria_description" id="" class="form-control text-center mb-1" cols="10" placeholder="Criteria Description..." required></textarea>

                              <input value="" type="number" name="criteria_percent" class="form-control text-center mb-0" id="" placeholder="Criteria Percent..." min="0.01" max="0.99" step="0.01">

                              <button type="submit" class="btn btn-outline-light mt-2">Create</button>
                            </form>
                          </td>
                        </tr>


                      {{-- end of Add Contestant --}}
                      
                      <tr class="sub_con_hide_btn_con " id="sub_con_hide_btn_con_{{ $contest->id }}">
                        <td colspan="7"> 
                          <button class="btn btn-light sub_con_hide_btn" >Hide Criterias</button>
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
