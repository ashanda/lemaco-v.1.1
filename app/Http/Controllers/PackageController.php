<?php

namespace App\Http\Controllers;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class PackageController extends Controller
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
                return view('user.package.index',compact('data'));
            }
        }


        
        /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
        public function create()
        {
            if(Auth::user()->role==1){
                return view('admin.package.create');
            }
      
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
        'package_name' => 'required',
        'package_value' => 'required',
        'package_category' => 'required',
        'package_duration' => 'required',
        'package_description' => 'required',
        'package_image' => 'required',
        'package_status' => 'required',
        ]);
        $package = new Package();
        $package->package_name = $request->package_name;
        $package->package_value = $request->package_value;
        $package->package_category = $request->package_category;
        $package->package_duration = $request->package_duration;
        $package->package_description = $request->package_description;
        ;
        if($request->file('package_image')){
            $file= $request->file('package_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/packages/img'), $filename);
            $package->package_image = $filename;
        }
        
        $package->package_status = $request->package_status;
        $package->save();
        Alert::Alert('Success', 'Package has been created successfully.')->persistent(true,false);
        return redirect()->route('package.index');
        }
        /**
        * Display the specified resource.
        *
        * @param  \App\package  $package
        * @return \Illuminate\Http\Response
        */
        public function show(Package $package)
        {
        return view('admin.package.show',compact('package'));
        } 
        /**
        * Show the form for editing the specified resource.
        *
        * @param  \App\Company  $package
        * @return \Illuminate\Http\Response
        */
        public function edit(Request $package,$id)
        {
            $role=Auth::user()->role;
            if($role==1){
                $package = DB::table('packages')->where('id', $id)->get(); ;
                return view('admin.package.edit',compact('package','id'));
            }
            
        }
        /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  \App\package  $package
        * @return \Illuminate\Http\Response
        */
        public function update(Request $request, $id)
        {
        $request->validate([
            'package_name' => 'required',
            'package_value' => 'required',
            'package_category' => 'required',
            'package_duration' => 'required',
            'package_description' => 'required',
            'package_status' => 'required',
        ]);
        $package = Package::find($id);
        $package->package_name = $request->package_name;
        $package->package_value = $request->package_value;
        $package->package_category = $request->package_category;
        $package->package_duration = $request->package_duration;
        $package->package_description = $request->package_description;
        ;
        if($request->file('package_image')){
            $file= $request->file('package_image');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('/packages/img'), $filename);
            $package->package_image = $filename;
        }
        
        $package->package_status = $request->package_status;
        $package->save();
        Alert::Alert('Success', 'Package has been updated successfully.')->persistent(true,false);
        return redirect()->route('package.index');
        }
        
        public function destroy(Package $package)
        {
        $package->delete();
        Alert::Alert('Success', 'Package has been deleted successfully.')->persistent(true,false);
        return redirect()->route('package.index');
        }

        

        

 }
    

