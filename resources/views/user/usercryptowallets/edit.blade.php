@extends('layouts.user.app')
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
                    <h2>Edit Company</h2>
                    </div>
                    <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('add_wallet.index') }}" enctype="multipart/form-data"> Back</a>
                    </div>
                    </div>
                    </div>
                    @if(session('status'))
                    <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                    </div>
                    @endif
                    
                    <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Currency Type:</strong>
                        <div class="form-group">
                            <label> Currency Type (select one):</label>
                            <div class="dropdown bootstrap-select form-control default-select dropup">
                                <select class="form-control default-select" id="sel1" tabindex="-98" name="currency_type" required>
                                <option>USDT</option>
                                <option>USDC</option>
                                <option>BUSD</option>
                                <option>DAI</option>
                            </select>
                            </div>
                        </div>
                        @error('currency_type')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Network:</strong>
                        <div class="dropdown bootstrap-select form-control default-select dropup">
                            <select class="form-control default-select" id="sel1" tabindex="-98" name="network" required>
                            <option>Tron (TRC20)</option>
                            <option>BNB Smart Chain (BEP20)</option>
                            <option>Ethereum (ERC20)</option>
                            <option>Polygon</option>
                        </select>
                        </div>
                        @error('network')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                        <strong>Wallet Address:</strong>
                        <input type="text" name="wallet_address" class="form-control" value="{{ $usercryptowallet->wallet_address }}">
                        @error('wallet_address')
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

@endsection        