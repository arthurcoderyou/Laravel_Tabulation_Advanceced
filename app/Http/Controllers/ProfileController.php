<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        

        if($request->user()->role == 'admin'){
            $folderName = 'admin';
        }elseif($request->user()->role == 'judge'){
            $folderName = 'judge';
        }elseif($request->user()->role == 'contestant'){
            $folderName = 'contestant';
        }elseif($request->user()->role == 'user'){
            $folderName = 'user';
        }

        if(filled($request->file('photo'))){
            //insert the value in to the $file variable
            $file = $request->file('photo');
            //creating a variable name that contains the date('Year month day Hour') and concatenates it to the original name of the file
            $filename = date('YmdHi').$file->getClientOriginalName();
            //upload the image on public/upload/admin_images folder and give it the generated file name
            $file->move(public_path('upload/'.$folderName),$filename);
            //insert the filename into the database value named photo
            $request->user()->photo = $folderName."/".$filename;
        }


        $request->user()->save();


        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
