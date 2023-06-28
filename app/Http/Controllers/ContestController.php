<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Judgement;
use App\Models\Contestant;
use App\Models\SubContest;
use App\Models\ContestAward;
use Illuminate\Http\Request;
use App\Models\SubContestAward;

class ContestController extends Controller
{

    public function index($id){
        $contest = Contest::find($id);
        $judges = Judge::where('contest_id',$id)->get();
        $contestants = Contestant::where('contest_id',$id)->get();
        $users = User::all();


        return view('admin.contest_single',compact('contest','judges','contestants','users'));
    }

    //Create Contest
    public function create(Request $request){
        //dd($request->all());

        $validateData = $request->validate([
            'contest_name' => 'required',
            'announcement_date' => 'required|date',
            'show_con_res' => 'required|boolean'
        ]);

        Contest::create([
            'contest_name' => $validateData['contest_name'],
            'announcement_date' => $validateData['announcement_date'],
            'show_contest_result' => $validateData['show_con_res'],
        ]);
        
        return redirect()->back()->with('success','Contest Added Successfully');

    }//end of Create

    //Update Contest
    public function update(Request $request,$id){
        $validateData = $request->validate([
            'contest_name' => 'required',
            'announcement_date' => 'required|date',
            'show_con_res' => 'required|boolean'
        ]);

        if($validateData){
            $contest = Contest::find($id);
            $contest->contest_name = $request->contest_name;
            $contest->announcement_date = $request->announcement_date;
            $contest->show_contest_result = $request->show_con_res;
            
        }

        $contest->save();
        return redirect()->back()->with('success','Contest Updated Successfully');

    }//end of Update


    //Delete Contest
    public function delete($id){
        $contest = Contest::findOrFail($id);
        $contest->delete();
        return redirect()->route('admin.contest')->with('success','Contest Deleted Successfully');
    }//end of Delete

    
    public function search(Request $request){
       // dd($request->all());
        $search_value = $request->search;

        if(filled($search_value) ){


            $contests = Contest::where('contest_name', 'like', '%'.$search_value.'%')->paginate(5);
        }else{
            $contests = Contest::where('id','>',0)->paginate(8);
        }

        return view('admin.contest',compact('contests','search_value'));

    }



    //Contest Awards

    public function awards($contest_id){
        $contest = Contest::find($contest_id);
        $judges = Judge::where('contest_id',$contest_id)->get();
        $contestants = Contestant::where('contest_id',$contest_id)->get();
        $judgements = Judgement::where('contest_id',$contest_id)->get();
        $users = User::all();
        $subcontests = SubContest::where('contest_id',$contest_id)->get();
        $contest_awards = ContestAward::where('contest_id',$contest_id)->get();
        $sub_contest_awards = SubContestAward::where('sub_contest_id',$contest_id)->get();

        return view('admin.contest_awards_single',compact('contest','judges','contestants','judgements','users','subcontests','contest_awards','sub_contest_awards'));
    }



    //Contest Award Store
    public function contest_award_store(Request $request){
        //dd($request->all());
        $validateData = $request->validate([
            'contestant_id' => 'required',
            'contest_id' => 'required',
            'award_name' => 'required',
        ]);

        ContestAward::create([
            'award_name' => $validateData['award_name'],
            'contestant_id' => $validateData['contestant_id'],
            'contest_id' => $validateData['contest_id'],
        ]);
        return redirect()->back()->with('success','Contestant Awarded Successfully');
    }

    //SubContest Awards Store
    public function sub_contest_award_store(Request $request){
        //dd($request->all());
        $validateData = $request->validate([
            'contestant_id' => 'required',
            'sub_contest_id' => 'required',
            'sub_contest_name' => 'required',
        ]);

        SubContestAward::create([
            'award_name' => $validateData['sub_contest_name'],
            'contestant_id' => $validateData['contestant_id'],
            'sub_contest_id' => $validateData['sub_contest_id'],
        ]);
        return redirect()->back()->with('success','SubContestant Awarded Successfully');

    }




}
