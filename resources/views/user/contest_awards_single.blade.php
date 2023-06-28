@extends('layouts.main_layout')
@section('content')
<div class="row">
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

@endsection