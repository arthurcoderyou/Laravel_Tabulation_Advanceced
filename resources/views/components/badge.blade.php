<?php 

    
    $count = DB::table($tableName)->where('criteria_id',$conditionId)->count();
    
?>

<span class="badge badge-primary bg-dark">{{ $count }}</span>