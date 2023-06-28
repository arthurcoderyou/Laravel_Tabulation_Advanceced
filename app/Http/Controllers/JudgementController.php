<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judgement;
use App\Models\Contestant;
use App\Models\SubCriteria;
use Illuminate\Http\Request;
use App\Models\SubCriteriaJudgment;

class JudgementController extends Controller
{
    //
    public function index(Request $request,$contest_id, $judge_id){
        //dd($request->all());  
       
        //$total = 0;

       
        /*
        $co = 0;
        foreach ($criteria as $cr) {
            $cri_per[$co] = $cr->criteria_percent; 
            $co++;
        }
        
        //Compute for the judgement score
        for($i = 0; $i < $counter; $i++){
            $nameindex = $contestant->contestant_number.'_'.$i;
            $total += ($request[$nameindex] * $cri_per[$i]);
        }
        
        $nameindex = $contestant->number.'_0';


        
        */

        $contest = Contest::find($contest_id);
        $contestants = Contestant::where('contest_id',$contest_id)->get();
        $criterias = Criteria::where('contest_id',$contest->id)->get();
        $judge = Judge::find($judge_id);
        $judgements = Judgement::all();

        $users = User::all();


        return view('admin.judgement_form',compact('contest','contestants','criterias','judge','users','judgements'));

    }




    public function create(Request $request, $contest_id, $judge_id, $contestant_id){
        //dd($request->all());
        $total = 0;
        $contest = Contest::find($contest_id);
        $score = 0;

        $criterias = Criteria::where('contest_id',$contest->id)->get();
        foreach($criterias as $criteria){
            $inp_value = $request[$criteria->criteria_name];
            
            $score = $inp_value * $criteria->criteria_percent;
            $total += $score;

        }

        Judgement::create([
            'contest_id' => $contest_id,
            'judge_id' => $judge_id,
            'contestant_id' => $contestant_id,
            'contestant_score' => $total,
        ]);


        return redirect()->back()->with('success','Judgement Made Successfully');
    }


    public function delete($contest_id, $judge_id, $contestant_id){
        $judgements = Judgement::all();

        foreach($judgements as $judgement){
            if($judgement->contest_id == $contest_id && $judgement->judge_id == $judge_id && $judgement->contestant_id == $contestant_id){
                $judgement->delete();
            }
        }


        //delete all subcriteria judgement too
        $subjudgements = SubCriteriaJudgment::all();
        foreach($subjudgements as $subj){
            
            $subj->delete();
            
        }

        
        return redirect()->back()->with('success','Judgement Deleted Successfully');
    }



    public function subcriteria_index($criteria_id, $judge_id, $contestant_id,$contest_id){
        $criteria = Criteria::find($criteria_id);

        $judgements = SubCriteriaJudgment::all();

        $subcriterias = SubCriteria::where('criteria_id',$criteria_id)->get();
        $contestant = Contestant::find($contestant_id);
        $judge = Judge::find($judge_id);

        $user_cons = User::find($contestant->user_id);
        $user_judge = User::find($judge->user_id);

        $contest = Contest::find($contest_id);

        return view('admin.subcriteria_form',compact('criteria','subcriterias','contestant','judge','user_cons','user_judge','contest','judgements'));
    }

    public function subcriteria_create(Request $request){
        //dd($request->all());


        $validateData = $request->validate([
            'criteria_id' => 'required',
            'judge_id' => 'required',
            'contestant_id' => 'required',
        ]);

        $total = 0;
       
        $score = 0;

        $subcriterias = SubCriteria::where('criteria_id',$validateData['criteria_id'])->get();
        foreach($subcriterias as $criteria){
            $inp_value = $request[$criteria->sub_criteria_name];
            
            $score = $inp_value * $criteria->sub_criteria_percent;
            $total += $score;

        }

        SubCriteriaJudgment::create([
            'criteria_id' => $validateData['criteria_id'],
            'judge_id' =>  $validateData['judge_id'],
            'contestant_id' =>  $validateData['contestant_id'],
            'contestant_score' => $total,
        ]);


        return redirect()->back()->with('success','SubCriteria Judgement Made Successfully');
    }



    public function subcriteria_delete(Request $request){
        //$criteria_id, $judge_id, $contestant_id

        $validateData = $request->validate([
            'criteria_id' => 'required',
            'judge_id' => 'required',
            'contestant_id' => 'required',
        ]);

        $judgements = SubCriteriaJudgment::all();

        foreach($judgements as $judgement){
            if($judgement->criteria_id == $validateData['criteria_id'] && $judgement->judge_id == $validateData['judge_id'] && $judgement->contestant_id == $validateData['contestant_id']){
                $judgement->delete();
            }
        }
        
        return redirect()->back()->with('success','SubCriteria Judgement Deleted Successfully');
    }

}
