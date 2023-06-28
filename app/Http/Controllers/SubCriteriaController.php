<?php

namespace App\Http\Controllers;

use App\Models\SubCriteria;
use Illuminate\Http\Request;

class SubCriteriaController extends Controller
{
   
     //Create Criteria
    public function create(Request $request){
        //dd($request->all());

        $validateData = $request->validate([
            'criteria_id' => 'required',
            'subcriteria_name' => 'required',
            'subcriteria_percent' => 'required',
        ]);

        if($validateData){

            SubCriteria::create([
                'criteria_id' => $validateData['criteria_id'],
                'sub_criteria_name' => $validateData['subcriteria_name'],
                'sub_criteria_percent' => $validateData['subcriteria_percent']
            ]); 

            
        }


        return redirect()->back()->with('success','SubCriteria Created Successfully');
    }


    //Update Criteria
    public function update(Request $request){
        //dd($request->all());


        $validateData = $request->validate([
            'subcriteria_id' => 'required',
            'subcriteria_name' => 'required',
            'subcriteria_percent' => 'required',
        ]);

        if($validateData){
            $subcriteria = SubCriteria::find($validateData['subcriteria_id']);
            $subcriteria->sub_criteria_name = $validateData['subcriteria_name'];
            $subcriteria->sub_criteria_percent = $validateData['subcriteria_percent'];
        }

        $subcriteria->save();

        return redirect()->back()->with('success','SubCriteria Updated Successfully');

    }


    //delete
    public function delete(Request $request){
        //dd($request->all());
        $subcriteria = SubCriteria::find($request->subcriteria_id);
        $subcriteria->delete();

        return redirect()->back()->with('success','Criteria Deleted Successfully');
    }
    
}
