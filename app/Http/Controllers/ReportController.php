<?php

namespace App\Http\Controllers;
use App\Models\Kyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function report_kyc(kyc $data)
    {
        $role=Auth::user()->role;
        if($role==1){
            $user_id = Auth::id();
            $data =DB::table("users")
            ->leftJoin("kycs", function($join){
                $join->on("users.uid", "=", "kycs.uid");
            })
            ->select("users.fname", "users.lname", "users.email", "users.created_at")
            ->whereNull("kycs.uid")
            ->get();
                    
            return view('admin.report.all',compact('data'));
        }
        
    
    }

    public function report_user()
    {
        $role=Auth::user()->role;
        if($role==1){
            $user_id = Auth::id();
            $data =DB::table("users")
            ->leftJoin("kycs", function($join){
                $join->on("users.uid", "=", "kycs.uid");
                
            })
            
            ->join('user__parents', 'users.uid', '=', 'user__parents.uid')
            ->select("users.uid","users.system_id","users.fname", "users.dbType","users.id_number","users.lname", "users.email","users.password","users.created_at AS register", "users.email_verified_at", "users.status","user__parents.*","kycs.phone_number")
            
            ->get();
            
                    
            return view('admin.report.users',compact('data'));
        }
        
    
    }

    public function report_earn(){
        $role=Auth::user()->role;
        if($role==1){
            $data = DB::table('users')
            ->join('user__packages', 'users.uid', '=', 'user__packages.uid')
            ->join('packages', 'user__packages.package_id', '=', 'packages.id')
            ->join('package__categories', 'package__categories.id', '=', 'user__packages.package_cat_id')
            ->get();
            return view('admin.report.user_earn',compact('data'));
        }
    }

    public function report_package_earn(){
        $data = DB::table('package_earn_log')
        ->where('uid',Auth::user()->uid)
        ->get();
            return view('user.reports.package_earn',compact('data'));
      
    }

    public function report_direct_earn(){
            $data = DB::table('direct_earn_log')
            ->where('uid',Auth::user()->uid)
            ->get();
            return view('user.reports.direct_earn',compact('data'));
        
    }

    public function report_binary_earn(){
        $data = DB::table('binary_earn_log')
        ->where('uid',Auth::user()->uid)
        ->get();
        return view('user.reports.binary_earn',compact('data'));
        
    }


    public function report_earn_user(){
        $data = DB::table('users')
        ->join('user__packages', 'users.uid', '=', 'user__packages.uid')
        ->where('user__packages.status',1)
        ->get();
        return view('admin.report.report_earn_user',compact('data'));
        
    }
}
