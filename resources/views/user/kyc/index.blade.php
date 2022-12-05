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
                
            <h2>Your KYC</h2>
            @php
              $get_user_kyc_count = get_user_kyc_count();
            @endphp
            </div>
            <div class="pull-right mb-2">
             @if ($data->first()==null)
             <a class="btn btn-success" href="{{ route('kyc.create') }}"> Create KYC</a>
             @else
              @if ($get_user_kyc_count >0 )
                  
              @else
              <a class="btn btn-success" href="{{ route('kyc.edit',$data[0]->id) }}"> Edit KYC</a> 
              @endif
             
             @endif  
            
            </div>
            </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
        <div>
            @if ($data->first()==null)
            
             @else
             @if ($data[0]->status==0)
                 <h3 class="btn btn-secondary d-block btn-lg">Your KYC Is Pending</h3>
             @elseif ($data[0]->status==1)
                 <h3 class="btn btn-secondary d-block btn-lg">Your KYC Is Approved</h3>
             @else
                 <h3 class="btn btn-secondary d-block btn-lg">Your KYC Is Reject</h3>
            
             @endif
             @endif 
        </div>
        </div>
            </div>
        </div>
            

@stop