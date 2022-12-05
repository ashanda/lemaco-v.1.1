@extends('layouts.user.app')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->

<!-- Add Project -->


<div class="row" style="margin-top: 85px;padding:20px;">

    <div class="col-xl-3 col-lg-3 col-sm-3">
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
    </div>

    <div class="col-xl-9 col-lg-9 col-sm-9">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('buy_package.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="new-arrival-product">

                        <div class="new-arrival-content text-center mt-3">

                            <ul class="star-rating">
                                <h4>Pay Package in your Wallet</h4>
                            </ul>
                            
                            
                            
                            


                           
                            <input type="hidden" name="package_cat_id" value="{{ $buy_package[0]->package_cat_id }}">
                            <input type="hidden" name="pref_id" value="{{ get_ref()->parent_id }}">
                            <input type="hidden" name="package_id" value="{{ $buy_package[0]->id  }}">
                            <input type="hidden" name="package_value" value="{{ $buy_package[0]->package_value  }}">
                            <input type="hidden" name="currency_type" value="USDT">
                            <input type="hidden" name="network" value="Wallet">
                            
                            <div class="form-group">
                                <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="basic_checkbox_1">
                                    <label class="custom-control-label" for="basic_checkbox_1"></label>
                                </div>
                            </div>
                            <span class="price">${{ $buy_package[0]->package_value+10  }}</span>
                            <div>
                                @php
                                $package_value = $buy_package[0]->package_value;
                                
                                $package_value_convert = (float)$package_value+10;
                                 if(left_right_side_direct(Auth::user()->uid) == 0){
                                    $available_balance = wallet_available_balance_sum();
                                 }else{
                                    $available_balance = wallet_available_balance_sum();
                                 }
                                @endphp
                                
                                @if ( $package_value_convert <= $available_balance)
                                <button type="submit" class="btn btn-primary ml-3">Buy Package</button>
                                
                                @else
                                <button type="submit" class="btn btn-primary" disabled>Wallet Balance is Insufficient</button>
                                
                                @endif



                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>




</div>

</div>






<!--**********************************
            Content body end
        ***********************************-->
@endsection