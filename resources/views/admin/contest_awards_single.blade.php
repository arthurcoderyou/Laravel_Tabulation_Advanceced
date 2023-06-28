@extends('layouts.admin_layout')
@section('content')
  <?php 
    $total_scores = array();
    $index = 0;
    $rank = 1;
  
  ?>
  @auth
    @if(auth()->user()->role == 'admin')
      <div class="row">

        {{-- date table --}}

        <div class="col-sm-12">
          
          <div class="p-3 bg-secondary text-light">
            <h1>{{ $contest->contest_name }}</h1>
          </div>

          <div class="table-responsive mx-auto mt-2" style="width:95%;">
              <table class="table table-light no-wrap text-center" id="table">
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

                      {{-- main header --}}
                      <tr>
                          <th>#</th>
                          <th class="border-top-0" >Contestant</th>
                          @foreach ($judges as $judge)
                            @foreach($users as $user)

                              @if($user->id == $judge->user_id)
                                <th>{{ $user->name }}</th> 
                              @endif
                            @endforeach
                          @endforeach
                          
                          <th>Final</th>
                          <th>Award</th>
                      </tr>
                  </thead>

                  {{-- body --}}
                  <tbody>

                    @foreach($contestants as $contestant)
                      
                      <tr>
                        <td>{{ $contestant->id }}</td>
                        @foreach($users as $user)
                          @if($user->id == $contestant->user_id)
                            <td>{{ $user->name }}</td>
                          @endif
                        @endforeach
                      
                        <?php 
                          $score = 0;
                          $avg_count = 0;
                        ?>
                        @foreach($judgements as $judgement)
                          @if($judgement->contest_id == $contest->id && $judgement->contestant_id == $contestant->id)
                            <?php 
                              $score += $judgement->contestant_score;
                              $avg_count++;
                            ?>
                            <td>{{ $judgement->contestant_score }}</td>
                          
                          @endif
                        @endforeach

                        @if($score == 0 && $avg_count == 0)
                          <td>0</td>
                        @else
                          <td>{{ ($score / $avg_count) }}</td>
                        @endif
                        {{-- Contest Awarding Form --}}
                        <td>

                          {{-- check if the contestant is already awarded --}}
                          <?php $awarded = false;?>
                          @foreach($contest_awards as $contest_award)
                            @if($contest_award->contestant_id == $contestant->id)
                              <?php $awarded = true;?>
                            @endif
                          @endforeach

                          @if(!$awarded)
                          <form action="/admin/contest/contest_award_store" method="post">
                            @csrf
                            <div class="d-flex">
                              @foreach($users as $user)
                                @if($user->id == $contestant->user_id)
                                  <?php $name = $user->name; ?>
                                @endif
                              @endforeach
                              <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                              <input type="hidden" name="contest_id" value="{{ $contest->id }}">
                              <input type="text" name="award_name" class="form-control" placeholder="Award Name" required>
                              <button type="submit" class="btn btn-dark">OK</button>
                            </div>
                          </form>
                          @else
                            Awarded
                          @endif

                        </td>


                      </tr>

                    @endforeach
                    
                  </tbody>
                  
                  
              </table>

              
          </div>

          <div class="table-responsive mx-auto mt-2" style="width:95%;">
            <table class="table table-light no-wrap text-center">
              <thead>
                <th>Special Awards</th>
                <th>Contestant Name</th>
              </thead>
              <tbody>

                @foreach($subcontests as $subcontest)
                  <tr>
                    <th>{{ $subcontest->subcontest_name }}</th>


                    {{-- Sub Contest Awarding Form --}}
                    <td>
                      <form action="/admin/contest/sub_contest_award_store" method="post" class="">
                        @csrf
                        <div class="d-flex ">
                          
                          <input type="hidden" name="sub_contest_name" value="{{ $subcontest->subcontest_name }}">
                          <input type="hidden" name="sub_contest_id" value="{{ $contest->id }}">
                          <select name="contestant_id" id="" class="form-control  ">
                            <option value="">Select Contestant</option>
                            @foreach($contestants as $contestant)
                              @foreach($users as $user)
                              
                                @if($user->id == $contestant->user_id)
                                  <option value="{{ $contestant->id }}">{{ $user->name }}</option>
                                @endif
                              @endforeach
                            @endforeach
                          </select>
                          <button class="btn btn-dark">OK</button>
                        </div>
                      </form>
                    </td>


                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>



          <div class="table-responsive mx-auto mt-2" style="width:95%;">
            <table class="table table-light no-wrap text-center">
              <thead>
                <th>Final Awards List</th>
                <th>Contestant Name</th>
              </thead>
              <tbody>
                @foreach($contest_awards as $contest_award)
                  <tr>
                    <th>{{ $contest_award->award_name }}</th>
                    <td>
                      
                      @foreach($contestants as $contestant)
                        @if($contestant->id == $contest_award->contestant_id)
                          <?php $c_id = $contestant->user_id?>
                        @endif
                      @endforeach

                      @foreach($users as $user)
                        @if($user->id == $c_id)
                          {{ $user->name }}
                        @endif
                      @endforeach
                      
                    </td>
                  </tr>
                @endforeach

                @foreach($sub_contest_awards as $sub_contest_award)
                  <tr>
                    <th>{{ $sub_contest_award->award_name }}</th>

                    @foreach($contestants as $contestant)
                        @if($contestant->id == $sub_contest_award->contestant_id)
                          <?php $c_id = $contestant->user_id?>
                        @endif
                      @endforeach

                      @foreach($users as $user)
                        @if($user->id == $c_id)
                        <td>{{ $user->name }}</td>
                        @endif
                      @endforeach
                    
                   
                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>







        </div>

        

      </div>
      
    @endif
  @endauth

@endsection
