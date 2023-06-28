@extends('layouts.admin_layout')
@section('content')

  @auth
    @if(auth()->user()->role == 'admin' || auth()->user()->role == 'judge')

      <div class="row">
        <div class="p-2 text-center">
          
          <h1 class="bg-light p-3">{{ $criteria->criteria_name }} Criteria</h1>
          
        </div>

        <div class="table-responsive mx-auto mt-2" style="width:95%;">
          <table class="table table-light no-wrap text-center" >
            <thead>
              <th>Contest Name</th>
              <th>Judge Name</th>
              <th>Contestant Name</th>
            </thead>
            <tbody>
              <td>{{ $contest->contest_name }}</td>
              <td>{{ $user_judge->name }}</td>
              <td>{{ $user_cons->name }}</td>
            </tbody>
          </table>
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
              
              {{-- 
                <tr>
                  <th>Contestant Name</th>
                    @foreach($criterias as $criteria)
                      
                      <th>{{ $criteria->criteria_name }} <span class="text-primary">{{ $criteria->criteria_percent * 100 }}</span>%</th>
                      
                    @endforeach

                    <th colspan="2">Actions</th>
                    <th>Total</th>

                </tr>
               --}}
                @foreach($subcriterias as $subc)
                  <th>{{ $subc->sub_criteria_name }} - {{ ($subc->sub_criteria_percent * 100) }} %</th>
                @endforeach
                <th colspan="2">Actions</th>
                <th>Total</th>
            </thead>

            <?php 
              $checked = false;
            ?>

            @foreach($judgements as $judgement)
              @if($judgement->criteria_id == $criteria->id && $judgement->judge_id == $judge->id && $judgement->contestant_id == $contestant->id)
                @php($checked = true)
                @break
              @endif
            @endforeach

            <tbody>

              <?php $linkName = "";?>

              @if(auth()->user()->role == "admin")
                <?php $linkName = "admin";?> 
              @elseif(auth()->user()->role == "judge")
                <?php $linkName = "judge";?> 
              @endif
              
              <form action="/{{ $linkName }}/judgement/subcriteria_judgement/create" method="post">
                @csrf
                <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">
                <input type="hidden" name="judge_id" value="{{ $judge->id }}">
                <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">
                @foreach($subcriterias as $subc)
                  <td><input name="{{ $subc->sub_criteria_name }}" placeholder="{{ $subc->sub_criteria_name }}"class="form-control" type="number" min="1" max="99" skip="1" class=" form-control text-center {{ ($checked) ? 'disabled': ''}}" required {{ ($checked) ? 'disabled': ''}}></td>
                @endforeach
                <td>
                  <button type="submit" class="btn btn-dark {{ ($checked) ? 'disabled': ''}}" {{ ($checked) ? 'disabled': ''}}>{{ ($checked) ? 'Done': 'Save'}}</button>
                </td>
              </form>


              <td>
                <form action="/{{ $linkName }}/judgement/subcriteria_judgement/delete" method="post">
                  @csrf
                  <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">
                  <input type="hidden" name="judge_id" value="{{ $judge->id }}">
                  <input type="hidden" name="contestant_id" value="{{ $contestant->id }}">

                  <button class="btn text-light {{ !($checked) ? 'disabled btn-outline-danger': 'btn-danger'}}" {{ !($checked) ? 'disabled': ''}}>Reset</button>
                </form>
              </td>

              
              <td>
                @foreach($judgements as $judgement)
                  @if($judgement->criteria_id == $criteria->id && $judgement->judge_id == $judge->id && $judgement->contestant_id == $contestant->id)
                    {{ $judgement->contestant_score }}
                  @endif
                @endforeach

              </td>
            </tbody>


  
          </table>


          <div class="text-center p-5">
            <a href="/{{ $linkName }}/judgement/index/{{ $contest->id }}/{{ $judge->id }}" class="btn btn-dark">Back</a>
          </div>
        </div>
        


      </div>

    @endif
  @endauth

@endsection