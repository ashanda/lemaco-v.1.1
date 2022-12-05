@extends('layouts.user.app')

@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
          <div class="container-fluid">
            <div class="row ">
              <div class="col-lg-12 margin-tb">
                  <div class="pull-left">
                  <h2>Edit KYC</h2>
                  </div>
                  <div class="pull-right mb-2">
                      <a class="btn btn-primary" href="{{ route('kyc.index') }}"> Back</a>
                     
                  
                  </div>
                  </div>
                  
              
                  @if(session('status'))
          <div class="alert alert-success mb-1 mt-1">
          {{ session('status') }}
          </div>
          @endif
          <form action="{{ route('kyc.update',$id) }}" id="msform" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
                      
                          <!-- progressbar -->
                          <ul id="progressbar">
                              <li class="active" id="account"><strong>Document</strong></li>
                              <li id="personal"><strong>Personal</strong></li>
                              <li id="payment"><strong>Image</strong></li>
                              <li id="confirm"><strong>Finish</strong></li>
                          </ul>
                          <div class="progress">
                              <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                          </div> <br> <!-- fieldsets -->
                          <fieldset>
                              <div class="form-card">
                                  <div class="row">
                                      <div class="col-7">
                                          <h2 class="fs-title">Choose Your Document:</h2>
                                      </div>
                                      <div class="col-5">
                                          <h2 class="steps">Step 1 - 4</h2>
                                      </div>
                                  </div> 
                                
                                  <label for="db">Choose type</label>
                                      <select name="dbType" id="dbType">
                                        @if ($kyc[0]->dbType=="nic")
                                        <option value="nic">NIC</option>
                                        <option value="passport">Passport</option>
                                        <option value="driving">Driving License</option>
                                        @elseif($kyc[0]->dbType=="passport")
                                        <option value="passport">Passport</option>
                                        <option value="nic">NIC</option>
                                        <option value="driving">Driving License</option>
                                        @else
                                        <option value="driving">Driving License</option>
                                        <option value="nic">NIC</option>
                                        <option value="passport">Passport</option>
                                        @endif
                                      </select>
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="form-group" id="otherType" style="display:none;">
                                      
                                    <input type="text" name="id_number" readonly class="form-control" value="{{ $kyc[0]->id_number }}">
                                      @error('id_number')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  
                                      </div>
                              </div> 
                              <input type="button" name="next" class="next action-button" value="Next" />
                          </fieldset>
                          <fieldset>
                              <div class="form-card">
                                  <div class="row">
                                      <div class="col-7">
                                          <h2 class="fs-title">Personal Information:</h2>
                                      </div>
                                      <div class="col-5">
                                          <h2 class="steps">Step 2 - 4</h2>
                                      </div>
                                  </div> 
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Date Of Birth:</strong>
                                    <input type="date" name="dob" class="form-control" value="{{ $kyc[0]->dob }}">
                                    @error('dob')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Phone Number:</strong>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $kyc[0]->phone_number }}">
                                    @error('phone_number')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Whats App Number:</strong>
                                    <input type="text" name="whatsapp_number" class="form-control" value="{{ $kyc[0]->whatsapp_number }}">
                                    @error('whatsapp_number')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Street Address:</strong>
                                    <input type="text" name="street_address" class="form-control" value="{{ $kyc[0]->street_address }}">
                                    @error('street_address')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>City:</strong>
                                    <input type="text" name="city" class="form-control" value="{{ $kyc[0]->city }}">
                                    @error('city')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>District:</strong>
                                    <input type="text" name="district" class="form-control" value="{{ $kyc[0]->district }}">
                                    @error('district')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Province:</strong>
                                    <input type="text" name="province" class="form-control" value="{{ $kyc[0]->province }}">
                                    @error('province')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Country:</strong>
                                    <input type="text" name="country" class="form-control" value="{{ $kyc[0]->country }}">
                                    @error('country')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                    <strong>Postal Code:</strong>
                                    <input type="text" name="postal_code" class="form-control"  value="{{ $kyc[0]->postal_code }}">
                                    @error('postal_code')
                                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    </div>
                              </div> <input type="button" name="next" class="next action-button " value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                          </fieldset>
                          <fieldset>
                              <div class="form-card">
                                  <div class="row">
                                      <div class="col-7">
                                          <h2 class="fs-title">Image Upload:</h2>
                                      </div>
                                      <div class="col-5">
                                          <h2 class="steps">Step 3 - 4</h2>
                                      </div>
                                  </div> 
                                  <div class="col-xs-12 col-sm-12 col-md-12">
                                      <div class="form-group">
                                      <strong>Photo Front:</strong>
                                      <img src="{{ asset('kycs/img/'.$kyc[0]->id_front_image) }}" alt="" width="100" height="100">
                                      <input type="file" name="id_photo_front" class="form-control" placeholder="Photo Back">
                                      
                                      @error('id_photo_front')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                      </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-12" id="pass" style="display:none;">
                                      <div class="form-group">
                                      <strong>Photo Back:</strong>
                                      <img src="{{ asset('kycs/img/'.$kyc[0]->id_back_image) }}" alt="" width="100" height="100">
                                      <input type="file" name="id_photo_back" class="form-control" placeholder="Photo Back">
                                      @error('id_photo_back')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                      </div>
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                      <div class="form-group">
                                      <strong>Selfi Photo:</strong>
                                      <img src="{{ asset('kycs/img/'.$kyc[0]->selfie_image) }}" alt="" width="100" height="100">
                                      <input type="file" name="selfie_photo" class="form-control" placeholder="Selfi">                                      @error('selfi_photo')
                                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                      @enderror
                                      </div>
                                      <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                        <input type="hidden" name="uid" class="form-control" value="{{ $kyc[0]->uid }}">
                                        <input type="hidden" name="status" class="form-control" value="0">
                                        </div>
                                        </div>
                                      </div>
                              </div> <input type="submit" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                          </fieldset>
                          <fieldset>
                              <div class="form-card">
                                  <div class="row">
                                      <div class="col-7">
                                          <h2 class="fs-title">Finish:</h2>
                                      </div>
                                      <div class="col-5">
                                          <h2 class="steps">Step 4 - 4</h2>
                                      </div>
                                  </div> <br><br>
                                  <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                  <div class="row justify-content-center">
                                      <div class="col-3"> <img src="{{ asset('/images/GwStPmg.png')}}" class="fit-image"> </div>
                                  </div> <br><br>
                                  <div class="row justify-content-center">
                                      <div class="col-7 text-center">
                                          <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                      </div>
                                  </div>
                              </div>
                          </fieldset>
                      </form>
                 
             
          </div>   
        
          </div>
        </div>


 @stop 