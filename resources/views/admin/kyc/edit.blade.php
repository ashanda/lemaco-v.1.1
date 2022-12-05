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
          <h2>View KYC</h2>
          </div>
          <div class="pull-right">
          <a class="btn btn-primary" href="{{ route('kyc.index') }}" enctype="multipart/form-data"> Back</a>
          </div>
          </div>
          </div>
          
          @if(session('status'))
          <div class="alert alert-success mb-1 mt-1">
          {{ session('status') }}
          </div>
          @endif
          <form action="{{ route('kyc.update',$id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>NIC/Passport/Driving License Number:</strong>
            <input type="text" readonly name="id_number" class="form-control" value="{{ $kyc->id_number }}">
            @error('id_number')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Date Of Birth:</strong>
            <input type="date" readonly name="dob" class="form-control" value="{{ $kyc->dob }}">
            @error('dob')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Phone Number:</strong>
            <input type="text" readonly name="phone_number" class="form-control" value="{{ $kyc->phone_number }}">
            @error('phone_number')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Whats App Number:</strong>
            <input type="text" readonly name="whatsapp_number" class="form-control" value="{{ $kyc->whatsapp_number }}">
            @error('whatsapp_number')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Street Address:</strong>
            <input type="text" readonly name="street_address" class="form-control" value="{{ $kyc->street_address }}">
            @error('street_address')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>City:</strong>
            <input type="text" readonly name="city" class="form-control" value="{{ $kyc->city }}">
            @error('city')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>District:</strong>
            <input type="text" readonly name="district" class="form-control" value="{{ $kyc->district }}">
            @error('district')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Province:</strong>
            <input type="text" readonly name="province" class="form-control" value="{{ $kyc->province }}">
            @error('province')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Country:</strong>
            <input type="text" readonly name="country" class="form-control" value="{{ $kyc->country }}">
            @error('country')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Postal Code:</strong>
            <input type="text" readonly name="postal_code" class="form-control"  value="{{ $kyc->postal_code }}">
            @error('postal_code')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Photo Front:</strong>
            <img src="{{ url('kycs/img/'.$kyc->id_front_image) }}"
 style="height: 100px; width: 150px;">
            <input type="hidden" name="id_front_image" class="form-control" value="{{ $kyc->id_front_image }}">
            
            @error('id_photo_front')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Photo Back:</strong>
            <img src="{{ url('kycs/img/'.$kyc->id_back_image) }}"
 style="height: 100px; width: 150px;">
            <input type="hidden" name="id_back_image" class="form-control" value="{{ $kyc->id_back_image }}">
            
            @error('id_photo_back')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <strong>Selfi Photo:</strong>
            <img src="{{ url('kycs/img/'.$kyc->selfie_image) }}"
 style="height: 100px; width: 150px;">
            <input type="hidden" name="selfie_photo" class="form-control" value="{{ $kyc->selfie_image }}">
            
            </div>
            <div class="form-group">
              <strong>Status:</strong>
              
              <div class="form-group">
                <div class="dropdown bootstrap-select form-control default-select">
                  <select class="form-control default-select" tabindex="-98" name="status">
                    @if ($kyc->status == '0')
                    <option value="0">Pending</option>
                    <option value="1">Approve</option>
                    <option value="2">Reject</option>
                    @elseif($kyc->status == '1')
                    <option value="1">Approve</option>
                    <option value="2">Reject</option>
                    <option value="0">Pending</option>
                    @else
                    <option value="2">Reject</option>
                    <option value="1">Approve</option>
                    <option value="0">Pending</option>
                    @endif
                    
                </select>
            </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <input type="hidden" name="uid" class="form-control" value="{{ $kyc->uid }}">
            </div>
            </div>
          <button type="submit" class="btn btn-primary ml-3">Submit</button>
          </div>
          </form>
          </div>
          </div>
        </div>


 @stop 