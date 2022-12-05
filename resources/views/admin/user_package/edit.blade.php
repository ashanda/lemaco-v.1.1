@extends('layouts.admin.app')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Activate Package</h2>
                        
                      
                       

                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('user_buy_package.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('user_buy_package.update',$id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Name:</strong>
                            <input type="text" name="package_name" readonly class="form-control" value="{{ $current_user_package[0]->package_name }}">
                            @error('package_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Currency Type:</strong>
                            <input type="text" name="currency_type" readonly class="form-control" value="{{ $current_user_package[0]->currency_type }}">
                            @error('currency_type')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Network:</strong>
                            <input type="text" name="network" readonly class="form-control" value="{{ $current_user_package[0]->network }}">
                            @error('network')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Paid Amount:</strong>
                            <input type="text" name="package_value" readonly class="form-control" value="$ {{ $current_user_package[0]->package_value }}">
                            @error('package_value')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Deposite Image:</strong>
                            <img src="{{ url('deposite/img/'.$current_user_package[0]->deposite_ss) }}"
 style="height: 100px; width: 150px;">
            
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Status:</strong>
                            <div class="dropdown bootstrap-select form-control default-select">
                                <select class="form-control default-select" tabindex="-98" name="package_status">
                                  
                                    @if ($current_user_package[0]->status == '0')
                                    <option value="0">Deactive</option>
                                    <option value="1">Active</option>
                                    @else
                                    
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                    <option value="2">Pending</option>
                                    @endif
                                  
                                  
                                  
                                  
                              </select>
                              
                              <input type="hidden" name="uid" value="{{ $current_user_package[0]->uid }}">
                              <input type="hidden" name="package_value" value="{{ ($current_user_package[0]->package_double_value)/2 }}">
                              <input type="hidden" name="package_cat_id" value="{{ $current_user_package[0]->packageid }}">
                              <input type="hidden" name="package_id" value="{{ $current_user_package[0]->package_id }}">
                              <input type="hidden" name="package_row_id" value="{{ $current_user_package[0]->packageid }}">
                            </div>
                            @error('status')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-primary ml-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--**********************************
            Content body end
        ***********************************-->
@endsection       