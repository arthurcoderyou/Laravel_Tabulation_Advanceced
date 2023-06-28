<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contest;
use App\Models\Judgement;
use App\Models\Contestant;
use App\Models\SubContest;
use App\Models\ContestAward;
use Illuminate\Http\Request;
use App\Models\SubContestAward;

class UserController extends Controller
{
    //dashboard
    public function dashboard(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        return view('user.user',compact('contests'));
    }
    
    public function contestants(){

        $contestants = User::where('role', 'contestant')->get();

        return view('user.contestants',compact('contestants'));
    }

    public function awards($contest_id){
        $contest = Contest::find($contest_id);
        $contestants = Contestant::where('contest_id',$contest_id)->get();
        $judgements = Judgement::where('contest_id',$contest_id)->get();
        $users = User::all();
        $subcontests = SubContest::where('contest_id',$contest_id)->get();
        $contest_awards = ContestAward::where('contest_id',$contest_id)->get();
        $sub_contest_awards = SubContestAward::where('sub_contest_id',$contest_id)->get();

        return view('user.contest_awards_single',compact('contest','contestants','judgements','users','subcontests','contest_awards','sub_contest_awards'));
    }




}
