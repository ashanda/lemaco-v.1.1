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
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Package category</th>
                                    <th>Package name</th>
                                    <th>Last direct commision</th>
                                    <th>Last binary commision</th>
                                    <th>Last package commision</th>
                                    <th>Package earnings</th>
                                    <th>Total earn</th>
                                    <th>package Status</th>
                                    
                                    
                                    </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($data as $current_earn)
                <tr>
                <td>{{ $i }}</td>
                <td>{{ $current_earn->fname .' '. $current_earn->lname}}</td>
                <td>{{ $current_earn->cat_name}}</td>
                <td>{{ $current_earn->package_name}}</td>
                <td>{{ $current_earn->package_level_commission_at}}</td>
                <td>{{ $current_earn->package_binary_commsion_at}}</td>
                <td>{{ $current_earn->package_commission_update_at}}</td>
                <td>{{ package_earn_sum_view($current_earn->uid)}}</td>
                <td>{{ $current_earn->total}}</td>

                @php
                if ($current_earn->status==0)
                {
                    $status='Pending';
                }else if($current_earn->status==1){
                    $status='Approved';
                }else{
                    $status='Rejected';
                }
                @endphp
                <td>{{ $status }}</td>
                
                
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