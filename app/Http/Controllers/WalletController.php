<?php

namespace App\Http\Controllers;

use App\Models\Transection;
use App\Models\wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class WalletController extends Controller
{
    public function index()
    {
        $role=Auth::user()->role;
        if($role==1){
            
            $data = DB::table('transections')
            ->join('users', 'transections.uid', '=', 'users.uid')
            ->where('transections.status', '=', '0')
            ->select('users.*', 'transections.*', 'transections.status as trstatus')
            ->get();        
            return view('admin.wallet.index',compact('data'));
        }
        if($role==0){
                  
            return view('user.wallet.index');
        }
    
    }


    public function wallet_approved()
    {
        $role=Auth::user()->role;
        if($role==1){
            
            $data = DB::table('transections')
            ->join('users', 'transections.uid', '=', 'users.uid')
            ->where('transections.status', '=', '1')
            ->select('users.*', 'transections.*', 'transections.status as trstatus')
            ->get();        
            return view('admin.wallet.approved',compact('data'));
        }
        if($role==0){
                  
            return view('user.wallet.index');
        }
    
    }
    public function wallet_rejects()
    {
        $role=Auth::user()->role;
        if($role==1){
            
            $data = DB::table('transections')
            ->join('users', 'transections.uid', '=', 'users.uid')
            ->where('transections.status', '=', '2')
            ->select('users.*', 'transections.*', 'transections.status as trstatus')
            ->get();        
            return view('admin.wallet.rejects',compact('data'));
        }
        if($role==0){
                  
            return view('user.wallet.index');
        }
    
    }

    public function edit(Request $withdraw, $id)
    {
        $role=Auth::user()->role;
        if($role==1){
            $withdraw = Transection::find($id);
            return view('admin.wallet.edit',compact('withdraw','id'));
        }
        
    
    }

    public function update(Request $request, $id)
        {
        $request->validate([
            
            'uid' => 'required',
            'amount' => 'required',
            'package_status' => 'required',
        ]);
        $withdraw = Transection::find($id);
        $withdraw->status = $request->package_status;
        $withdraw->amount = $request->amount;
        $fee = get_trxfee($request->amount);
                if($fee == -1){
                   // return;
                }

       $change_wallet_balance = DB::table('wallets')
       ->where('uid',"=",$request->uid )
       ->first();

       $id_update_row = $change_wallet_balance->id;
       $old_balance = $change_wallet_balance->wallet_balance;
       $old__available_balance =$change_wallet_balance->available_balance;
       $wallet_balance = wallet::find($id_update_row);

       if($request->package_status == 2){
        
        $wallet_balance->available_balance = $wallet_balance->available_balance + $request->amount;
        
    
    }else if($request->package_status == 1){
        store_fee($request->uid,$fee);
        if($wallet_balance->binary_balance >= $request->amount){
            $new_balance_binary = $wallet_balance->binary_balance - $request->amount;

            
            if($new_balance_binary == 0){
                $wallet_balance->binary_balance = $new_balance_binary;

            /*}else if($new_balance_binary < 0){
                $new_balance_binary = $request->amount - $wallet_balance->binary_balance;
                if($new_balance_binary <= $wallet_balance->direct_balance){
                    $new_balance_direct = $wallet_balance->direct_balance - $new_balance_binary;
                    $wallet_balance->direct_balance  = $new_balance_direct;
                }else{
                    $new_total_balance = $new_balance_binary - $wallet_balance->direct_balance;
                    $new_package_balance = $wallet_balance->package_balance - $new_total_balance ;
                    $wallet_balance->package_balance  = $new_package_balance;

                }*/
                
                
            }else{
                $wallet_balance->binary_balance  = $new_balance_binary;
            } 
        }else{

            $new_balance_binary = $request->amount - $wallet_balance->binary_balance;
           
            // check if the direct balance is less than the binary balance
            if($new_balance_binary <= $wallet_balance->direct_balance){
                
                $wallet_balance->binary_balance = 0;
                $new_direct_balance = $wallet_balance->direct_balance - $new_balance_binary;
                $wallet_balance->direct_balance  = $new_direct_balance;
                
                
                
            } else{
                $new_total_balance = $new_balance_binary - $wallet_balance->direct_balance;
                $wallet_balance->binary_balance = 0;
                $wallet_balance->direct_balance  = 0;
                $new_package_balance = $wallet_balance->package_balance - $new_total_balance ;
                $wallet_balance->package_balance  = $new_package_balance;
            }

        } 
        if( $old__available_balance == 0){
            $wallet_balance->available_balance = 0; 
        }else{
            $wallet_balance->available_balance = $old__available_balance ;
        }

        $wallet_balance->available_balance = $old__available_balance - ($request->amount);
        $wallet_balance->wallet_balance = $old_balance - ($request->amount);
       }
       $wallet_balance->save();
       $withdraw->save();
       Alert::Alert('Success', 'Wallet has been updated successfully.')->persistent(true,false);
        return redirect()->route('wallet.index');
        }
        
        public function destroy(wallet $package)
        {
        $package->delete();
        Alert::Alert('Success', 'Wallet has been deleted successfully.')->persistent(true,false);
        return redirect()->route('package.index');
        }

    


}
