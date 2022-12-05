<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use WisdomDiala\Cryptocap\Facades\Cryptocap;
Use Illuminate\Support\Facades\DB;

class GeneologyController extends Controller
{

    public function index()
    {
        $role=Auth::user()->role;
        if($role==1){

            return view('admin.geneology.index');
        }
        if($role==0){
            $user_id = Auth::id();
            $user_data = '<h1>hello world</h1>';
            return view('user.geneology.index',compact('user_data'));
        }
    }


}   