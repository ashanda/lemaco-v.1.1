@extends('layouts.user.app')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->

<!-- Add Project -->

<style>
    /* package-section Styles */
    .package-section {
        padding-left: 360px !important;
    }


    @media screen and (max-width: 1350px) {
        .package-section {
            padding-left: 290px !important;
        }
    }

    @media screen and (max-width: 1040px) {
        .package-section {
            padding-left: 120px !important;
        }
    }

    @media screen and (max-width: 785px) {
        .package-section {
            padding-left: 20px !important;
        }
    }



    /* package-section Styles */
</style>
<div class="row package-section" style="margin-top: 85px;padding:20px;">

    <div class="container mt-2">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
        @endif
   
    <div class="row">
    @foreach ( $data as $package)
    <div class="col-xl-3 col-lg-3 col-sm-4">
        <div class="card">
            <div class="card-body">

                <div class="new-arrival-product">
                    <div class="new-arrivals-img-contnent">
                        <img class="img-fluid" src="{{ asset('packages/img/'.$package->package_image) }}" alt="">
                    </div>
                    <div class="new-arrival-content text-center mt-3">
                        <h4><a href="ecom-product-detail.html">{{ $package->package_name  }}</a></h4>
                        <ul class="star-rating">
                            <span class="pkg_duration">Validity Period : {{ $package->package_duration }} Days</span>
                            <span class="pkg_desc">{{ $package->package_description }}</span>
                        </ul>

                        
                        <span class="price">${{ $package->package_value }}</span>
                        <span class="userMsg">{{ ' (Will be charged $10 as a service charge)' }}</span>
                        
                        <h3>Buy Package</h3>

                        <input type="hidden" name="package_id" value="{{ $package->id  }}">
                        <input type="hidden" name="package_value" value="{{ $package->package_value  }}">
                        <input type="hidden" name="pref_id" value="{{ get_ref()->parent_id }}">
                        <input type="hidden" name="pref_side" value="{{ get_ref()->ref_s }}">
                        <div>
                            
                            
                            @if (user_package_count() == 0)
                            <a class="btn btn-primary ml-3" href="buy_package/{{ $package->id }}/progress" role="button">Using Crypto</a>
                            @else
                            <a class="btn btn-primary ml-3 mb-2" href="buy_package/{{ $package->id }}/progress" role="button">Using Crypto</a>
                            <a class="btn btn-primary ml-3" href="buy_package/{{ $package->id }}/wallet_buy" role="button">Using Wallet</a>
                            @endif

                            













                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    @endforeach





</div>




</div>
</div>

<!--**********************************
            Content body end
        ***********************************-->
@endsection