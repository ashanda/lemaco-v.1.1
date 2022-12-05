<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User_Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
class UserbuypackageController extends Controller
{
    public function index(User_Package $data)
    {
        $role=Auth::user()->role;
        if($role==1){
            $data =DB::table('users')
            ->join('user__packages', 'users.uid', '=', 'user__packages.uid')
            ->join('packages', 'user__packages.package_id', '=', 'packages.id')
            ->where('user__packages.status', '=', '2')
            ->select('user__packages.uid','user__packages.created_at','user__packages.package_double_value','user__packages.package_max_revenue','user__packages.id','users.fname','users.system_id', 'users.lname', 'packages.package_name', 'user__packages.status')
            ->get();     
            return view('admin.user_package.index',compact('data'));
        }
        if($role==0){
                   
            return view('dashboard');
        }
    
    }

    public function edit(Request $userbuypackage, $id){
        $role=Auth::user()->role;
        if($role==1){
            $current_user_package = DB::table('users')
            ->join('user__packages', 'users.uid', '=', 'user__packages.uid')
            ->join('packages', 'user__packages.package_id', '=', 'packages.id')
            ->where('user__packages.id',$id) 
            ->select('user__packages.id','packages.id as packageid','user__packages.uid','user__packages.package_id','user__packages.package_double_value','user__packages.package_value','packages.package_name','user__packages.currency_type','user__packages.network','user__packages.deposite_ss','user__packages.status')
            
            ->get();
            $kyc = User_Package::find($id);
            return view('admin.user_package.edit',compact('userbuypackage','id','current_user_package'));
        }
        if($role==0){
            $user_id = Auth::id();
            $kyc = DB::table('kycs')->where('uid', $user_id)->get();  
            return view('user.kyc.edit',compact('userbuypackage','id'));
        }
    }

    public function update(Request $request, $id)
        {
        $request->validate([
            
            'package_cat_id' => 'required',
            'package_status' => 'required',
            'package_row_id' => 'required',
            'package_id' => 'required',
            'package_value' => 'required',
            'uid' => 'required',
        ]);
        $package = User_Package::find($id);
        $package->status = $request->package_status;
        $package_value = (int)$request->package_value;
        $status = (int)$request->package_status;
        $package_id = (int)$request->package_id;
        $current_user= (int)$request->uid;
        $package_row_id= (int)$request->package_row_id;
        $user_package_row_id = $package_row_id;
        $package_cat_id = (int)$request->package_row_id;

        if( $status == 1){    
            $package->current_status = 1;
            $user_current_package = DB::table('packages')->where('id','=',$package_row_id)->get(); 
            // Commission function call
            $previous_package_check = previous_package_check($current_user);
            
            $current_date_time = Carbon::now()->toDateTimeString();
            $package->created_at = $current_date_time;
           
            if ($previous_package_check == 0){ 
               
                
                buy_package($user_package_row_id,$package_value,$package_id,$user_current_package[0]->id,$current_user,$package_cat_id); 
                $package_value = $package->package_value;
                store_fee( $package->uid,$package_value+10);
                 
            }else{ 
                $experid_packages = DB::table('user__packages')
                            ->whereColumn('package_max_revenue','=','total')
                            ->where('uid','=',$current_user)
                            ->where('current_status','=',1)
                            ->get();
                            foreach ($experid_packages as $experid_package){
                                DB::table('user__packages')
                                ->where('id', $experid_package->id)
                                ->update(['current_status' =>2]);
                            }

                $withdrawl_hold_to_real =  DB::table('holdin_wallets')
                ->where('uid','=',$current_user)
                ->first(); 

                $withdrawl_wallet =  DB::table('wallets')
                ->where('uid','=',$current_user)
                ->first();
                
                
                
                if($withdrawl_hold_to_real != null){
                    
                     if($withdrawl_hold_to_real->wallet_balance <= ($package_value*4)){
                        DB::table('holdin_wallets')->where('uid', $current_user)->update(array('wallet_balance' => 0,'available_balance' =>0));
                        
                        DB::table('wallets')->where('uid', $current_user)->update(array('wallet_balance' => $withdrawl_wallet->wallet_balance + $withdrawl_hold_to_real->wallet_balance,'available_balance' =>$withdrawl_wallet->available_balance + $withdrawl_hold_to_real->wallet_balance));
                        
                        DB::table('user__packages')->where('id', $id)->update(array('total' => $withdrawl_hold_to_real->wallet_balance));
                        
                    }else{
                        $new_withdrawl_hold_to_real = $withdrawl_hold_to_real->wallet_balance - ($package_value * 4);
                        DB::table('holdin_wallets')->where('uid', $current_user)->update(array('wallet_balance' => $new_withdrawl_hold_to_real,'available_balance' =>$new_withdrawl_hold_to_real));
                        $queryState = DB::table('wallets')->where('uid', $current_user)->update(array('wallet_balance' => $package_value * 4,'available_balance' =>$package_value * 4));
                        if($queryState) {
                            // the query succeed
                        } else {
                            DB::table('wallets')->insert(['uid'=>$current_user,'wallet_balance' => $package_value * 4,'available_balance' =>$package_value * 4]);
                        }
                        
                        DB::table('user__packages')->where('id', $user_package_row_id)->update(array('total' => $package_value * 4));
                    }
                    
                }         
                buy_package_secound_time($user_package_row_id,$package_value,$package_id,$user_current_package[0]->id,$current_user,$package_cat_id);   
                $package_value = $package->package_value;
                store_fee( $package->uid,$package_value+10);
            }

            $package->save();
   
     }
        Alert::Alert('Success', 'Package Has Been updated successfully')->persistent(true,false);
        return redirect()->route('user_buy_package.index');
        }



        
        public function destroy(User_Package $userbuypackage, $id)
        {

        $data = DB::table('user__packages')->where('id', $id)->delete();
        Alert::Alert('Success', 'User Package has been deleted successfully')->persistent(true,false);
        return redirect()->route('user_buy_package.index');
        }
}
