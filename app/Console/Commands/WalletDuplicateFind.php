<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\wallet;
use App\Models\User_Package;
use App\Models\Package_Commissons;
class WalletDuplicateFind extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'WalletDuplicateFind:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $duplicate_records = DB::table("wallets")
        ->select("uid")
        ->groupBy("uid")
        ->havingRaw('count(*) > 1')
        ->get();
     foreach ($duplicate_records as $duplicate_record){
      $sum_of_each_duplicate_records = DB::table('wallets')->where("uid", "=", $duplicate_record->uid)
      ->get( array(
          DB::raw( 'SUM(wallet_balance) AS wallet_balance' ),
          DB::raw( 'SUM(available_balance) AS available_balance' ),
          DB::raw( 'SUM(binary_balance) AS binary_balance' ),
          DB::raw( 'SUM(package_balance) AS package_balance' ),
          DB::raw( 'SUM(direct_balance) AS direct_balance' ),
          DB::raw( 'SUM(wallet_out) AS wallet_out' ),
          
      ));
      
      $current_record_finds = DB::table('wallets')->where("uid", "=", $duplicate_record->uid)->get();
      $i=0;
      foreach($current_record_finds as $current_record_find){
        
        if($i==0){
         DB::table('wallets')->where('id', $current_record_find->id)->update(array('wallet_balance' => $sum_of_each_duplicate_records[0]->wallet_balance,'available_balance' => $sum_of_each_duplicate_records[0]->available_balance,'binary_balance' => $sum_of_each_duplicate_records[0]->binary_balance,'package_balance' => $sum_of_each_duplicate_records[0]->package_balance,'direct_balance' => $sum_of_each_duplicate_records[0]->direct_balance,'wallet_out' => $sum_of_each_duplicate_records[0]->wallet_out));
        }else{
          DB::table('wallets')->where('id', $current_record_find->id)->delete();
        }
        $i++;
      }
      
     
        
     }  

    }
    
}
