
<?php 
    $count = 0;
    $subcriterias = DB::table('sub_criterias')->where('criteria_id',$criteriaId)->get();

    foreach ($subcriterias as $subcrt) {
        $count++;
    }


    $results = DB::table('sub_criteria_judgments')
        ->where('criteria_id',$criteriaId)
        ->where('judge_id',$judgeId)
        ->where('contestant_id',$contestantId)
        ->first();

    
    
    

?>

@if($count == 0)
    <input name="{{ $criteriaName }}" type="number" min="1" max="99" skip="1" class=" form-control text-center {{ ($checked) ? 'disabled': ''}}" required {{ ($checked) ? 'disabled': ''}}>
@else

    @if(!empty($results))
        <input name="{{ $criteriaName }}" type="number" min="1" max="99" skip="1" class=" form-control text-center " required value="{{ $results->contestant_score }}" readonly style="color:{{ ($checked) ? 'transparent': ''}}">
    @else
        <a href="/{{ $link }}/judgement/subcriteria_judgement/{{ $criteriaId }}/{{ $judgeId }}/{{ $contestantId }}/{{ $contestId }}" class="btn btn-dark">Subcriterias</a>
    @endif

        
    
@endif
