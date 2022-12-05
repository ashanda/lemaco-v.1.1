<?php
    
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use App\Models\Master_Data;
    use App\Models\User_Package;
    use App\Models\User_Parent;
    use App\Models\Direct_Commission;
    use App\Models\User;
    use App\Models\Commission;
    use App\Models\UserCryptoWallet;
    Use App\Models\Kyc;
    use App\Models\Package;
    use Illuminate\Support\Facades\Mail;
    use function PHPUnit\Framework\isEmpty;
    use Illuminate\Support\Facades\Log;
  
    
function get_system_id($id){
  $system_id = DB::table('users')
      ->where('uid','=',$id)
      ->first();
      return $system_id;
}


function package_earn_sum_view($uid){
    $data = DB::table("package_earn_log")->where('uid',$uid)->sum('earn'); 
    return $data;
}

  function holding_to_real_wallet($uid,$package_value){

    $holding_wallte_balance =  DB::table('holdin_wallets')
                              ->where('uid','=',$uid)
                              ->first();
                           
    if($holding_wallte_balance != null){
      $real_wallet_balance = DB::table('wallets')
      ->where('uid','=',$uid)
      ->first();
$now_wallete_blance = $real_wallet_balance->wallet_balance +  $holding_wallte_balance->wallet_balance;
$now_available_blance = $real_wallet_balance->available_balance +  $holding_wallte_balance->available_balance;

if(($package_value*4) > $now_wallete_blance){
              $result_hold = DB::table('holdin_wallets')
              ->where('uid', $uid)
              ->update([
                  'wallet_balance' => 0,
                  'available_balance' => 0,
              ]);

              $result_real = DB::table('wallets')
              ->where('uid', $uid)
              ->update([
                          'wallet_balance' => $now_wallete_blance,
                          'available_balance' => $now_available_blance,
                      ]); 

    }else{
      $new_balance = $now_wallete_blance - ($package_value*4);
      $result_hold = DB::table('holdin_wallets')
              ->where('uid', $uid)
              ->update([
                  'wallet_balance' => $now_wallete_blance - $new_balance,
                  'available_balance' => $now_wallete_blance - $new_balance,
              ]);

              $result_real = DB::table('wallets')
              ->where('uid', $uid)
              ->update([
                          'wallet_balance' => $new_balance,
                          'available_balance' => $new_balance,
                      ]); 
    }                         
                     
  }

  }

  function holding_log_sum(){
    $holding_balance = DB::table('holdin_wallets')
                      ->where('uid',Auth::user()->uid)
                      ->sum('wallet_balance');
     return $holding_balance;               
  }  

  function earn_debug($uid){
   $package_count = DB::table('user__packages')
                    ->where('uid', '=', $uid)
                    ->count();
                
    $package_total = DB::table('user__packages')
                    ->select('package_value','package_max_revenue','total')
                    ->where('uid', '=', $uid)
                    ->get();
    $transection = DB::table('transections')->where("uid", "=", $uid)->where("status", "=", 1)
    ->get( array(
        DB::raw( 'SUM(amount) AS amount' ),
        DB::raw( 'SUM(fee) AS fee' ),  
    ));

    

    $package = DB::table('package_earn_log')->where("uid", "=", $uid)
    ->get( array(
        DB::raw( 'SUM(earn) AS earn' ),   
    ));
    $direct = DB::table('direct_earn_log')->where("uid", "=", $uid)
    ->get( array(
        DB::raw( 'SUM(earn) AS earn' ),   
    ));

    $binary = DB::table('binary_earn_log')->where("uid", "=", $uid)
    ->get( array(
        DB::raw( 'SUM(earn) AS earn' ),   
    ));
    echo '<ul>';
    echo  '<li>User ID : '.$uid.'</li>' ; 
    echo '<br>';
    echo  '<li>Package Count : '.$package_count.'</li>' ; 

    foreach($package_total as $package_total){
      echo '<br>';
      echo  '<li>Package Value : '.$package_total->package_value.'</li>';  
      echo  '<li>User Package Earn table Total : '.$package_total->total.'</li>'; 
      echo '<br>';
    }                
    
    echo  '<li>Earn Total : '.$binary[0]->earn + $direct[0]->earn + $package[0]->earn.'</li>'; 
    echo '<br>';
    echo  '<li>Now Wallet Balance : '.($binary[0]->earn + $direct[0]->earn + $package[0]->earn)- ($transection[0]->amount + $transection[0]->fee).'</li>'; 
    echo '<br>';
    echo  '<li>Package Transection Amount : '.$transection[0]->amount.'</li>';   
    echo '<br>';
    echo  '<li>Package Transection Fee : '.$transection[0]->fee.'</li>'; 
    echo '<br>'; 
    echo  '<li>Binary Earn Total : '.$binary[0]->earn.'</li>'; 
    echo '<br>'; 
    echo  '<li>Package Earn Total : '.$package[0]->earn.'</li>';  
    echo '<br>';     
    echo  '<li>Direct Earn Total : '.$direct[0]->earn.'</li>';  
    echo '<br>'; 
    echo  '<li>Hold Total : '.($binary[0]->earn + $direct[0]->earn + $package[0]->earn) - $package_total->package_max_revenue.'</li>';
    echo '<br>'; 
    echo  '<li>Withdrawel Total : '.$transection[0]->amount + $transection[0]->fee.'</li>';
    echo '<br>'; 
    echo  '<li>Wallet Remaining balance : '.$package_total->package_max_revenue - ($transection[0]->amount + $transection[0]->fee).'</li>';
    echo '<br>'; 
    echo '</ul>';                        

  /*$User_packages_details =  DB::table("user__packages")->select("id", "uid" ,"package_max_revenue","total","status")
    ->where("uid", "=", $uid ,'AND','current_status','=',1)
    ->orderBy('id','asc')
    ->get();
    return $User_packages_details;
    */
  }

  
  function globle_send_mail($html)
    {

      
      $plain = "This email is automatically generated by the lemaconet system. Please do not reply to this email" ;
      $to = Auth::user()->email ;
      $subject= 'Lemaco Buy Package';
      $formEmail = 'support@lemaconet.com' ;
      $formName = 'LemacoNet';

      Mail::send([], [], function($message) use($html, $plain, $to, $subject, $formEmail, $formName){
        $message->from($formEmail, $formName);
        $message->to($to);
        $message->subject($subject);
        $message->setBody($html, 'text/html' ); // dont miss the '<html></html>' or your spam score will increase !
        $message->addPart($plain, 'text/plain');
    });
  
   
  }

//sms
function send_sms($receiver_number,$messsage)
    {
		$sender_id = 123;
		$sa_token = 123;
        

        $api_link = 'https://sms.send.lk/api/v3/sms/send';
        $mask = $sender_id;
        $api_key = $sa_token;
        $number = $receiver_number;   //Receiver Number
        $messsage = $messsage;        //SENDING MESSAGE සිංහල / தமிழ் / English

        $msgdata = array("recipient"=>$number, "sender_id"=>$mask, "message"=>$messsage);


			
			$curl = curl_init();
			
			//IF you are running in locally and if you don't have https/SSL. then uncomment bellow two lines
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
			
			curl_setopt_array($curl, array(
			  CURLOPT_URL => $api_link,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode($msgdata),
			  CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: Bearer $api_key",
				"cache-control: no-cache",
				"content-type: application/x-www-form-urlencoded",
			  ),
			));

			$response = curl_exec($curl);

			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo "send sucessfull";
			}
    }


//left side binary chek

function left_right_side_direct($user_id){
    $check_left_side = DB::table('user__parents')
    ->where('parent_id', $user_id)
    ->where('ref_s', 0) 
    ->get();
    $check_right_side = DB::table('user__parents')
    ->where('parent_id', $user_id)
    ->where('ref_s', 1) 
    ->get();
    
    $items_left = array();
    foreach($check_left_side as $left_side){
      $items_left[] = $left_side->uid;
        
    }
    $items_right = array();
    foreach($check_right_side as $right_side){
      $items_right[] = $right_side->uid;
        
    }

     $check_count_left = DB::table("user__packages")
      ->whereIn("uid", $items_left)
      ->where("status", "=", 1)
      ->get();

      $check_count_right = DB::table("user__packages")
      ->whereIn("uid", $items_right)
      ->where("status", "=", 1)
      ->get();

    if(count($check_count_left) > 0 && count($check_count_right) > 0){
        return 1;
    
    }else{
        return 0;
    }
    
    
}

function binary_log_sum(){
  $binary_log_sum = DB::table("binary_earn_log")->where('uid', Auth::user()->uid)->sum('earn');
  return $binary_log_sum;
}

function direct_log_sum(){
  $direct_log_sum = DB::table("direct_earn_log")->where('uid', Auth::user()->uid)->sum('earn');
  return $direct_log_sum;
}

function package_log_sum(){
  $package_log_sum = DB::table("package_earn_log")->where('uid', Auth::user()->uid)->sum('earn');
  return $package_log_sum;
}


// log data
function binary_earn_log($user_id,$package_id,$earn,$type){

  if( $earn!=0){
    DB::table('binary_earn_log')->insert([
      'uid' => $user_id,
      'package_id' => $package_id,
      'earn' => $earn,
      'type' => $type
    ]);
  }
 

}
function direct_earn_log($user_id,$package_id,$earn,$type){

  DB::table('direct_earn_log')->insert([
    'uid' => $user_id,
    'package_id' => $package_id,
    'earn' => $earn,
    'type' => $type
  ]);
 // Log::notice($user_id.','.$earn.' - Direct Earn');
}
function package_earn_log($user_id,$package_id,$earn){

  DB::table('package_earn_log')->insert([
    'uid' => $user_id,
    'package_id' => $package_id,
    'earn' => $earn,
  ]);

}

// get user and package commission
function get_package_commission_list(){
$get_package_commission_list = DB::table('users')
->join('package__commissons', 'users.uid', '=', 'package__commissons.uid')
->join('packages', 'packages.id', '=', 'package__commissons.package_id')
->orderBy('package__commissons.uid', 'desc')
->get();

return $get_package_commission_list;

}

//get package_earning_amount
function get_package_earning_amount($user_id){
  $package_earning_amount = DB::table('package__commissons')
  ->select(DB::raw("SUM(package_commission) as count"))
  ->where ('uid', $user_id)
  ->get();

  return $package_earning_amount;
}

function get_my_side($uid){
    $side = DB::table('user__parents')
    ->where('uid', '=', $uid)
    ->first();
    
    return $side;
}

// get parent name and email
function get_parent_name_email($uid){
    $parent_name_email = DB::table('users')
    ->leftJoin("kycs", function($join){
      $join->on("users.uid", "=", "kycs.uid");
  })
  ->select("users.uid","users.system_id","users.fname", "users.lname", "users.password", "users.email_verified_at", "users.status","kycs.phone_number")
    ->where('users.uid', '=', $uid)
    ->first();
    return $parent_name_email;
}


// 1:3 package and users

function package_earn_satisfy(){
  $date = date('Y-m-d H:i:s');
  $date = strtotime($date);
  $date = strtotime("-7 day", $date);
  $new_date = date('Y-m-d H:i:s', $date);
  echo $new_date;
  $package_earn_satisfy = DB::table('user__packages')
    ->whereColumn('user__packages.package_triple_value','>','user__packages.total')
    ->where('user__packages.status','=','1')
    
    ->join('users', 'user__packages.uid', '=', 'users.uid')
    ->join('packages', 'packages.id', '=', 'user__packages.package_id')
    ->where('user__packages.created_at','<',$new_date)
    ->select('user__packages.id as upid','user__packages.uid','user__packages.package_cat_id','user__packages.package_id','user__packages.package_id','user__packages.package_value','user__packages.package_double_value','user__packages.package_triple_value',
    'user__packages.package_max_revenue',
    'user__packages.package_commission_update_at',
    
    'user__packages.total',
    'user__packages.status','users.*','packages.*')
    ->get();
    return $package_earn_satisfy;
    
}

//client ip
function client_ip(Request $request)
{
   ($request->ip());
}


// pending Kyc count
function pendingKycCount()
{
    $pendingKyc = Kyc::where('status', '0')->count();
    return $pendingKyc;
}

//pending package count
function pendingPackageCount()
{
    $pendingPackage = User_Package::where('status', '2')->count();
    return $pendingPackage;
}

//package commission percentage get
function direct_package_commission_percentage(){
    $direct_commssion_precentages = DB::table('direct_commssion_precentages')->get();
    return $direct_commssion_precentages;
}


//package cat get and pass to admin package view
function package_cat_get(){
  $package_cat_get = DB::table('package__categories')
  ->get();
  return $package_cat_get;
}

//current user package commission

//user package count

function current_user_package_count($current_user_id,$package_cat_id)
{
    $user_package_count = User_Package::where('uid','=',$current_user_id,'AND','package_cat_id','=',$package_cat_id,'AND','current_status','=',1)->count();
    return $user_package_count;
}

function current_user_package_commission($current_user_id,$package_cat_id){
  $current_user_package_count = current_user_package_count($current_user_id,$package_cat_id);
  if($current_user_package_count == 1){
    $current_user_package_commission = DB::table('user__packages')
    ->join('packages', 'user__packages.package_id', '=', 'packages.id')
    ->join('package__categories', 'package__categories.cat_name', '=', 'packages.package_category')
    ->where('user__packages.uid', '=', $current_user_id)
    ->orderBy('packages.package_value', 'desc')
    ->get();
  }else{
    $current_user_package_commission = DB::table('user__packages')
    ->join('packages', 'user__packages.package_id', '=', 'packages.id')
    ->join('package__categories', 'package__categories.cat_name', '=', 'packages.package_category')
    ->where('user__packages.uid', '=', $current_user_id,'AND','user__packages.status','=','1')
    ->orderBy('packages.package_value', 'desc')
    ->get();
  }

  
  return $current_user_package_commission;
}

//user previous package check//
function previous_package_check($user_id){
  $previous_package = DB::table('user__packages')
  ->where("uid", "=", $user_id)
  ->where("status", "=", 1)
  ->count();

 return $previous_package;
}   

//user package count

    function user_package_count()
    {
        $user_package_count = User_Package::where('uid','=',Auth::user()->uid)->count();
        return $user_package_count;
    }

//Geneology


function geneology( $target_parent){

 
 
  $parent_details = DB::table("users")
                  ->where("users.uid", "=", $target_parent) 
                  ->get();
  
  if($parent_details->isEmpty()){
    echo '
    <div class="alert alert-warning" role="alert">
     <strong>Warning!</strong> No Geneology Found.
    </div>';
    
  }else{
echo "
	
		<li class='current_parent'>
    <a  title='User Details'>
    
                  
                  <span class='geneology_child_info'>
                    <lable>User id - ".$parent_details[0]->system_id." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                  <lable>Name - ".$parent_details[0]->fname." ".$parent_details[0]->lname." </lable>
                </span><br/>                
                  <span class='geneology_child_info'>
                    <lable>Registered Date - ".$parent_details[0]->created_at." </lable>
                  </span><br/>
                  </a>
               
    </a>";
			
    
    $geneology = DB::table('users')
    ->join('user__parents', 'user__parents.uid', '=', 'users.uid')
    ->where('user__parents.virtual_parent','=' ,$target_parent)
    ->select('user__parents.uid','users.fname','users.lname',"users.system_id", "users.email",'user__parents.ref_s' , 'users.fname' , 'users.email' , 'users.created_at')
    ->get();
    if($geneology->isEmpty()){
      echo '
      <div class="alert alert-warning" role="alert">
         No KYCS approved user yet
      </div>';
    }
$child_elements='';  
$left_child='';
$right_child='';        
    if(count($geneology)>0){
      echo '<ul>';
     
        foreach($geneology as $geneology_data){
            
            
            if($geneology_data->ref_s == 0){
              $left_child = 
              "<li class='left_child'>
                  <a href='/genealogy/?parent=$geneology_data->uid' title='User Details'>
                  <span class='geneology_child_info'>
                    <lable>User id - ".$geneology_data->system_id." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>Name - ".$geneology_data->fname." ".$geneology_data->lname." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>Registered Date - ".$geneology_data->created_at." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>User Side - LEFT </lable>
                  </span><br/>
                  </a>
                </li>";
            }else{
              $right_child = 
              "<li class='right_child'>
                  <a href='/genealogy/?parent=$geneology_data->uid' title='User Details'>
                  <span class='geneology_child_info'>
                    <lable>User id - ".$geneology_data->system_id." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>Name - ".$geneology_data->fname." ".$geneology_data->lname." </lable>
                  </span><br/>
                  
                  <span class='geneology_child_info'>
                    <lable>Registered Date - ".$geneology_data->created_at." </lable>
                  </span><br/>
                  <span class='geneology_child_info'>
                    <lable>User Side - RIGHT </lable>
                  </span><br/>
                  </a>
                </li>";;
            }

          }
          if($left_child != ''){
            
            echo $left_child;
          }
          if($right_child != ''){
            
            echo $right_child;
          }
          
        
    }
    echo '</ul>

    </li>
							
    
  ';
  }//end kyc check
  
}



// store fee
function store_fee($uid,$fee){
  $store_fee['uid'] = $uid;
  $store_fee['fee'] = $fee;

DB::table('company_profit_fee')->insert($store_fee);
}

 // fee
function get_trxfee($req_amount){
  $fee_value = DB::table('tranfer_fee')->where('id', '=', 1)->get();
  if(9 < $req_amount && $req_amount< 50 ){
    $fee= $fee_value[0]->fee_value;
    
}elseif(49 < $req_amount && $req_amount< 100){
  $fee= $fee_value[0]->fee_value;
}elseif( $req_amount > 99){
  $fee= $fee_value[0]->fee_value;
}else{
    $fee = -1;
}
return $fee;
} 

//kyc validate
function get_user_kyc_count(){
  $get_user_kyc_count = Kyc::where('uid','=',Auth::user()->uid,'AND','status','=','1')->count();
  return $get_user_kyc_count;
}

//wallet count
function get_user_wallets_count(){
  $get_user_wallets_count = UserCryptoWallet::where('uid','=',Auth::user()->uid)->count();
  return $get_user_wallets_count;
}


// wallet address get //
function get_user_wallets_data(){
  $get_user_wallets = UserCryptoWallet::where('uid',Auth::id())->get();
  return $get_user_wallets;
}


// wallete realtime value
 function wallet_available_balance_sum(){
  $wallet_available_balance_sum = DB::table('wallets')->where('uid',"=",Auth::user()->uid)->sum('available_balance');
  return $wallet_available_balance_sum;
 }


  // wallete function
  function wallet_insert($uid,$wallet_balance){
    DB::table('wallets')->insert([
      'uid' => $uid,
      'wallet_balance' => $wallet_balance,
      'available_balance' => $wallet_balance,
      'direct_balance' => $wallet_balance,
  ]);
  }


  function wallet_update_direct($uid,$wallet_balance){
    $wallet_balance_update =  DB::table("wallets")
            ->select("id", "uid" ,"wallet_balance",'binary_balance','direct_balance')
            ->where("uid", "=", $uid )
            ->first();
            $wallet_balance_update_check =  DB::table("wallets")
            ->select("id", "uid" ,"wallet_balance",'binary_balance','direct_balance')
            ->where("uid", "=", $uid )
            ->count();

           if($wallet_balance_update_check > 0){
            $wallet_id= $wallet_balance_update->id;
            $new_wallet_balance = $wallet_balance_update->wallet_balance + ($wallet_balance);
            $new_direct_balance = $wallet_balance_update->direct_balance + ($wallet_balance);
            
          DB::table('wallets')
              ->where('id', $wallet_id)
              ->update(['wallet_balance' => $new_wallet_balance,'available_balance' =>$new_wallet_balance,'direct_balance' =>$new_direct_balance]);
           }else{
            
          wallet_insert($uid,$wallet_balance);
           }
  }



  function wallet_update_binary($uid,$wallet_balance){
    $wallet_balance_update =  DB::table("wallets")
            ->select("id", "uid" ,"wallet_balance",'binary_balance','direct_balance')
            ->where("uid", "=", $uid )
            ->first();
            $wallet_balance_update_check =  DB::table("wallets")
            ->select("id", "uid" ,"wallet_balance",'binary_balance','direct_balance')
            ->where("uid", "=", $uid )
            ->count();

           if($wallet_balance_update_check > 0){
            $wallet_id= $wallet_balance_update->id;
            $new_wallet_balance = $wallet_balance_update->wallet_balance + ($wallet_balance);
            $new_binary_balance = $wallet_balance_update->binary_balance + ($wallet_balance);
            
                DB::table('wallets')
              ->where('id', $wallet_id)
              ->update(['wallet_balance' => $new_wallet_balance,'available_balance' =>$new_wallet_balance,'binary_balance' =>$new_binary_balance]);
           }else{
            DB::table('wallets')->insert([
              'uid' => $uid,
              'wallet_balance' => $wallet_balance,
              'available_balance' => $wallet_balance,
              'binary_balance' => $wallet_balance,
          ]);
            
           }
  }
//-------------------------------------------------

// holding wallet
function holding_wallet_update_binary($uid,$wallet_balance){
        //Log::alert('holding insert - '.$uid.' - '.$wallet_balance);
          $wallet_balance_update =  DB::table("holdin_wallets")
          ->select("id", "uid" ,"wallet_balance")
          ->where("uid", "=", $uid )
          ->first();

          $wallet_balance_update_check =  DB::table("holdin_wallets")
          ->select("id", "uid" ,"wallet_balance")
          ->where("uid", "=", $uid )
          ->count();
          
          
        if($wallet_balance_update_check > 0){
          $wallet_id= $wallet_balance_update->id;
          $new_wallet_balance = $wallet_balance_update->wallet_balance + ($wallet_balance);
          
          
            DB::table('holdin_wallets')
            ->where('id', $wallet_id)
            ->update(['wallet_balance' => $new_wallet_balance,'available_balance' =>$new_wallet_balance]);
         }else{
        
          DB::table('holdin_wallets')->insert([
            'uid' => $uid,
            'wallet_balance' => $wallet_balance,
            'available_balance' => $wallet_balance,
            
        ]);
          
         }
}

//wallet log//
function wallet_log(){
  $wallete = DB::table("wallets")
  ->where("uid", "=", Auth::user()->uid)
  ->count();
  if($wallete > 0){
    $wallete_log = DB::table("wallets")
    ->where("uid", "=", Auth::user()->uid)
    ->get();
    return $wallete_log;
  }
  
  
  
}

//commission log//
function commssion_log(){
  $commssion_log_check = DB::table("commissions")
  ->where("uid", "=", Auth::user()->uid)
  ->count();
  if($commssion_log_check > 0){
    $commssion_log = DB::table("commissions")
    ->where("uid", "=", Auth::user()->uid)
    ->get();
    return $commssion_log;
  }
}

// transection log
function transection(){
  $transection_log_check = DB::table("transections")
  ->where("uid", "=", Auth::user()->uid)
  ->count();
  if($transection_log_check > 0){
    $transection_log = DB::table("transections")
    ->where("uid", "=", Auth::user()->uid)
    ->get();
    return $transection_log;
  }

}


// package commission //
function package_commission(){
  $user_package_data = DB::table('user__packages')->get();
  foreach($user_package_data as $data){
  $package_commission =  DB::table("package__commissions")
    ->select("id", "uid" ,"package_id","commission")
    ->where("uid", "=", $data->uid,"AND","package_id","=",$data->package_id )
    ->count();    
      
      
       if($package_commission < 1){
           $commission = $data->package_value*0.025;
           $user['uid'] = $data->uid;
           
           $user['package_id'] = $data->package_id;
           $user['commission'] = $commission;
           DB::table('package__commissions')->insert($user);
           $ptype='Package commission';
           $lcommission = '';
           $pcommission = $commission;
           $bleft = '';
           $bright= '';
      all_commission($data->uid,$data->package_id,$data->package_id,$ptype,$pcommission,$lcommission,$bleft,$bright);
       }else{
          $package_commission =  DB::table("package__commissions")
              ->select("id", "uid" ,"package_id","commission")
              ->where("uid", "=", $data->uid,"AND","package_id","=",$data->package_id )
              ->first();
           $new_package_commission = $package_commission->commission + ($data->package_value*0.025);      
           
           DB::table('package__commissions')
          ->where('id', $package_commission->id)
          ->update(['commission' => $new_package_commission]);
          $ptype='Package commission';
          $lcommission = '';
          $pcommission = $new_package_commission;
          $bleft = '';
          $bright= '';
          all_commission($data->uid,$data->package_id,$data->package_id,$ptype,$pcommission,$lcommission,$bleft,$bright);
       }
       
    }
}



//get ref id function 
  function get_ref(){
    $get_ref = User_Parent::where('uid',Auth::user()->uid)->first();
    return $get_ref;
  }
//******************************* */



// package max 5 time //
  function get_package_status($packageid){
    $get_package_status = User_Package::where('uid','=',Auth::user()->uid,'AND','package_id','=',$packageid)->count();
    if($get_package_status > 5){
      $result_valu = 0;
    }else{
       $result_valu = 1;
    }
    return $result_valu;
}

/*********************************************** */


//package commission sum
function package_commission_sum(){
  $package_commission_sum = DB::table('package__commissions')->where('uid',Auth::id())->sum('commission');
  return $package_commission_sum;
}

// wallet total
function wallet_total(){
  $wallet_total_sum = DB::table('wallets')->where('uid',"=",Auth::user()->uid)->sum('wallet_balance');
  return $wallet_total_sum;
}


// direct commission sum 
  function direct_commision(){
    $direct_commision = DB::table('wallets')->where('uid',Auth::user()->uid);
    return $direct_commision;
  }


  // all wallet commission
  function all_wallet_commision(){
    $all_wallet_commision = DB::table('wallets')->where('uid',Auth::user()->uid)->first();
   
    
    return $all_wallet_commision;
  }

  function all_hold_wallet_commision(){
    $all_hold_wallet_commision = DB::table('holdin_wallets')->where('uid',Auth::user()->uid)->first();
   
    
    return $all_hold_wallet_commision;
  }

  
  function binary_commision_right(){
    $binary_commision = DB::table('user_binary_commissions')->where('uid',Auth::id())->sum('current_right_balance');
    
    return $binary_commision;
  }

  function binary_commision_left(){
    $binary_commision = DB::table('user_binary_commissions')->where('uid',Auth::id())->sum('current_left_balance');
    
    return $binary_commision;
  }
/********************************* */



  function invest(){
    $invest = DB::table('user__packages')->where('uid',Auth::id())->sum('package_double_value');
    $total_invest = $invest/2;
    return $total_invest;
  }

  // buy package function 
  function buy_package($user_package_row_id,$package_value,$package_id,$package_cat,$current_user,$package_cat_id){
    
    assign_user_commissions( $user_package_row_id,$package_value,$package_id,$package_cat,$current_user,$package_cat_id );
    
  }

 //update user_package table in new commission
 function user_package_new_commission($id,$new_commission){
  $user_package_new_comission = DB::table('user__packages')
   ->where('id', $id)
   ->update(array('package_commission' => $new_commission));  
 }








/*************************************************/
// assign user commission function first time
  function assign_user_commissions($user_package_row_id,$package_value,$package_id,$package_cat,$current_user,$package_cat_id){
    
   
    $parent_id=-1;
    $virtual_parentid = 0;
    $parent_user_level = 0;
    $direct_parent_dna= -1;
    $current_row_uid = -1;

    $get_system_id = get_system_id($current_user);
    Log::debug('---------------------------------------------------');
   
    Log::debug('Name - ' .$get_system_id->fname.' '. $get_system_id->lname );

    while ( $virtual_parentid  != 1){// ID 2 is the top most user in the pyramid.*/ 
      
      if($parent_id == -1){
        $sub_level_parent = get_parent_details( $current_user );
      }else{
        $sub_level_parent = get_parent_details(  $virtual_parentid );
      }  

      
       
      if(!isset($sub_level_parent[0])){
          /*$top_level_user = new User_Parent();
          $top_level_user->uid = 2 ;
          $top_level_user->ref_s = -1 ;
          $top_level_user->parent_id = 0 ;
          $top_level_user->virtual_parent = 0 ;
          $top_level_user->save();*/
          break;  
        }
      
      $current_row_uid  =  $sub_level_parent[0]->uid;

      $virtual_parentid =  $sub_level_parent[0]->virtual_parent;
      
      $parent_id  =  $sub_level_parent[0]->parent_id;
      
      $ref_s = $sub_level_parent[0]->ref_s; 
      
      // First Time Assign DNA Parent
      if($direct_parent_dna == -1){
        $direct_parent_dna = $current_row_uid; //3
      } 
      $commission_ratio = direct_package_commission_percentage();
     // Log::debug('virtual parent before if vp:'.$virtual_parentid .' - dna:'.$direct_parent_dna.' - pid '.$parent_id.' -curran row uid '.$current_row_uid );
     //finding the direct parent chain
      if($current_row_uid == $direct_parent_dna){
        
        $direct_commission =  DB::table("direct__commissions")
        ->select("id", "uid" ,"direct_commission")
        ->where("uid", "=", $parent_id )
        ->get();
        
        
        
        
  
      switch ( $parent_user_level ) {
        case 0:    
                
             $new_direct_commission = $package_value * $commission_ratio[0]->first_time_direct;
             $get_system_id = get_system_id($parent_id);
             
           // Log::debug('FIRST TIME');
            validate_user_commissions( $parent_id,$new_direct_commission ,$package_value );               
             Log::debug('Direct Parent 01- ' .$parent_id );
             Log::debug('Direct Parent 01 System id- ' .$get_system_id->system_id );
             Log::debug('Direct Parent commission 01 - ' .$new_direct_commission ); 
             break;
        case 1:    
           $get_system_id = get_system_id($parent_id); 
            $new_direct_commission = $package_value * $commission_ratio[0]->first_time_direct_01;
           Log::debug('Direct Parent 02 - ' .$parent_id ); 
           Log::debug('Direct Parent 02 System id- ' .$get_system_id->system_id );
           Log::debug('Direct Parent commission 02- ' .$new_direct_commission ); 
           validate_user_commissions( $parent_id,$new_direct_commission ,$package_value );
            
            break;
        case 2:  
            $get_system_id = get_system_id($parent_id);
            $new_direct_commission = $package_value * $commission_ratio[0]->first_time_direct_02;
             validate_user_commissions($parent_id,$new_direct_commission ,$package_value );
           Log::debug('Direct Parent 03- ' .$parent_id );
           Log::debug('Direct Parent 01 System id- ' .$get_system_id->system_id );
           Log::debug('Direct Parent commission 03- ' .$new_direct_commission );  
            break;	
        case 3:     
           $get_system_id = get_system_id($parent_id);       
            $new_direct_commission = $package_value * $commission_ratio[0]->first_time_direct_03;
            validate_user_commissions( $parent_id,$new_direct_commission ,$package_value );
           Log::debug('Direct Parent 04- ' .$parent_id );
           Log::debug('Direct Parent 01 System id- ' .$get_system_id->system_id );
           Log::debug('Direct Parent commission 04 - ' .$new_direct_commission ); 
            break;
      } 
      
      
      $parent_user_level++;
      
      // DNA User Update
      
      if($parent_id != NULL){
        $direct_parent_dna = $parent_id;
      
      }else{

      }
    }
    //end of if

      /* 		   						
        Assign Binary Commission to the parent user here
                  
        We know Parent ID;
        We know parent side;
        We know packageValue;
        
        /****************************************************/
        
        /* Query for UserBinary Commision table values	- SELECT */	
        

       // $current_user_package_commission = current_user_package_commission($virtual_parentid);
        
       
        
        $new_binary_commission = binary_commission_find($virtual_parentid,$package_value,$package_id,$package_cat_id);   
        

       
       
          validate_binary_commissions($ref_s,$virtual_parentid,$current_row_uid,$new_binary_commission);
         
        
        
        
      $get_system_id = get_system_id($virtual_parentid);   
      Log::debug('Virtural Parent -'.$virtual_parentid);
      Log::debug('Virtural Parent System id - ' .$get_system_id->system_id );
      Log::debug('Virtual Parent commission - ' .$new_binary_commission );    
      //echo $virtual_parentid.'/';
      //echo $direct_parent_dna.'/';
      if($current_row_uid == 2 ){
      
        break;
      }
      
    }
    //end of while
    
    
  }
  
 

// validate_user_commissions
function validate_user_commissions( $current_row_uid,$new_direct_commission,$package_value ){
 
  $balance_commission = $new_direct_commission;
 
  $User_packages_details =  DB::table("user__packages")->select("id", "uid" ,"package_id","package_max_revenue","total","current_status")
    ->where("uid", "=", $current_row_uid)
    ->where('current_status','=',1)
    ->orderBy('id','asc')
    ->get();
  $packages_count = count($User_packages_details); 
  
  //Log::debug('user package details - '.$User_packages_details);
  if (isset($User_packages_details)) {  
   // var_dump($User_packages_details);
   $i=1;
  // Log::debug('uid - '.$current_row_uid.' - pkgs count -' .$packages_count );
  foreach($User_packages_details as $package){
   // Log::debug('Foreach - '.$i.' balance commission - '.$balance_commission);

    $package_earning_capacity = $package->package_max_revenue - $package->total;
    //Log::debug('package earn capacity direct - '.$package_earning_capacity);
    if($balance_commission >= 0){
      
          if( ($package->total + $balance_commission) <= $package->package_max_revenue ){
          //  Log::debug('$balance_commission >= 0 if ');
              // User Package Table Update with Total
          
           // user_package_total_binary($User_packages_details[0]->id,$User_packages_details[0]->uid,$package->package_max_revenue,$package->total,$new_direct_commission);
            direct_commission_update_queries($package,$current_row_uid,$balance_commission);   
             
            $balance_commission = 0;  
            
         

          }else{ 
            
            
           // $hold_direct_commission =  $package->total + $balance_commission -  $package->package_max_revenue;      
            Log::debug('$balance_commission >= 0 else ');

             if($packages_count != $i){
             // Log::debug('$packages_count != $i if ');
             //Log::debug('New direct commission else - '.$new_direct_commission);
              //user_package_total_binary($User_packages_details[0]->id,$User_packages_details[0]->uid,$package->package_max_revenue,$package->total,$new_direct_commission);
              direct_commission_update_queries($package,$current_row_uid,$package_earning_capacity);    
             // direct_commission_update_queries_hold($User_packages_details,$current_row_uid,$hold_direct_commission,$direct_commission_count,$package_value);    
              
             $balance_commission =   $balance_commission-$package_earning_capacity ;
             // Log::debug('balance commission if - '.$balance_commission );
             }else{
             // Log::debug('$packages_count != $i else ');
              // user_package_total_binary($User_packages_details[0]->id,$User_packages_details[0]->uid,$package->package_max_revenue,$package->total,$new_direct_commission);
              direct_commission_update_queries($package,$current_row_uid,$package_earning_capacity);  

              $balance_commission =   $balance_commission-$package_earning_capacity ;  

              if($balance_commission > 0){
              //Log::debug('hold direct commission else if- '.$hold_direct_commission );
              direct_commission_update_queries_hold($package,$current_row_uid,$balance_commission);    
              $balance_commission = 0;  
              }
              
              
             }
            
            
          
          }            
        }
        
      $i++;
    } 
  } 
    
}

//direct_commission_update_queries
function direct_commission_update_queries($User_packages_details,$current_row_uid,$new_direct_commission){
$type = 'Real Wallet';
direct_commission_update_user_package($User_packages_details,$new_direct_commission);    
wallet_update_direct($current_row_uid, $new_direct_commission );

direct_earn_log($current_row_uid,$User_packages_details->package_id,$new_direct_commission,$type);
}

// hold direct

function direct_commission_update_queries_hold($User_packages_details,$current_row_uid,$new_direct_commission){
  $type = 'Hold Wallet';
  $direct_commission =  DB::table("holdin_wallets")
  ->select("id", "uid" ,"wallet_balance","available_balance")
  ->where("uid", "=", $current_row_uid )
  ->first();
  
  
  //Log::debug($User_packages_details[0]->uid .' db record uid');
 // Log::debug($new_direct_commission .' commission');
if($direct_commission != NULL){
  //echo $current_row_uid.'update ';
  
  $direct_commision_id= $direct_commission->id;
  $direct_commission_total = $direct_commission->available_balance + $new_direct_commission;

  try {	
            
     
    
    
    holding_wallet_update_binary($direct_commission->uid, $new_direct_commission );
    
    $queryStatus = "Successful";
    } catch(Exception $e) {
        $queryStatus = "Not success";
    }

   
  
}
direct_earn_log($current_row_uid,$User_packages_details->package_id,$new_direct_commission,$type);
}

/****************************************** */

/*********************************************/
// find binary commission function
function binary_commission_find( $virtual_parentid,$package_value,$package_id,$package_cat_id){
 
  $virtual_user_data = DB::table('user__packages')
                      ->where('uid','=',$virtual_parentid)
                      ->where('current_status','=','1')
                      ->orderBy('package_double_value', 'desc')
                      ->get();
                  
   $binary_commission_count = count($virtual_user_data);                 
   
    if(isset($virtual_user_data[0] )){
      $package_cat_commission = DB::table('package__categories')
                            ->where('id',$virtual_user_data[0]->package_cat_id)
                            ->first();
      
      if($binary_commission_count > 0){

        $new_binary_commission = ($package_value * $package_cat_commission->cat_commission);  
        return $new_binary_commission;
      }

   }                         
  
   
   
}

// validate_binary_commissions
function validate_binary_commissions( $ref_s, $virtual_parentid, $current_row_uid, $new_binary_commission  ){
        
    
  $balance_commission = binary_commission_update( $ref_s, $virtual_parentid, $new_binary_commission);
 
  $User_packages_details =  DB::table("user__packages")->select("id", "uid" , "package_id", "package_max_revenue","total","current_status")
    ->where("uid", "=", $virtual_parentid)
    ->where('current_status','=',1)
    ->orderBy('id','asc')
    ->get();
   // Log::debug('user package details - '.$User_packages_details);
  $packages_count = count($User_packages_details); 
  
  
  if (isset($User_packages_details)) {  
   // var_dump($User_packages_details);
   $i=1;
  // Log::debug('uid - '.$current_row_uid.' - pkgs count -' .$packages_count );
  foreach($User_packages_details as $package){
   //Log::debug('package id - '.$package->id);
      
    $package_earning_capacity = $package->package_max_revenue - $package->total;

    // Log::debug('package earn capacity binary - '.$package_earning_capacity);
    if($balance_commission >= 0){
      
          if( ($package->total + $balance_commission) <= $package->package_max_revenue ){
                          
           // user_package_total_binary($User_packages_details[0]->id,$User_packages_details[0]->uid,$package->package_max_revenue,$package->total,$new_direct_commission);
             binary_commission_update_query($package,$virtual_parentid,$balance_commission);    
            $balance_commission = 0;     

          }else{ 
            

            //$hold_direct_commission =  ($package->total + $balance_commission )-  $package->package_max_revenue;      
            //Log::debug('Hold direct commission else- '.$hold_direct_commission .' Balance commssion - '.$balance_commission );

            if($packages_count != $i){
            // Log::debug('pkg earn capacity if - '.$package_earning_capacity );
              //user_package_total_binary($User_packages_details[0]->id,$User_packages_details[0]->uid,$package->package_max_revenue,$package->total,$new_direct_commission);
              binary_commission_update_query($package,$virtual_parentid,$package_earning_capacity);    
             // direct_commission_update_queries_hold($User_packages_details,$current_row_uid,$hold_direct_commission,$direct_commission_count,$package_value);    
              
           
             $balance_commission =   $balance_commission-$package_earning_capacity ;

             // Log::debug('balance commission if - '.$balance_commission );
             }else{
              //Log::debug('pkg earn capacity else - '.$package_earning_capacity );
              // user_package_total_binary($User_packages_details[0]->id,$User_packages_details[0]->uid,$package->package_max_revenue,$package->total,$new_direct_commission);
              binary_commission_update_query($package,$virtual_parentid,$package_earning_capacity);   

              $balance_commission =   $balance_commission-$package_earning_capacity ;

              if($balance_commission > 0){
            // Log::debug('hold direct commission else if- '.$hold_direct_commission );
              binary_commission_update_query_hold($package,$virtual_parentid,$balance_commission);    
              $balance_commission = 0;  
              }
                            
             }
          }            
        }              
      $i++;
  } 
} 
}



function binary_commission_update( $ref_s, $virtual_parentid, $new_binary_commission){
  
    $User_binary_details =  DB::table("user_binary_commissions")
     ->select("id", "uid" ,"current_left_balance","current_right_balance",'total')
     ->where("uid", "=", $virtual_parentid)
     ->get();      
  
     $User_binary_details_count=count($User_binary_details);
     $binary_commission     =  $new_binary_commission;
     $current_left_balance;
     $current_right_balance;
     $current_total;

     if($User_binary_details_count > 0){

      $current_left_balance  =  $User_binary_details[0]->current_left_balance;
      $current_right_balance =  $User_binary_details[0]->current_right_balance;
      $current_total = $User_binary_details[0]->total;
     }else{
      
      $current_left_balance  =  0;
      $current_right_balance =  0;
      $current_total = 0;
     }
     
     
     $final_binary_amount;

     if( $ref_s == 0) {
        $current_left_balance  += $binary_commission;
     }else{
        $current_right_balance += $binary_commission;
     }

     if($current_left_balance > $current_right_balance){
        $final_binary_amount =  $current_right_balance;
        $current_left_balance = $current_left_balance - $current_right_balance;
        $current_right_balance = 0;

     }else if($current_left_balance < $current_right_balance){
        $final_binary_amount =  $current_left_balance;
        $current_right_balance = $current_right_balance - $current_left_balance;
        $current_left_balance = 0;
     }else{
        $final_binary_amount =  $current_left_balance;
        $current_left_balance = 0;
        $current_right_balance = 0;    
     }

     // Update the binary table left and right values here
      
      DB::table("user_binary_commissions")->updateOrInsert(
      ['uid' =>  $virtual_parentid],
      ['total' => ($current_total+$final_binary_amount),'current_left_balance'=>$current_left_balance,'current_right_balance'=>$current_right_balance]
  );
     
     
     //Then
     return  $final_binary_amount;

}

//holding wallet update query
function binary_commission_update_query_hold($package,$virtual_parentid,$balance_commission){
  $type ="Hold Wallet";

  $binary_commission =  DB::table("holdin_wallets")
  ->select("id", "uid" ,"wallet_balance","available_balance")
  ->where("uid", "=", $virtual_parentid )
  ->first();

  if($binary_commission != NULL){
    //echo $current_row_uid.'update ';
    
    $binary_commission_id= $binary_commission->id;
    $binary_commission_total = $binary_commission->available_balance + $balance_commission;
  
    try {	
              
       
      
      
      holding_wallet_update_binary($binary_commission->uid, $balance_commission);
      
      $queryStatus = "Successful";
      } catch(Exception $e) {
          $queryStatus = "Not success";
      }
  
     
    
  }
 
  binary_earn_log($virtual_parentid,$package->package_id,$balance_commission,$type);
  
        
}

/************************************* */


// binary commission update fuction
function binary_commission_update_query($package,$virtual_parentid,$balance_commission){
  
     
  $type ="Real Wallet";
  binary_commission_update_user_package($package,$balance_commission);
  binary_earn_log($virtual_parentid,$package->package_id,$balance_commission,$type);
  wallet_update_binary($virtual_parentid,$balance_commission); 
           
}

/*********************************************/

//get perant child //
  function get_parent_details($chiild_user){
    $get_parent_details = DB::table("user__parents")
    ->select("id","uid","parent_id", "ref_s","virtual_parent" )
    ->where("uid", "=", $chiild_user )
    ->get();
    
    return $get_parent_details;
    
  }



  // buy package secound time function //

function buy_package_secound_time($user_package_row_id,$package_value,$package_id,$package_cat,$current_user,$package_cat_id){
    
   
      $parent_id=-1;
      $virtual_parentid = 0;
      $parent_user_level = 0;
      $direct_parent_dna= -1;
      $current_row_uid = -1;
  
      $get_system_id = get_system_id($current_user);
      Log::debug('---------------------------------------------------');
     
      Log::debug('Name - ' .$get_system_id->fname.' '. $get_system_id->lname );
  
      while ( $virtual_parentid  != 1){// ID 2 is the top most user in the pyramid.*/ 
        
        if($parent_id == -1){
          $sub_level_parent = get_parent_details( $current_user );
        }else{
          $sub_level_parent = get_parent_details(  $virtual_parentid );
        }  
  
        
         
        if(!isset($sub_level_parent[0])){
            /*$top_level_user = new User_Parent();
            $top_level_user->uid = 2 ;
            $top_level_user->ref_s = -1 ;
            $top_level_user->parent_id = 0 ;
            $top_level_user->virtual_parent = 0 ;
            $top_level_user->save();*/
            break;  
          }
        
        $current_row_uid  =  $sub_level_parent[0]->uid;
  
        $virtual_parentid =  $sub_level_parent[0]->virtual_parent;
        
        $parent_id  =  $sub_level_parent[0]->parent_id;
        
        $ref_s = $sub_level_parent[0]->ref_s; 
        
        // First Time Assign DNA Parent
        if($direct_parent_dna == -1){
          $direct_parent_dna = $current_row_uid; //3
        } 
        $commission_ratio = direct_package_commission_percentage();
       // Log::debug('virtual parent before if vp:'.$virtual_parentid .' - dna:'.$direct_parent_dna.' - pid '.$parent_id.' -curran row uid '.$current_row_uid );
       //finding the direct parent chain
        if($current_row_uid == $direct_parent_dna){
          
          $direct_commission =  DB::table("direct__commissions")
          ->select("id", "uid" ,"direct_commission")
          ->where("uid", "=", $parent_id )
          ->get();
          
          
          
          
    
        switch ( $parent_user_level ) {
          case 0:    
                  
               $new_direct_commission = $package_value * $commission_ratio[0]->secound_time_direct;
               $get_system_id = get_system_id($parent_id);
               
             // Log::debug('FIRST TIME');
              validate_user_commissions( $parent_id,$new_direct_commission ,$package_value );               
             //  Log::debug('Direct Parent 01- ' .$parent_id );
             // Log::debug('Direct Parent 01 System id- ' .$get_system_id->system_id );
             // Log::debug('Direct Parent commission 01 - ' .$new_direct_commission ); 
               break;
          case 1:    
             $get_system_id = get_system_id($parent_id); 
              $new_direct_commission = $package_value * $commission_ratio[0]->secound_time_direct_01;
           ///  Log::debug('Direct Parent 02 - ' .$parent_id ); 
            // Log::debug('Direct Parent 02 System id- ' .$get_system_id->system_id );
            // Log::debug('Direct Parent commission 02- ' .$new_direct_commission ); 
             validate_user_commissions( $parent_id,$new_direct_commission ,$package_value );
              
              break;
          case 2:  
              $get_system_id = get_system_id($parent_id);
              $new_direct_commission = $package_value * $commission_ratio[0]->secound_time_direct_02;
               validate_user_commissions($parent_id,$new_direct_commission ,$package_value );
             // Log::debug('Direct Parent 03- ' .$parent_id );
            // Log::debug('Direct Parent 01 System id- ' .$get_system_id->system_id );
             // Log::debug('Direct Parent commission 03- ' .$new_direct_commission );  
              break;	
          case 3:     
             $get_system_id = get_system_id($parent_id);       
              $new_direct_commission = $package_value * $commission_ratio[0]->secound_time_direct_03;
              validate_user_commissions( $parent_id,$new_direct_commission ,$package_value );
             // Log::debug('Direct Parent 04- ' .$parent_id );
            // Log::debug('Direct Parent 01 System id- ' .$get_system_id->system_id );
            //  Log::debug('Direct Parent commission 04 - ' .$new_direct_commission ); 
              break;
        } 
        
        
        $parent_user_level++;
        
        // DNA User Update
        
        if($parent_id != NULL){
          $direct_parent_dna = $parent_id;
        
        }else{
  
        }
      }
      //end of if
  
        /* 		   						
          Assign Binary Commission to the parent user here
                    
          We know Parent ID;
          We know parent side;
          We know packageValue;
          
          /****************************************************/
          
          /* Query for UserBinary Commision table values	- SELECT */	
          
  
         // $current_user_package_commission = current_user_package_commission($virtual_parentid);
          
         
          
          $new_binary_commission = binary_commission_find($virtual_parentid,$package_value,$package_id,$package_cat_id);   
          
  
         
         
            validate_binary_commissions($ref_s,$virtual_parentid,$current_row_uid,$new_binary_commission);
           
          
          
          
        $get_system_id = get_system_id($virtual_parentid);   
        //Log::debug('Virtural Parent -'.$virtual_parentid);
        //Log::debug('Virtural Parent System id - ' .$get_system_id->system_id );
       // Log::debug('Virtual Parent commission - ' .$new_binary_commission );    
        //echo $virtual_parentid.'/';
        //echo $direct_parent_dna.'/';
        if($current_row_uid == 2 ){
        
          break;
        }
        
      }
      //end of while
      
      
    }
/****************************************** */

function direct_commission_update_user_package($User_packages_details,$new_direct_commission){

  DB::table('user__packages')->where('id', $User_packages_details->id)->update(array('total'=>$User_packages_details->total+($new_direct_commission)));	

}

function binary_commission_update_user_package($User_packages_details,$new_binary_commission){

  DB::table('user__packages')->where('id', $User_packages_details->id)->update(array('total'=>$User_packages_details->total+($new_binary_commission)));	

}
//commission log function //
  function all_commission($uid,$puid,$pid,$ptype,$pcommission,$lcommission,$bleft,$bright){
    $all_commission = new Commission();
    $all_commission->uid = $uid;
    $all_commission->parent_uid = $puid;
    $all_commission->package_id = $pid;
    $all_commission->package_type = $ptype;
    $all_commission->package_commission  = $pcommission;
    $all_commission->level_commission   = $lcommission;
    $all_commission->binary_commission_left   = $bleft;
    $all_commission->binary_commission_right   = $bright;
    $all_commission->save();

  }
 


?>
