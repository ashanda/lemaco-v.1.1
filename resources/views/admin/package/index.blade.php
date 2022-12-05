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
            <h2>Create Package</h2>
            </div>
            <div class="pull-right mb-2">
            <a class="btn btn-success" href="{{ route('package.create') }}"> Create Package</a>
            </div>
            </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered">
            <tr>
            <th>S.No</th>
            <th>Package Category</th>
            <th>Package Name</th>
            <th>Package Value($)</th>
            <th>Package Duration(Days)</th>
            
            <th>Package status</th>
            <th width="280px">Action</th>
            </tr>
            @foreach ($data as $package)
            <tr>
            <td>{{ $package->id }}</td>
            <td>{{ $package->package_category }}</td>
            <td>{{ $package->package_name }}</td>
            <td>{{ $package->package_value }}</td>
            <td>{{ $package->package_duration }}</td>
           
            @if ($package->package_status==0)
            <td>{{ 'Deactivate' }}</td>
            @else
            <td>{{ 'Activate' }}</td>
            @endif
            
            <td>
            <form action="{{ route('package.destroy',$package->id) }}" method="Post">
            <a class="btn btn-primary" href="{{ route('package.edit',$package->id) }}">Edit</a>
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            </td>
            </tr>
            @endforeach
            </table>
        </div>
            </div>
        </div>

 @endsection