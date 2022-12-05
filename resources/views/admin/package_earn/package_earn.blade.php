@extends('layouts.admin.app')
@section('content')
   <!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<div class="container-fluid">
         <div class="container mt-2">
            <div class="container mt-4">
                @if(!empty($successMsg))
                <div class="alert alert-danger"> {{ $successMsg }}</div>
                @endif
                <!-- Modal HTML -->
                    <div id="myModal" class="modal fade">
                        <div class="modal-dialog modal-confirm">
                            <div class="modal-content">
                                <div class="modal-header flex-column">
                                    <div class="icon-box">
                                        
                                    </div>						
                                    <h4 class="modal-title w-100">Are you sure?</h4>	
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Do you really want to tranfer the package commissions ?</p>
                                </div>
                                <form name="add-blog-post-form" id="add-blog-post-form" enctype="multipart/form-data" method="POST" action="{{url('package_earn_tranfer')}}">
                                    @csrf
                                    <div class="col-xs-6 col-sm-6 col-md-6">
                                        <div class="form-group">
                                        @php
                                           $sum=0; 
                                        @endphp
                                        @foreach (package_earn_satisfy() as $current_earn)
                                         @php
                                            $sum+= $current_earn->package_double_value/2;
                                         @endphp
                                        @endforeach
                                  
                                        <input type="hidden" id="input2" min="1" id="profit" name="profit" class="form-control" >
                                        <input type="hidden"  id="total_invest" name="total_invest" class="form-control" value="{{ $sum }}">
                                        @error('profit')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                        
                                        
                                        </div>
                                        </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="submit" class="btn btn-primary">Tranfer Package Commission</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    
                                </div>
                            </form>
                            </div>
                        </div>
                    </div> 
                  
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="form-group">
                            <strong>Enter Profit:</strong>
                            <input type="number" id="input1" min="1" id="profit" name="profit" class="form-control" value="">
                            

                            
                        </div>
                    </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                               
                                <a href="#myModal" class="btn btn-primary" id="aButton" data-toggle="modal">Click to Open Confirm Modal</a>

                                
                            </div>
                        </div>

                     
                   
                  
                    

        </div>
    </div>
</div>
</div>
</div>
@endsection