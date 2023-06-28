<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judgement;
use App\Models\Contestant;
use App\Models\SubContest;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard(){
        return view('admin.dashboard');
    }

    /*For the DataTable Practice
    public function showData(){
        $contests = Contest::all();
        return response()->json(['data' => $contests]);
    }*/

    public function contest(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        return view('admin.contest',compact('contests'));
    }

    public function subcontest(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        $subcontests = SubContest::all();
        return view('admin.subcontest',compact('contests','subcontests'));
    }
    
    public function contestants(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        $contestants = Contestant::all();
        $users = User::all();
        return view('admin.contestants',compact('contests','contestants','users'));
        
    }

    public function judges(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        $judges = Judge::all();
        $users = User::all();
        return view('admin.judges',compact('contests','judges','users'));
    }

    
    public function criterias(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        $criterias = Criteria::all();
        return view('admin.criterias',compact('contests','criterias'));
    }

    public function subcriterias($criteria_id){
        $subcriterias = SubCriteria::latest()->where('criteria_id',$criteria_id)->paginate(5);
        $criteria = Criteria::find($criteria_id);
        return view('admin.subcriterias',compact('subcriterias','criteria'));
    }


    public function judgement(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        $judges = Judge::all();
        $users = User::all();
        $criterias = Criteria::all();
        $contestants = Contestant::all();
        $judgements = Judgement::all();
        return view('admin.judgements',compact('contests','judges','users','criterias','contestants','judgements'));
    }


    public function awards(){
        $contests = Contest::latest()->where('id','>','0')->paginate(5);
        $judges = Judge::all();
        $users = User::all();
        $contestants = Contestant::all();
        $criterias = Criteria::all();
        $judgements = Judgement::all();
        return view('admin.contest_awards',compact('contests','judges','users','judges','contestants','criterias','judgements'));
    }

}
