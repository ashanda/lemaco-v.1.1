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
            
            
            </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif             
            <div class="table-responsive">
                <table id="example2" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>User System id</th>
                            <th>User Name</th>
                            <th>Package Name</th>
                            <th>Type</th>
                            <th>Created at</th>
                            <th>Package status</th>
                            <th width="280px">Action</th>
                        </tr>
                           
                    </thead>
                    <tbody>
                        @foreach ($data as $package)
            <tr>
            
            <td>{{ $package->system_id}}</td>
            <td>{{ $package->fname ." ".$package->lname}}</td>
            <td>{{ $package->package_name}}</td>
            <td>{{ $package->created_at}}</td>
            @if(($package->package_max_revenue)/($package->package_double_value/2)==5)
            <td>{{ 'First' }}</td>
            @elseif(($package->package_max_revenue)/($package->package_double_value/2)==4)
            <td>{{ 'Top up' }}</td>
            @else
            <td>{{ 'Admin Assign' }}</td>
            @endif
            @if ($package->status==2)
            <td>{{ 'Pending' }}</td>
            @elseif($package->status==1)
            <td>{{ 'Activate' }}</td>
            @else
            <td>{{ 'Rejected' }}</td>
            @endif
            <td>
                
                <a class="btn btn-primary" href="{{ route('user_buy_package.edit',$package->id) }}">View</a>
                <a href="#myModal" class="btn btn-danger" id="aButton" data-toggle="modal">Delete</a>
                
            </td>
            <!-- Modal HTML -->
            <div id="myModal" class="modal fade">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-header flex-column">
                            <div class="icon-box">
                                
                            </div>						
                            <h4 class="modal-title w-100">Are you sure?</h4>	
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <p>Do you really want to delete this package ?</p>
                        </div>
                        <form action="{{ route('user_buy_package.destroy',$package->id) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer justify-content-center">
                            <button type="submit" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            
                        </div>
                     
                  </form>
                    </div>
                </div>
            </div>
            
            
            </tr>
           
            @endforeach
                        
                    </tbody>
                   
                </table>
            </div>
            
        </div>
            </div>
        </div>

 @endsection