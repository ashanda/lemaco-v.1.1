@extends('layouts.admin.app')

@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
          <div class="container-fluid">
        <div class="container mt-2">
          <div class="row">
          <div class="col-lg-12 margin-tb">
          <div class="pull-left">
          <h2>View/Edit User Details</h2>
          </div>
          <div class="pull-right">
          <a class="btn btn-primary" href="/report_users" enctype="multipart/form-data"> Back</a>
          </div>
          </div>
          </div>
          
          @if(session('status'))
          <div class="alert alert-success mb-1 mt-1">
          {{ session('status') }}
          </div>
          @endif
        <form action="{{ route('user.update',$id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>First Name:</strong>
            <input type="text" readonly name="fname" class="form-control" value="{{ $user_data->fname }}">
            @error('fname')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Last Name:</strong>
            <input type="text" readonly name="lname" class="form-control" value="{{ $user_data->lname }}">
            @error('lname')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Email Verified at:</strong>
            <input type="datetime-local" name="verify_email" class="form-control" value="{{ $user_data->email_verified_at }}">
            @error('verify_email')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Update Password(old password Hashed):</strong>
            <input type="password"  name="password" class="form-control" value="{{ $user_data->password }} }}">
            
            @error('password')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
            
            <div class="form-group">
              <strong>Status:</strong>
              
              <div class="form-group">
                <div class="dropdown bootstrap-select form-control default-select">
                  <select class="form-control default-select" tabindex="-98" name="status">
                    @if ($user_data->status == '1')
                    <option value="1" selected >Active</option>
                    <option value="0">Banned</option>  
                    @else
                    <option value="0" selected>Banned</option>
                    <option value="1">Active</option>
                    @endif
                    
                </select>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <input type="hidden" name="uid" class="form-control" value="{{ $user_data->uid }}">
            </div>
            </div>
           
          <button type="submit" class="btn btn-primary">Change User Data</button>
          </div>
          </form>
          </div>
          </div>
        </div>


 @stop 