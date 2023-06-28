<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Contest;
use App\Models\Criteria;
use App\Models\Judgement;
use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class JudgeController extends Controller
{
    //
    //for the judge account
        public function dashboard(){
            return view('judge.dashboard');
        }

        public function judgements($user_id){

            $judges = Judge::all();
            foreach ($judges as $j) {
                if($j->user_id == $user_id){
                    $judge = $j;
                }
            }

            $contests = Contest::latest()->where('id',$judge->contest_id)->paginate(5);
            $users = User::all();
            return view('judge.judgements',compact('judge','users','contests'));
        }

        //
        public function index(Request $request,$contest_id, $judge_id){
            //dd($request->all());  
        

            $contest = Contest::find($contest_id);
            $contestants = Contestant::where('contest_id',$contest_id)->get();
            $criterias = Criteria::where('contest_id',$contest->id)->get();
            $judge = Judge::find($judge_id);
            $judgements = Judgement::all();

            $users = User::all();


            return view('judge.judgement_form',compact('contest','contestants','criterias','judge','users','judgements'));

        }
    //end of for the judge account


    //Create Judge
    public function create(Request $request){
        $validateData = $request->validate([
            'contest_id' => 'required',
            'judge_name' => 'required',
            'judge_description' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            
        ]);

        $user = User::create([
            'name' => $validateData['judge_name'],
            'email' => $validateData['email'],
            'password' => Hash::make($validateData['password']),
            'role' => 'judge'
        ]);
        
        if(filled($request->file('judge_photo'))){
            //insert the value in to the $file variable
            $file = $request->file('judge_photo');
            //creating a variable name that contains the date('Year month day Hour') and concatenates it to the original name of the file
            $filename = date('YmdHi').$file->getClientOriginalName();
            //upload the image on public/upload/admin_images folder and give it the generated file name
            $file->move(public_path('upload/judges'),$filename);
            //insert the filename into the database value named photo
            $user['photo'] = "judges/".$filename;
        }
        
        $user->save();

        
        

        Judge::create([
            'user_id' => $user->id,
            'contest_id' => $validateData['contest_id'],
            'judge_description' => $validateData['judge_description'],
        ]);

        

        return redirect()->back()->with('success','Judge Added Successfully');

    }


    //Update Judge
    public function update(Request $request,$id){
        $judge = Judge::find($id);


        $validateData = $request->validate([
            'user_id' => 'required',
            'judge_name' => 'required',
            'contest_id' => 'required',
            'judge_description' => 'required',
            
        ]);

        $user = User::find($validateData['user_id']);

        if($validateData){
            $user->name = $validateData['judge_name'];
            $judge->user_id = $validateData['user_id'];
            $judge->contest_id = $validateData['contest_id'];
            $judge->judge_description = $validateData['judge_description'];
        }


        if(filled($request->file('photo'))){
            //insert the value in to the $file variable
            $file = $request->file('photo');
            //creating a variable name that contains the date('Year month day Hour') and concatenates it to the original name of the file
            $filename = date('YmdHi').$file->getClientOriginalName();
            //upload the image on public/upload/admin_images folder and give it the generated file name
            $file->move(public_path('upload/judges'),$filename);
            //insert the filename into the database value named photo
            $user['photo'] = "judges/".$filename;
        }



        $user->save();
        $judge->save();
        return redirect()->back()->with('success','Judge Updated Successfully');

    }


    //Delete Judge
    public function delete($id){
        $judge = Judge::find($id);

        $user = User::find($judge->user_id);
        $judge->delete();   //delete from the judge table
        $user->delete();    //delete from the users table   
        
        return redirect()->back()->with('success','Judge Deleted Successfully');
    }
}
