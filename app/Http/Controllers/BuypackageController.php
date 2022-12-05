<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User_Package;
use App\Models\User_Parent;
use App\Models\wallet;
use App\Models\Direct_Commission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PackageController;

use App\Models\Package;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class BuypackageController extends Controller
{
    public function index()
        {
            $role=Auth::user()->role;

            if($role==1){
                $user_id = Auth::id();
                $data = DB::table('packages')->get();  
                   
                return view('admin.package.index',compact('data'));
            }

            if($role==0){
                $user_id = Auth::id();
                $data = DB::table('packages')->get();   
                $package_data = DB::table('user__packages')
                
                ->where('uid', $user_id)
                ->get();   
                return view('user.package.index',compact('data','package_data'));
            }
        }

        public function active(){
            $role=Auth::user()->role;
            if($role==0){
            $user_id = Auth::id();
                $data = DB::table('users')
                ->join('user__packages', 'users.uid', '=', 'user__packages.uid')
                ->join('packages', 'user__packages.package_id', '=', 'packages.id')
                ->where('users.uid', '=', $user_id)
                ->select('user__packages.id','users.fname', 'users.lname', 'packages.package_name','packages.package_duration', 'user__packages.status','user__packages.created_at')
                ->get();    
                return view('user.package.active',compact('data'));
            }
        }
        
        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create()
        {
            
      
        }
        /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */

        

        public function store(Request $request)
        {
            $request->validate([
                
            
                
                'package_id' => 'required',
                'package_cat_id' => 'required',
                'package_value' => 'required',
                'currency_type' => 'required',
                'network'=>'required',

                
                
                ]);
            
                if($request->network == 'Wallet'){
                    $buy_package = new User_Package();
                    $buy_package->uid = Auth::user()->uid;
                    $buy_package->deposite_ss = 'none';
                    
                    $buy_package->package_id = $request->package_id;
                    
                    $user_current_package = DB::table('packages')->where('id','=',$buy_package->package_id)->get();
                    
                    // check previous package
                    $previous_package = previous_package_check($buy_package->uid);
                    
                    
                    if ($previous_package == 0){
                         
                        $package_revenue = $request->package_value * 5;
                        $package_revenue_double = $request->package_value * 2;
                        $package_revenue_triple = $request->package_value * 3;
                    }else{
                        $package_revenue_double = $request->package_value * 2;
                        $package_revenue_triple = $request->package_value * 3;
                        $package_revenue = $request->package_value * 4;
                    }
                    if(user_package_count() == 0){
                        $buy_package->package_value = $request->package_value;
                    }else{
                        $buy_package->package_value = $request->package_value;
                    }
                    $buy_package->package_cat_id = $request->package_cat_id;
                    $buy_package->package_double_value = $package_revenue_double;
                    $buy_package->package_triple_value = $package_revenue_triple;
                    $buy_package->package_max_revenue = $package_revenue;
                    $buy_package->currency_type = $request->currency_type;
                    $buy_package->network = $request->network;
                    $buy_package->save();

                    $old_wallet = wallet::where('uid',$buy_package->uid) -> first();
                   
                    wallet::where('uid', $buy_package->uid)
                    ->update([
                        'wallet_balance' => $old_wallet->wallet_balance - ($buy_package->package_value + 10),
                        'available_balance' => $old_wallet->wallet_balance - ($buy_package->package_value + 10)
                        ]);
                     
                    DB::table('transections')->insert([
                            'uid' => Auth::user()->uid,
                            'fee' => 0,
                            'amount' => $request->package_value + 10,
                            'p2p_id'=>'Buy package',
                            'currency_type'=>'USDT',
                            'network'=>'No',
                            'wallet_address'=>'No',
                            'status'=>1,
                        ]);    


                }else{
                    $buy_package = new User_Package();
                    $buy_package->uid = Auth::user()->uid;
                    if($request->file('deposite_ss')){
                        $file= $request->file('deposite_ss');
                        $filename= date('YmdHi').$file->getClientOriginalName();
                        $file-> move(public_path('/deposite/img'), $filename);
                        $buy_package->deposite_ss = $filename;
                    }else{
                        $buy_package->deposite_ss = 'none';
                    }
                    $buy_package->package_id = $request->package_id;
                    
                    $user_current_package = DB::table('packages')->where('id','=',$buy_package->package_id)->get();
                    
                    // check previous package
                    $previous_package = previous_package_check($buy_package->uid);
                    
                    
                    if ($previous_package == 0){
                         
                        $package_revenue = $request->package_value * 5;
                        $package_revenue_double = $request->package_value * 2;
                        $package_revenue_triple = $request->package_value * 3;
                    }else{
                        $package_revenue_double = $request->package_value * 2;
                        $package_revenue_triple = $request->package_value * 3;
                        $package_revenue = $request->package_value * 4;
                    }
                    if(user_package_count() == 0){
                        $buy_package->package_value = $request->package_value+10;
                    }else{
                        $buy_package->package_value = $request->package_value+10;
                    }
                    $buy_package->package_cat_id = $request->package_cat_id;
                    $buy_package->package_double_value = $package_revenue_double;
                    $buy_package->package_triple_value = $package_revenue_triple;
                    $buy_package->package_max_revenue = $package_revenue;
                    $buy_package->currency_type = $request->currency_type;
                    $buy_package->network = $request->network;
                    $buy_package->save();
                    
                }
               /* $html = '<!doctype html>
                <html>
                <head>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Simple Transactional Email</title>
                <style>
                    /* -------------------------------------
                        GLOBAL RESETS
                    ------------------------------------- */
                    
                    /*All the styling goes here
                    
                    img {
                    border: none;
                    -ms-interpolation-mode: bicubic;
                    max-width: 100%; 
                    }
            
                    body {
                    background-color: #f6f6f6;
                    font-family: sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                    padding: 0;
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%; 
                    }
            
                    table {
                    border-collapse: separate;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    width: 100%; }
                    table td {
                        font-family: sans-serif;
                        font-size: 14px;
                        vertical-align: top; 
                    }
            
                    /* -------------------------------------
                        BODY & CONTAINER
                    ------------------------------------- 
            
                    .body {
                    background-color: #f6f6f6;
                    width: 100%; 
                    }
            
                    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something 
                    .container {
                    display: block;
                    margin: 0 auto !important;
                    /* makes it centered 
                    max-width: 580px;
                    padding: 10px;
                    width: 580px; 
                    }
            
                    /* This should also be a block element, so that it will fill 100% of the .container 
                    .content {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    max-width: 580px;
                    padding: 10px; 
                    }
            
                    /* -------------------------------------
                        HEADER, FOOTER, MAIN
                    ------------------------------------- 
                    .main {
                    background: #ffffff;
                    border-radius: 3px;
                    width: 100%; 
                    }
            
                    .wrapper {
                    box-sizing: border-box;
                    padding: 20px; 
                    }
            
                    .content-block {
                    padding-bottom: 10px;
                    padding-top: 10px;
                    }
            
                    .footer {
                    clear: both;
                    margin-top: 10px;
                    text-align: center;
                    width: 100%; 
                    }
                    .footer td,
                    .footer p,
                    .footer span,
                    .footer a {
                        color: #999999;
                        font-size: 12px;
                        text-align: center; 
                    }
            
                    /* -------------------------------------
                        TYPOGRAPHY
                    ------------------------------------- 
                    h1,
                    h2,
                    h3,
                    h4 {
                    color: #000000;
                    font-family: sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    margin: 0;
                    margin-bottom: 30px; 
                    }
            
                    h1 {
                    font-size: 35px;
                    font-weight: 300;
                    text-align: center;
                    text-transform: capitalize; 
                    }
            
                    p,
                    ul,
                    ol {
                    font-family: sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    margin: 0;
                    margin-bottom: 15px; 
                    }
                    p li,
                    ul li,
                    ol li {
                        list-style-position: inside;
                        margin-left: 5px; 
                    }
            
                    a {
                    color: #3498db;
                    text-decoration: underline; 
                    }
            
                    /* -------------------------------------
                        BUTTONS
                    ------------------------------------- 
                    .btn {
                    box-sizing: border-box;
                    width: 100%; }
                    .btn > tbody > tr > td {
                        padding-bottom: 15px; }
                    .btn table {
                        width: auto; 
                    }
                    .btn table td {
                        background-color: #ffffff;
                        border-radius: 5px;
                        text-align: center; 
                    }
                    .btn a {
                        background-color: #ffffff;
                        border: solid 1px #3498db;
                        border-radius: 5px;
                        box-sizing: border-box;
                        color: #3498db;
                        cursor: pointer;
                        display: inline-block;
                        font-size: 14px;
                        font-weight: bold;
                        margin: 0;
                        padding: 12px 25px;
                        text-decoration: none;
                        text-transform: capitalize; 
                    }
            
                    .btn-primary table td {
                    background-color: #3498db; 
                    }
            
                    .btn-primary a {
                    background-color: #3498db;
                    border-color: #3498db;
                    color: #ffffff; 
                    }
            
                    /* -------------------------------------
                        OTHER STYLES THAT MIGHT BE USEFUL
                    ------------------------------------- 
                    .last {
                    margin-bottom: 0; 
                    }
            
                    .first {
                    margin-top: 0; 
                    }
            
                    .align-center {
                    text-align: center; 
                    }
            
                    .align-right {
                    text-align: right; 
                    }
            
                    .align-left {
                    text-align: left; 
                    }
            
                    .clear {
                    clear: both; 
                    }
            
                    .mt0 {
                    margin-top: 0; 
                    }
            
                    .mb0 {
                    margin-bottom: 0; 
                    }
            
                    .preheader {
                    color: transparent;
                    display: none;
                    height: 0;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                    mso-hide: all;
                    visibility: hidden;
                    width: 0; 
                    }
            
                    .powered-by a {
                    text-decoration: none; 
                    }
            
                    hr {
                    border: 0;
                    border-bottom: 1px solid #f6f6f6;
                    margin: 20px 0; 
                    }
            
                    /* -------------------------------------
                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                    ------------------------------------- 
                    @media only screen and (max-width: 620px) {
                    table.body h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important; 
                    }
                    table.body p,
                    table.body ul,
                    table.body ol,
                    table.body td,
                    table.body span,
                    table.body a {
                        font-size: 16px !important; 
                    }
                    table.body .wrapper,
                    table.body .article {
                        padding: 10px !important; 
                    }
                    table.body .content {
                        padding: 0 !important; 
                    }
                    table.body .container {
                        padding: 0 !important;
                        width: 100% !important; 
                    }
                    table.body .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important; 
                    }
                    table.body .btn table {
                        width: 100% !important; 
                    }
                    table.body .btn a {
                        width: 100% !important; 
                    }
                    table.body .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important; 
                    }
                    }
            
                    /* -------------------------------------
                        PRESERVE THESE STYLES IN THE HEAD
                    ------------------------------------- 
                    @media all {
                    .ExternalClass {
                        width: 100%; 
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                        line-height: 100%; 
                    }
                    .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important; 
                    }
                    #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                        font-size: inherit;
                        font-family: inherit;
                        font-weight: inherit;
                        line-height: inherit;
                    }
                    .btn-primary table td:hover {
                        background-color: #34495e !important; 
                    }
                    .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important; 
                    } 
                    }
            
                </style>
                </head>
                <body>
                
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                    <tr>
                    <td>&nbsp;</td>
                    <td class="container">
                        <div class="content">
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role="presentation" class="main">
            
                            <!-- START MAIN CONTENT AREA -->
                            <tr>
                            <td class="wrapper">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                    <p>Hi '.Auth::user()->fname.' '.Auth::user()->lname.',</p>
                                    <p>Congratulations!</p>
                                    <p>You have purchased a $'.$request->package_value.' Digital Assets Package from LemacoNet.We warmly welcome you to Your Digital Wealth Plan! We guide you towards the potential growth of your Digital Assets. Enjoy the great services of LemacoNet.Best regards!</p>
                                    <p>Team LemacoNet</p>
                                    <p>UAE</p>
                                    </td>
                                </tr>
                                </table>
                            </td>
                            </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
                        <!-- END CENTERED WHITE CONTAINER -->
            
                        <!-- START FOOTER -->
                        <div class="footer">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            
                            <tr>
                                <td class="content-block powered-by">
                                Powered by <a href="http://lemaconet.com">Lemaconet.com</a>.
                                </td>
                            </tr>
                            </table>
                        </div>
                        <!-- END FOOTER -->
            
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    </tr>
                </table>
                </body>
            </html>' ;
            globle_send_mail($html);*/
            Alert::Alert('Success', 'Package has been buying successfully.')->persistent(true,false);
            return redirect()->route('buy_package.index');    
        
           
        }

        
        /**
        * Display the specified resource.
        *
        * @param  \App\buy_package  $buy_package
        * @return \Illuminate\Http\Response
        */
        public function show(User_Package $buy_package)
        {
       
        } 
        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Company  $buy_package
        * @return \Illuminate\Http\Response
        */
        public function buy($id)
            {
                $role=Auth::user()->role;
                if($role==1){
                    $buy_package = Package::find($id);
                    
                    return view('admin.kyc.edit',compact('buy_package','id'));
                }
                if($role==0){
                    
                    $buy_package = DB::table('packages')
                    ->join('package__categories','package__categories.cat_name','=','packages.package_category')
                    ->where('packages.id', $id)
                    ->select('packages.id','package__categories.id as package_cat_id','packages.package_category','packages.package_name', 'packages.package_value', 'packages.package_status')
                    ->get();  
                    
                    return view('user.package.buy',compact('buy_package','id'));
                }
            
            }

            public function wallet_buy($id)
            {
                $role=Auth::user()->role;
                if($role==1){
                    $buy_package = Package::find($id);
                    
                    return view('admin.kyc.edit',compact('buy_package','id'));
                }
                if($role==0){
                    
                    $buy_package = DB::table('packages')
                    ->join('package__categories','package__categories.cat_name','=','packages.package_category')
                    ->where('packages.id', $id)
                    ->select('packages.id','package__categories.id as package_cat_id','packages.package_category','packages.package_name', 'packages.package_value', 'packages.package_status')
                    ->get(); 
                    
                    return view('user.package.wallet_buy',compact('buy_package','id'));
                }
            
            }
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\buy_package  $buy_package
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
        }

}
