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
                        <h2>Add Package</h2>
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
            <form action="{{ route('package.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Category:</strong>
                            <div class="dropdown bootstrap-select form-control default-select">
                                <select class="form-control default-select" tabindex="-98" name="package_category">
                                  @php
                                      $package_cat_get = package_cat_get();
                                  @endphp
                                    @foreach($package_cat_get as $package_cat)
                                        <option value="{{ $package_cat->cat_name }}">{{ $package_cat->cat_name }}</option>
                                    @endforeach
                                  
                              </select>
                          </div>
                            @error('package_category')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Name:</strong>
                            <input type="text" name="package_name" class="form-control" placeholder="Package Name">
                            @error('package_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Value:</strong>
                            <input type="text" name="package_value" class="form-control" placeholder="Package Value">
                            @error('package_value')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Duration:</strong>
                            <input type="text" name="package_duration" class="form-control" placeholder="Enter Valid Days">
                            @error('package_duration')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Description:</strong>
                            <textarea name="package_description" class="form-control" placeholder="Package Description">
                            </textarea>
                            @error('package_description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Package Image:</strong>
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
                                  
                                  <option value="0">Deactivate</option>
                                  <option value="1">Activate</option>
                                  
                                  
                                  
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
@endsection
