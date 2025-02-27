<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function profile(int $id){

        // user see his profile only, update $id;
        $id = auth()->id();

        $user = User::find($id);
        return view('dashboard.auth.profile',compact('user'));
    }
    public function updatePassword(int $id, Request $request){
         // user see his profile only, update $id;
         $id = auth()->id();
         $request->validate([
            'current_password'=>'required',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
         ]);
         $user = User::find($id);
         if(!Hash::check($request->current_password, $user->password)){
            return to_route('user.profile',$id)->with('error','Your current password is incorrect.');
         }
         $user->password = Hash::make($request->password);
         $user->save();
         return to_route('user.profile',$id)->with('success','Your password is change successfully.');

    }
    public function update(int $id, Request $request){
         // user see his profile only, update $id;
         $id = auth()->id();

         $validated = $request->validate([
            'email'=>'required|email',
            'name'=>'required|string|max:255',
            'image'=>'nullable|image|mimes:png,jpg,webp,jpeg',
         ]);
         
         $user = User::find($id);

         if ($request->hasFile('image')) {

            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $imageName = 'profile/' . strtotime('now') . '.' . $ext;  //12121.jpg

            // move to folder
            Storage::disk('public')->put($imageName, file_get_contents($image));

            $validated['image'] = $imageName;


            // delete old image
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }
        }
        
         $user->update($validated);
         return to_route('user.profile',$id)->with('success','Your profile is updated successfully.');

    }
}
