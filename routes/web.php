<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BuypackageController;
use App\Http\Controllers\UserbuypackageController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\TransController;
use App\Http\Controllers\AddWalletCRUDController;
use App\Http\Controllers\GeneologyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChangePasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {   
    Route::get('/redirects', [HomeController::class,'index']);
    Route::get('/dashboard', [HomeController::class,'index']);

    Route::get('/disclaimer_notice', [HomeController::class,'disclaimer_notice']);
    Route::resource('/package', PackageController::class);
    Route::resource('/buy_package', BuypackageController::class);

    
    
    Route::get('/buy_package/{id}/progress',[BuypackageController::class,'buy']);

    Route::get('/buy_package/{id}/wallet_buy',[BuypackageController::class,'wallet_buy']);

    Route::get('/active_packages', [BuypackageController::class,'active']);
    Route::get('/user/profile', [UserController::class,'user']);

    Route::resource('/user_buy_package', UserbuypackageController::class);

    Route::get('/withdraw' , [WithdrawController::class, 'index']);

    Route::get('/trans/p2p' , [TransController::class, 'p2p']);

    Route::get('/trans/crypto' , [TransController::class, 'crypto']);

    

    Route::get('/genealogy' , [GeneologyController::class,'index']);
    Route::get('/genealogy/?parent={parent}' , [GeneologyController::class,'index']);

    Route::resource('/kyc', KycController::class);
    Route::get('/kyc_all', [KycController::class,'all_kyc']);


    Route::get('/user/profile', [UserController::class,'user']);
    Route::resource('/user', UserController::class);

    Route::resource('/trans',TransController::class);
    Route::resource('/add_wallet', AddWalletCRUDController::class);

    Route::resource('/wallet', WalletController::class);
    Route::get('/wallet_approved', [WalletController::class,'wallet_approved']);
    Route::get('/wallet_rejects', [WalletController::class,'wallet_rejects']);

    Route::get('/report_kyc', [ReportController::class,'report_kyc']);
    Route::get('/report_users', [ReportController::class,'report_user']);
    Route::get('/report_earn', [ReportController::class,'report_earn']);
    Route::get('/report_earn_user', [ReportController::class,'report_earn_user']);

    Route::get('/package_earn_trans', [TransController::class,'package_earn_trans']);
    Route::get('/package_earn' , [TransController::class,'package_earn']);
    
    Route::post('/package_earn_tranfer' , [TransController::class,'tranfer_package_earn']);


    Route::get('/user/profile/change-password', [ChangePasswordController::class,'index']);
    Route::post('/user/profile/change-password', [ChangePasswordController::class,'store'])->name('change.password');

    Route::get('/report_package_earn', [ReportController::class,'report_package_earn']);
    Route::get('/report_direct_earn', [ReportController::class,'report_direct_earn']);
    Route::get('/report_binary_earn', [ReportController::class,'report_binary_earn']);

});

Route::group(['middleware' => 'prevent-back-history'],function(){
	
	Route::get('/', function () {
        return view('welcome');
    });

});




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/redirects', [HomeController::class,'index']);
    
    
});


