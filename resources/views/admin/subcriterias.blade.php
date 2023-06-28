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
                        <td colspan="6">
                          <div class="alert alert-dismissible alert-success">{{ session('success') }}</div>
                        </td>
                      </tr>
                      @endif

                      @error('email')
                        <tr>
                          <td colspan="6">
                            <div class="alert alert-dismissible alert-danger">{{ $message }}</div>
                          </td>
                        </tr>
                      @enderror

                      <tr>
                        <th colspan="5"><h3>{{ $criteria->criteria_name }}</h3> </th>
                      </tr>
                      <tr>
                        <th>Name</th>
                        <th>Percent</th>
                        <th colspan="2"></th>
                      </tr>
                  </thead>
                  <tbody style=" justify-content:center; text-align:center;" >
                         
                        @foreach ($subcriterias as $subcriteria) 
                          
                          
                          {{--  class="subcontests_tr" id="subcontests_tr_{{ $contest->id }}" --}}
                          {{-- Contestant Action Buttons --}}
                            <tr style="border:1px solid skyblue" class="">


                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; max-width:15vw;"><p class="text-truncate">{{ $subcriteria->sub_criteria_name }}</p></td>

                              
                              <td colspan="" class="bg-light " style="color:gray; letter-spacing:0.1rem; max-width:15vw;"><p class="text-truncate">{{ ($subcriteria->sub_criteria_percent * 100) }} %</p></td>

                              
                              
                              <td id="{{ $subcriteria->id }}">
                                <button class="btn btn-info text-light update_subc_btn" >Update</button>
                              </td>
                              <td>
                                  <form action="/admin/criteria/subcriteria/delete" method="post">
                                      @csrf
                                      <input type="hidden" name="subcriteria_id" value="{{ $subcriteria->id }}">
                                      <button type="submit" class="btn btn-danger text-light" >Delete</button>
                                  </form>
                              </td>
                            </tr>
                          {{--end of Contestant Action Buttons --}}


                          {{-- update form --}}
                          <tr class="update_subc update_subc_{{ $subcriteria->id }}">
                            <td colspan="7">
                              
                              <form method="post" action="/admin/criteria/subcriteria/update" class="text-light bg-info w-50 p-3 rounded rounded-3 mx-auto text-center" enctype="multipart/form-data">
                                @csrf
                                <legend>Update Criteria</legend>

                                <input type="hidden" name="subcriteria_id" value="{{ $subcriteria->id }}">
                                <input value="{{ $subcriteria->sub_criteria_name }}" type="text" name="subcriteria_name" class="form-control text-center mb-0" id="" placeholder="SubCriteria name..." style="font-size: 1.5rem;">
                                <label class="mb-3 form-label-control">SubCriteria Name</label>
                                
                                <!-- -1 on the index because arrays starts at 0 -->

                                

                                <input value="{{ $subcriteria->sub_criteria_percent }}" type="number" name="subcriteria_percent" class="form-control text-center mb-0" id="" placeholder="SubCriteria Percent..." min="0.01" max="0.99" step="0.01">
                                <label class="mb-3 form-label-control">SubCriteria Percent</label>

                                
                                <button type="submit" class="btn btn-dark mt-1 d-block mx-auto">Update</button>
                                

                              </form>
                            </td>
                            {{-- end of update form --}}
                        @endforeach
                        
                      {{-- Add Contestant --}}
                        <tr class="" id="add_sub_1">
                          <td colspan="7"> 
                            <button class="btn btn-dark add_subc" >Add SubCriteria</button>
                          </td>
                        </tr>

                        <tr class="add_form_subc" >
                          <td colspan="7">
                            <form action="/admin/criteria/subcriteria/create" method="post" class="w-75 bg-warning rounded rounded-1 mx-auto p-5 text-light " enctype="multipart/form-data">
                              @csrf
                              <legend>Add Criteria</legend>
                              
                              <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">

                              <input type="text" name="subcriteria_name" class="form-control text-center mb-1" id="" placeholder="Criteria name..." required>
                              

                              <input value="" type="number" name="subcriteria_percent" class="form-control text-center mb-0" id="" placeholder="Criteria Percent..." min="0.01" max="0.99" step="0.01">

                              <button type="submit" class="btn btn-outline-light mt-2">Create</button>
                            </form>
                          </td>
                        </tr>

                        


                      {{-- end of Add Contestant --}}
                      
                      <tr class="hide_subc " >
                        <td colspan="7"> 
                          <button class="btn btn-light hide_subc_btn" >Hide SubCriterias</button>
                        </td>
                      </tr>
                        
                    
                  

                </tbody>

              </table>
          </div>
        </div>

        <div class="text-bg-light mx-5" > 
          {{ $subcriterias->links() }}
        </div>

      </div>
      
    @endif
  @endauth

@endsection
