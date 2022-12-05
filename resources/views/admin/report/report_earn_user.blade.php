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
                    
                    </div>
                    
                    </div>
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class="table-responsive">
                        <table id="example2" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>System ID</th>
                                    <th>Package Value</th>
                                    <th>Approved Date</th>
                                    <th>Network Eligibility</th>
                                    <th>Total Paid</th>
                                    <th>Paid for 3X</th>
                                    <th>Balance to 3X Payment</th>
                                    <th>Paid for 5X & 4X</th>
                                    <th>Balance to  5X & 4X</th>
                                    
                                    
                                    
                                    </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($data as $kyc)
                <tr>
                <td>{{ $i }}</td>
                <td>{{ $kyc->fname .' '. $kyc->lname}}</td>
                
                <td>{{ $kyc->system_id}}</td>
                <td>{{ $kyc->package_double_value/2}}</td>
                <td>{{ $kyc->updated_at}}</td>
                @php
                    $cal_pack = $kyc->package_max_revenue / ($kyc->package_double_value/2);
                @endphp
                <td>{{ $cal_pack.'X' }}</td>
                <td>{{ $kyc->total}}</td>
                @if ($kyc->package_triple_value >= $kyc->total)
                <td>{{ $kyc->total}}</td>
                <td>{{ $kyc->package_triple_value - $kyc->total}}</td>
                @else
                <td>{{ $kyc->package_triple_value}}</td>
                <td>{{ '0.00'}}</td>
                @endif
                
                @if ($kyc->package_triple_value < $kyc->total && $kyc->total <= $kyc->package_max_revenue)
                <td>{{ $kyc->total - $kyc->package_triple_value}}</td>
                <td>{{ $kyc->package_max_revenue - $kyc->total}}</td>
                @else
                <td>{{ '0.00'}}</td>   
                <td>{{ '0.00'}}</td> 
                @endif


                

                </tr>
                @php
                $i++;
                @endphp
                @endforeach
                                
                            </tbody>
                           
                        </table>
                    </div>
                </div>
            </div>    
        </div>
            

@endsection