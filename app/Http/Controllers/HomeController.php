<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WisdomDiala\Cryptocap\Facades\Cryptocap;
Use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    
    public function index(User $user_data)
    {
        $role=Auth::user()->role;
        if($role==1){
            $record = User::select(DB::raw("COUNT(*) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();
        
            

            $data = [];
        
            foreach($record as $row) {
                $data['label'][] = $row->day_name;
                $data['data'][] = (int) $row->count;
            }
            $data['chart_data'] = json_encode($data);
            return view('admin', compact('data'));
        }
        if($role==0){
            $user_id = Auth::id();
            $user_data = DB::table('users')->where('uid', $user_id)->get();
            return view('dashboard',compact('user_data'));
        }    
    }


    public function package_earn(){
        $role=Auth::user()->role;
        if($role==1){

            return view('admin.package_earn.package_earn')
            ->with('success','successfully Tranfer');
        }
        

    }

    

    public function disclaimer_notice(){
        $role=Auth::user()->role;
        if($role==0){
            
            return view('user.disclaimer.index');
        }
        

    }

    

    
}
