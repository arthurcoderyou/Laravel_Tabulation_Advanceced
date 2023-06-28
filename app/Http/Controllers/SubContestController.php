<?php

namespace App\Http\Controllers;

use App\Models\SubContest;
use Illuminate\Http\Request;

class SubContestController extends Controller
{
    //
    public function index($id){
        
    }


    public function create(Request $request){
        $validateData = $request->validate([
            'contest_id' => 'required',
            'subcontest_name' => 'required',
        ]);

        
        SubContest::create([
            'contest_id' => $request->contest_id,
            'subcontest_name' => $request->subcontest_name
        ]);

        return redirect()->back()->with('success','SubContest Added Successfully');
    }


    //update sub contest
    public function update(Request $request,$id){
        //dd($request->all());

        $validateData = $request->validate([
            'subcontest_name' => 'required',
        ]);

        if($validateData){
            $subcontest = SubContest::find($id);
            $subcontest->subcontest_name = $request->subcontest_name;
            
        }

        $subcontest->save();
        return redirect()->back()->with('success','SubContest Updated Successfully');
    }   




    public function delete($id){
        $subcontest = SubContest::find($id);
        $subcontest->delete();
        return redirect()->back()->with('success','SubContest Deleted Successfully');
    }



}
