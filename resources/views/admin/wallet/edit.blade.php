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
                        <h2>Withdraw Approve</h2>
                        
                        

                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('wallet.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session('status') }}
            </div>
            @endif
            <form action="{{ route('wallet.update',$id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>User Name:</strong>
                            <input type="text" name="user_name" class="form-control" value="{{ Auth::user($withdraw->uid)->fname .' '. Auth::user($withdraw->uid)->lname }}">
                            @error('user_name')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Withdraw request amount:</strong>
                            <input type="text" class="form-control"  name="amount" value="{{ $withdraw->amount }}">
                            
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Tranfer fee:</strong>
                            <input type="text"  class="form-control" value="${{ $withdraw->fee  }}">
                           
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Tranfer Amount:</strong>
                            <input type="text" class="form-control" value="{{$withdraw->amount - $withdraw->fee }}">
                            @error('amount')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @if ($withdraw->p2p_id == NULL)
                    
                    @else
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>P2P ID :</strong>
                            <input type="text" name="p2p_id" class="form-control" value="{{ $withdraw->p2p_id  }}">
                            @error('p2p_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif
                    @if ($withdraw->currency_type == NULL)
                        
                    @else
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Currency Type:</strong>
                            <input type="text" name="p2p_id" class="form-control" value="{{$withdraw->currency_type  }}">
                            @error('p2p_id')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Network:</strong>
                            <input type="text" name="network" class="form-control" value="{{ $withdraw->network  }}">
                            @error('network')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Wallet Address:</strong>
                            <input type="text" name="wallet_address" class="form-control" value="{{ $withdraw->wallet_address  }}">
                            @error('wallet_address')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif
                    
                    
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Withdraw Status:</strong>
                            <div class="dropdown bootstrap-select form-control default-select">
                                <select class="form-control default-select" tabindex="-98" name="package_status">
                                  
                                    @if ($withdraw->status == '0')
                                    <option value="0">Pending</option>
                                    <option value="1">Approve</option>
                                    <option value="2">Reject</option>
                                    
                                    @elseif ($withdraw->status == '2')
                                    <option value="2">Reject</option>
                                    <option value="1">Approve</option>
                                    <option value="0">Pending</option>
                                    @else
                                    <option value="1">Approve</option>
                                    <option value="0">Pending</option>
                                    <option value="2">Reject</option>
                                    
                                    @endif
                                  
                                  
                                  
                              </select>
                          </div>
                            @error('status')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <input type="hidden" value="{{ $withdraw->uid }}" name="uid"> 
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