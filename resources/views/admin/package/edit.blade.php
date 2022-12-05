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
                    <div class="pull-left mb-2">
                        <h2>Edit Package</h2>
                        
                        

                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('package.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('package.update',$id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Category:</strong>
                            <div class="dropdown bootstrap-select form-control default-select">
                                <select class="form-control default-select" tabindex="-98" name="package_category">
                                  
                                    @if ($package[0]->package_category == 'Primary')
                                    <option value="Primary">Primary</option>
                                    <option value="Superior">Superior</option>
                                    <option value="VIP">VIP</option>
                                    
                                    @elseif ($package[0]->package_category == 'Superior')
                                    <option value="Superior">Superior</option>
                                    <option value="Primary">Primary</option>
                                    <option value="VIP">VIP</option>
                                    @else
                                    <option value="VIP">VIP</option>
                                    <option value="Superior">Superior</option>
                                    <option value="Primary">Primary</option>
                                    @endif
                                  
                                  
                                  
                              </select>
                          </div>
                            @error('status')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Name:</strong>
                            <input type="text" name="package_name" class="form-control" value="{{ $package[0]->package_name }}">
                            @error('package_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Value:</strong>
                            <input type="text" name="package_value" class="form-control" value="{{ $package[0]->package_value }}">
                            @error('package_value')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Duration:</strong>
                            <input type="text" name="package_duration" class="form-control" value="{{ $package[0]->package_duration }}">
                            @error('package_duration')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Description:</strong>
                            <textarea name="package_description" class="form-control" >
                                {{ $package[0]->package_description }}
                            </textarea>
                            @error('package_description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Image:</strong>
                            <img src="{{ url('packages/img/'.$package[0]->package_image) }}"
 style="height: 100px; width: 150px;">
            
                            <input type="file" name="package_image" class="form-control" placeholder="Package Image">
                            @error('package_image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Status:</strong>
                            <div class="dropdown bootstrap-select form-control default-select">
                                <select class="form-control default-select" tabindex="-98" name="package_status">
                                  
                                    @if ($package[0]->package_status == '0')
                                    <option value="0">Deactive</option>
                                    <option value="1">Active</option>
                                    
                                    @else
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>
                                    
                                    @endif
                                  
                                  
                                  
                              </select>
                              
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