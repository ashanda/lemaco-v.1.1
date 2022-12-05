<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class AutoRemoveNotBuyUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutoRemoveNotBuyUser:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '24 hours after user not buy any package, this cron job will remove user';

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
        $autoRemoveNotBuyUsers = DB::table('users')
        ->leftJoin("user__packages", function($join){
          $join->on("users.uid", "=", "user__packages.uid");
          })
          ->where('users.role',0)
          ->whereNull("user__packages.uid")
          ->select("users.uid","users.fname", "users.lname", "users.email", "users.created_at")
          ->get();
      foreach($autoRemoveNotBuyUsers as $autoRemoveNotBuyUser){
        $row_id = $autoRemoveNotBuyUser->uid;
        User::where("uid", $row_id)->update(["status" => 0]);
      } 
    }
}
