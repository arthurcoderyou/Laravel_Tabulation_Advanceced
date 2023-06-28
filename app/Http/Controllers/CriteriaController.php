<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{

    //Create Criteria
    public function create(Request $request){
        //dd($request->all());

        $validateData = $request->validate([
            'contest_id' => 'required',
            'criteria_name' => 'required',
            'criteria_description' => 'required',
            'criteria_percent' => 'required',
        ]);

        if($validateData){

            Criteria::create([
                'contest_id' => $validateData['contest_id'],
                'criteria_name' => $validateData['criteria_name'],
                'criteria_description' => $validateData['criteria_description'],
                'criteria_percent' => $validateData['criteria_percent']
            ]); 

            
        }


        return redirect()->back()->with('success','Criteria Created Successfully');
    }


    //Update Criteria
    public function update(Request $request, $id){
        //dd($request->all());



        $criteria = Criteria::find($id);

        $validateData = $request->validate([
            'contest_id' => 'required',
            'criteria_name' => 'required',
            'criteria_description' => 'required',
            'criteria_percent' => 'required',
        ]);

        if($validateData){
            $criteria->contest_id = $validateData['contest_id'];
            $criteria->criteria_name = $validateData['criteria_name'];
            $criteria->criteria_description = $validateData['criteria_description'];
            $criteria->criteria_percent = $validateData['criteria_percent'];
        }

        $criteria->save();

        return redirect()->back()->with('success','Criteria Updated Successfully');

    }


    //delete
    public function delete($id){
        $criteria = Criteria::find($id);
        $criteria->delete();

        return redirect()->back()->with('success','Criteria Deleted Successfully');
    }
    

}
