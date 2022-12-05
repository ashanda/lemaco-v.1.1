@extends('layouts.app')

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
    <h2>Add KYC</h2>
    </div>
    <div class="pull-right">
    <a class="btn btn-primary" href="{{ route('kyc.index') }}"> Back</a>
    </div>
    </div>
    </div>
    @if(session('status'))
    <div class="alert alert-success mb-1 mt-1">
    {{ session('status') }}
    </div>
    @endif
    <form action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>NIC/Passport/Driving License Number:</strong>
    <input type="text" name="id_number" class="form-control" placeholder="NIC/Passport/Driving License Number">
    @error('id_number')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Date Of Birth:</strong>
    <input type="date" name="dob" class="form-control" placeholder="Date Of Birth">
    @error('dob')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Phone Number:</strong>
    <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
    @error('phone_number')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Whats App Number:</strong>
    <input type="text" name="whatsapp_number" class="form-control" placeholder="Whats App Number">
    @error('whatsapp_number')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Street Address:</strong>
    <input type="text" name="street_address" class="form-control" placeholder="Street Address">
    @error('address')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>City:</strong>
    <input type="text" name="city" class="form-control" placeholder="City">
    @error('city')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>District:</strong>
    <input type="text" name="district" class="form-control" placeholder="District">
    @error('district')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Province:</strong>
    <input type="text" name="province" class="form-control" placeholder="Province">
    @error('province')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Country:</strong>
    <input type="text" name="country" class="form-control" placeholder="Country">
    @error('country')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Postal Code:</strong>
    <input type="text" name="postal_code" class="form-control" placeholder="Postal Code">
    @error('postal_code')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Photo Front:</strong>
    <input type="file" name="id_photo_front" class="form-control" placeholder="Photo front">
    @error('id_photo_front')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Photo Back:</strong>
    <input type="file" name="id_photo_back" class="form-control" placeholder="Photo Back">
    @error('id_photo_back')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <strong>Selfi Photo:</strong>
    <input type="file" name="selfie_photo" class="form-control" placeholder="Selfi">
    @error('selfi_photo')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
    @enderror
    </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
    <input type="hidden" name="uid" class="form-control" value="{{ $user_id }}">
    </div>
    </div>
    <button type="submit" class="btn btn-primary ml-3">Submit</button>
    </div>
    </form>
</div>
</div>
        </div>
    @stop