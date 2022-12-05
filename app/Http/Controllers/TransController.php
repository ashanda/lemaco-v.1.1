<?php

namespace App\Http\Controllers;


use App\Models\Withdraw;
use App\Models\Transection;
use App\Models\UserCryptoWallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Package_Commissons;
use App\Models\wallet;
use App\Models\User_Package;
use RealRashid\SweetAlert\Facades\Alert;
class TransController extends Controller
{
    public function p2p()
    {
        $role=Auth::user()->role;
        if($role==0){
            $check_eligible_kyc = DB::table('kycs')->where('uid','=',Auth::user()->uid,'AND','status','=','0')->count();
            $check_eligible_package = DB::table('user__packages')->where('uid','=',Auth::user()->uid)->count();
            if($check_eligible_kyc > 0 && $check_eligible_package > 0){
                return view('user.withdraw.p2p');
            }else{
                return view('user.withdraw.index');
            }

           
        }
        
    }

    public function package_earn (){
        $role=Auth::user()->role;
        if($role==1){
            return view('admin.package_earn.index');
            }

           
        }

        public function package_earn_trans(){
            $role=Auth::user()->role;
            if($role==1){
                
                return view('admin.package_earn.package_earn');  
            }
            
    
        }

        


    public function crypto()
    {
        $role=Auth::user()->role;
        if($role==0){
            $check_eligible_kyc = DB::table('kycs')->where('uid','=',Auth::user()->uid,'AND','status','=','0')->count();
            $check_eligible_package = DB::table('user__packages')->where('uid','=',Auth::user()->uid)->count();
            if($check_eligible_kyc > 0 && $check_eligible_package > 0){
                return view('user.withdraw.bank');
            }else{
                return view('user.withdraw.index');
            }      
            
        }
    }

    public function store_p2p(Request $request)
    {
               /* $code=rand(1000,9999);
                $matchThese = array('uid'=>Auth::user()->uid);
                DB::table('otp')::updateOrCreate($matchThese,['verification_code'=>$code]);
                
              */
                $id = $request->wallet_address;
                $wallet_address = UserCryptoWallet::find($id);

                $withdraw = new Transection;
                $withdraw->uid= Auth::user()->uid;
                
                
                
                $fee = get_trxfee($request->amount);
                
                if($fee == -1){
                   // return;
                }
                $withdraw->fee= $fee;
                $withdraw->amount = $request->amount;
                $withdraw->p2p_id = $request->p2p_id;
                $withdraw->wallet_address = $wallet_address->wallet_address;      
                $withdraw->currency_type = $wallet_address->currency_type;  
                $withdraw->network = $wallet_address->network;        
                

                $wallete = DB::table("wallets")
                ->where("uid", "=", Auth::user()->uid)
                ->count();

                if($wallete > 0){

                    $wallet_balance_update =  DB::table("wallets")
            ->select("id", "uid" ,"wallet_out","wallet_balance","available_balance")
            ->where("uid", "=", Auth::user()->uid )
            ->first();
            $wallet_id= $wallet_balance_update->id;
            
                $new_available_balance = $wallet_balance_update->available_balance - ($request->amount+$fee);
                $new_wallet_balance = $wallet_balance_update->wallet_balance ;
            
            
            
              DB::table('wallets')
              ->where('id', $wallet_id)
              ->update(['wallet_out' => $new_wallet_balance+$fee,'available_balance' => $new_available_balance]);

                }else{
                    DB::table('wallets')->insert([
                        'uid' => Auth::user()->uid,
                        'wallet_out' => $request->amount+$fee,
                    ]);
                }

                $withdraw->save();
                Alert::Alert('Success', 'Withdraw has been created successfully.')->persistent(true,false);
                return redirect()->route('wallet.index');
        
    
    }

    
    public function store(Request $request)
    {
       

                $id = $request->wallet_address;
                $wallet_address = UserCryptoWallet::find($id);

                $withdraw = new Transection;
                $withdraw->uid= Auth::user()->uid;
                
                
                
                $fee = get_trxfee($request->amount);
                
                if($fee == -1){
                   // return;
                }
                $withdraw->fee= $fee;
                $withdraw->amount = $request->amount;
                $withdraw->p2p_id = $request->p2p_id;
                if($wallet_address == NULL){
                    
                }else{
                    $withdraw->wallet_address = $wallet_address->wallet_address;      
                    $withdraw->currency_type = $wallet_address->currency_type;  
                    $withdraw->network = $wallet_address->network; 
                }
                
                      
                

                $wallete = DB::table("wallets")
                ->where("uid", "=", Auth::user()->uid)
                ->count();

                if($wallete > 0){

                    $wallet_balance_update =  DB::table("wallets")
            ->select("id", "uid" ,"wallet_out","wallet_balance","available_balance")
            ->where("uid", "=", Auth::user()->uid )
            ->first();
            $wallet_id= $wallet_balance_update->id;
            
                $new_available_balance = $wallet_balance_update->available_balance - ($request->amount);
                $new_wallet_balance = $wallet_balance_update->wallet_balance ;
            
            
            
              DB::table('wallets')
              ->where('id', $wallet_id)
              ->update(['wallet_out' => $request->amount,'available_balance' => $new_available_balance]);

                }else{
                    DB::table('wallets')->insert([
                        'uid' => Auth::user()->uid,
                        'wallet_out' => $request->amount,
                    ]);
                }

                $withdraw->save();
                Alert::Alert('Success', 'Withdraw has been created successfully.')->persistent(true,false);
                return redirect()->route('wallet.index');
        
    
    }


   
}
