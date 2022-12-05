<?php

namespace App\Http\Controllers;
use App\Models\User;
Use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)

    {
        

        if (Auth::check()) {
            $user_id = Auth::id();
            $ip_address = request()->getClientIp();
            $user_agent =request()->userAgent();
            return view('profile.show',compact('ip_address', 'user_agent' ,'user_id'));
        }else{
            return view('auth.login');
        }
    }
    public function user(Request $request)

    {
        

        if (Auth::check()) {
            $user_id = Auth::id();
            $ip_address = request()->getClientIp();
            $user_agent =request()->userAgent();
            return view('profile.show',compact('ip_address', 'user_agent' ,'user_id'));
        }else{
            return view('auth.login');
        }
    }

    public function edit(Request $request, $id){
       
        $role = Auth::user()->role;
        if($role==1){
           
         $user_data = DB::table('users')->where('uid', $id)->first();  
       
            return view('admin.user.edit',compact('user_data','id'));
        }
    }

    
    public function update(Request $request, $id)
    {
        
        if(Auth::check()){
            $role = Auth::user()->role;
            if($role==1){
                $request->validate([
                
                    
                    'verify_email' => 'required',
                    'password' => 'required',
                    
                    ]);
                    $user = user::find($id);
                    $user->status = $request->status;
                    $user->email_verified_at = $request->verify_email;
                    $user->password = Hash::make($request->password);
                    
                    $user->save();
                    Alert::Alert('Success', 'User has been Updated successfully.')->persistent(true,false);
                   return redirect('/report_users');
            }else{
                $request->validate([
                
                    'fname' => 'required',
                    'lname' => 'required',
                    'email' => 'required',
                    'password' => 'required',
                    
                    ]);
                    $user = user::find($id);
                    if($request->file('profile_pic')){
                        $file= $request->file('profile_pic');
                        $filename= date('YmdHi').$file->getClientOriginalName();
                        $file-> move(public_path('/profile/img'), $filename);
                        $user->profile_pic = $filename;
                    }
                
                    $user->fname= $request->fname;
                    $user->lname = $request->lname;
                    
                    $user->save();
                    Alert::Alert('Success', 'Profile has been updated successfully.')->persistent(true,false);
                    return redirect()->route('user.index');

            }
            
        }else{
            return redirect()->route('login');
        }
        
    
    }
}
