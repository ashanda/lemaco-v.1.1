<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\wallet;
use App\Models\User_Package;
use App\Models\Package_Commissons;

class PackageEarn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'PackageEarn:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is a cron job for package earn';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
 
                foreach (package_earn_satisfy() as $current_earn){
                   $package_value = $current_earn->package_double_value/2;
                   $package_valid_date = $current_earn->package_duration;
                   $package_earn = ($package_value*3)/$package_valid_date;
                   $user_id = $current_earn->uid;
                   $current_user_package_id = $current_earn->upid;
                   $new_total = $package_earn + $current_earn->total;
                   
                   if($new_total > $package_value*3 ){
                     $remaning_value = $new_total - $package_value*3;
                     $new_total_value = ($package_earn - $remaning_value) + $current_earn->total;  
                     User_Package::whereId($current_user_package_id)->update(['total' => $new_total_value,'package_commission_update_at' => date('Y-m-d H:i:s')]);
                   }else if($new_total < $package_value*3){
                    $new_total_value = $new_total;
                    User_Package::whereId($current_user_package_id)->update(['total' => $new_total_value,'package_commission_update_at' => date('Y-m-d H:i:s')]);
                   }else{
                    
                   }
                  
                   $data = Package_Commissons::where('uid','=',$user_id ,'AND','package_id','=',$current_earn->package_id)->first();
                   $wallet = wallet::where('uid','=',$user_id)->first();
                   
                   if($data!=null){
                    $id = $data->id;
                    $new_package_earn = $data->package_commission + $package_earn;
                    
                    
                    if($wallet!=null){
                        $wid = $wallet->id;
                        $new_available_balance = $wallet->available_balance + $package_earn;
                        $new_package_balance = $wallet->package_balance + $package_earn;
                        $new_wallet_balance = $wallet->wallet_balance + $package_earn;
                        DB::table('wallets')
                        ->where('id', $wid)
                        ->update(['available_balance' => $new_available_balance, 'wallet_balance' => $new_wallet_balance, 'package_balance' => $new_package_balance]);
                        
                    }else{
                        DB::table('wallets')->insert([
                            'uid' => $user_id,
                            'wallet_balance' => $package_earn,
                            'available_balance' => $package_earn ,
                            'package_balance' => $package_earn,
                        ]);
                    }
                    
                   
                    DB::table('package__commissons')
                    ->where('id', $id)
                    ->update(['package_commission' => $new_package_earn]);

                    package_earn_log($user_id ,$current_earn->package_id,$package_earn);
                    } else {
                   DB::table('package__commissons')->insert([
                    'uid' => $user_id,
                    'package_id' => $current_earn->package_id,
                    'package_commission' => $package_earn ,
                     ]);
                     package_earn_log($user_id ,$current_earn->package_id,$package_earn);
                     if($wallet!=null){
                        $wid = $wallet->id;
                        $new_available_balance = $wallet->available_balance + $package_earn;
                        $new_package_balance = $wallet->package_balance + $package_earn;
                        $new_wallet_balance = $wallet->available_balance + $package_earn;
                        DB::table('wallets')
                        ->where('id', $wid)
                        ->update(['available_balance' => $new_available_balance, 'wallet_balance' => $new_wallet_balance, 'package_balance' => $new_package_balance]);
                    }else{
                        DB::table('wallets')->insert([
                            'uid' => $user_id,
                            'wallet_balance' => $package_earn,
                            'available_balance' => $package_earn ,
                            'package_balance' => $package_earn,
                        ]);
                    }  
                    } 
                    
                   

                }
                
                
              
            
    
        
        
    }
}
