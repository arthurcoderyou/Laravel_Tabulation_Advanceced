@extends('layouts.judge_layout')
@section('content')

  @auth
    @if(auth()->user()->role == 'judge')

      <div class="row">
        <div class="p-2 text-center">
          @foreach($users as $user)
            @if($user->id == $judge->user_id)
              @php($judge_name = $user->name)
            @endif
          @endforeach
          <h1>Contest : {{ $contest->contest_name }} - Judge : {{ $judge_name }}</h1>
          
        </div>
        <div class="table-responsive mx-auto mt-2" style="width:95%;">
          <table class="table table-light no-wrap text-center" >
            <thead>
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
                <th>Contestant Name</th>
                  @foreach($criterias as $criteria)
                    
                    <th>{{ $criteria->criteria_name }} <span class="text-primary">{{ $criteria->criteria_percent * 100 }}</span>%</th>
                    
                  @endforeach

                  <th colspan="2">Actions</th>
                  <th>Total</th>

                </tr>
  
            </thead>
            <tbody>
              
              @foreach($contestants as $contestant)
                <tr>
                @foreach($users as $user)
                  @if($user->id == $contestant->user_id)
                      <th>{{ $user->name }} </th>
                  @endif
                @endforeach

                @php($checked = false)
                {{-- cehck if the judgement is already given on this one --}}
                @foreach($judgements as $judgement)
                  @if($judgement->contest_id == $contest->id && $judgement->judge_id == $judge->id && $judgement->contestant_id == $contestant->id)
                    @php($checked = true)
                    @break
                  @endif
                @endforeach

                <form action="/judge/judgement/create/{{ $contest->id }}/{{ $judge->id }}/{{ $contestant->id }}" method="post" class="text-center">
                  @csrf
                  @foreach($criterias as $criteria)
                  
                    <td>
                      <div class="d-flex">

                        <?php $link = 'judge';?>
                        <x-criteria-input :criteria_name="$criteria->criteria_name" :checked="$checked" :criteria_id="$criteria->id" :judge_id="$judge->id" :contestant_id="$contestant->id" :contest_id="$contest->id" :link="$link"></x-criteria-input>
                      </div>
                      
                    </td>
                    
                  @endforeach
                  <td>
                    <button type="submit" class="btn btn-dark {{ ($checked) ? 'disabled': ''}}" {{ ($checked) ? 'disabled': ''}}>{{ ($checked) ? 'Done': 'Save'}}</button>

                  </td>
                  <td>
                    <a href="/judge/judgement/delete/{{ $contest->id }}/{{ $judge->id }}/{{ $contestant->id }}" class="btn text-light {{ !($checked) ? 'disabled btn-outline-danger': 'btn-danger'}}" {{ !($checked) ? 'disabled': ''}}> Reset</a>
                    
                  </td>
                </form>

                  
                  <td>
                    @foreach($judgements as $judgement)
                      @if($judgement->contest_id == $contest->id && $judgement->judge_id == $judge->id && $judgement->contestant_id == $contestant->id)
                        {{ $judgement->contestant_score }}
                      @endif
                    @endforeach
                  </td>
                  
                

                </tr>
              @endforeach

            </tbody>
            
            


  
          </table>


          <div class="text-center p-5">
            <a href="/admin/judgements" class="btn btn-dark">Back</a>
          </div>
        </div>
        


      </div>

    @endif
  @endauth
@endsection