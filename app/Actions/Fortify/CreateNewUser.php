<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\User_Parent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\DB;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
   
    {
        
        
        Validator::make($input, [
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'ref_id' => ['required'],
            'ref_s' => ['required'],
            'email' => ['unique:users','required'],
            'system_id' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
        $puid = DB::table('users')->where('system_id', '=' ,$input['ref_id'])->first();
            if(!empty($puid)){
                $puid = $puid->uid;
            }else{
                $puid = null;
            }
            
            $user =  User::create([
            
            'fname' => $input['fname'],
            'lname' => $input['lname'],
            'ref_id' => $input['ref_id'],
            'system_id'=>$input['system_id'],
            'dbType' => $input['dbType'],
            'id_number' => $input['id_number'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            ]); 
            
            
            $userid = DB::getPdo()->lastInsertId();
            $userid = (int)$userid;
            
            $vp = $puid;
            

            while(!empty($vp)){
    
            $vpid = DB::table("user__parents")
            ->select("uid")
            ->where("ref_s", "=", $input['ref_s'])
            ->where("virtual_parent", "=", $vp)
            ->get();
           
            if(!empty($vpid[0]->uid)){
                $vp = $vpid[0]->uid;
            }else{
                break;
            }
            }    
            

            DB::table('user__parents')->insert([
                'uid' => $userid,
                'parent_id' => $puid,
                'virtual_parent' => $vp,
                'ref_s' => $input['ref_s'],
            ]);

            DB::table('wallets')->insert([
                'uid' => $userid,
                'wallet_balance' => 0,
                'available_balance' => 0,
                'binary_balance' => 0,
                'package_balance' => 0,
                'direct_balance'  => 0,
            ]);

           
            return $user;
            }
          
        
        

    
}
