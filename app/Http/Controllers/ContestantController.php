<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContestantController extends Controller
{

    //for the contestant user
        public function dashboard(){
            return view('contestant.dashboard');
        }
    //eond of for the contestant user






    //create Contestant and Register it as a User
    public function create(Request $request){
        //dd($request->all());

        $validateData = $request->validate([
            'contest_id' => 'required',
            'contestant_name' => 'required',
            'contestant_number' => 'required',
            'contestant_message' => 'required',
            'contestant_representing' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $validateData['contestant_name'],
            'email' => $validateData['email'],
            'password' => Hash::make( $validateData['password']),
            'role' => 'contestant'
        ]);

        //if there is a given photo file
        if($request->file('con_photo')){
            //insert the value in to the $file variable
            $file = $request->file('con_photo');
            //creating a variable name that contains the date('Year month day Hour') and concatenates it to the original name of the file
            $filename = date('YmdHi').$file->getClientOriginalName();
            //upload the image on public/upload/admin_images folder and give it the generated file name
            $file->move(public_path('upload/contestants'),$filename);
            //insert the filename into the database value named photo
            $user['photo'] = "contestants/".$filename;
        }


        Contestant::create([
            'user_id' => $user['id'],
            'contest_id' => $validateData['contest_id'],
            'contestant_number' => $validateData['contestant_number'],
            'contestant_message' => $validateData['contestant_message'],
            'contestant_representing' => $validateData['contestant_representing'],
        ]);
        $user->save();
        
        return redirect()->back()->with('success','Contestant Added Successfully');
    }
    

    //Udpate User
    public function update(Request $request,$id){
        //dd($request->all());

        $validateData = $request->validate([
            'user_id' => 'required',
            'contest_id' => 'required',
            'contestant_name' => 'required',
            'contestant_number' => 'required',
            'contestant_message' => 'required',
            'contestant_representing' => 'required',
        ]);



        $contestant = Contestant::find($id);
        $user = User::find($validateData['user_id']);

        if($validateData){
            //udpate the user table
            $user->name = $validateData['contestant_name'];

            
            

            //update the contestant table
            $contestant->contest_id = $validateData['contest_id'];
            $contestant->contestant_number = $validateData['contestant_number'];
            $contestant->contestant_message = $validateData['contestant_message'];
            $contestant->contestant_representing = $validateData['contestant_representing'];

        }

        //if there is a given photo file
        if($request->file('photo')){
            //insert the value in to the $file variable
            $file = $request->file('photo');
            //creating a variable name that contains the date('Year month day Hour') and concatenates it to the original name of the file
            $filename = date('YmdHi').$file->getClientOriginalName();
            //upload the image on public/upload/admin_images folder and give it the generated file name
            $file->move(public_path('upload/contestants'),$filename);
            //insert the filename into the database value named photo
            $user['photo'] = "contestants/".$filename;
        }

        $user->save();
        $contestant->save();
        return redirect()->back()->with('success','Contestant Updated Successfully');
    }



    //Delete Contestant
    public function delete($contestant){
        $con = Contestant::find($contestant);
        $user = User::find($con->user_id);
        $con->delete(); //delete from the contestants table
        $user->delete(); //delete from the users table
       

        return redirect()->back()->with('success','Contestant Deleted Successfully');

    }

}
