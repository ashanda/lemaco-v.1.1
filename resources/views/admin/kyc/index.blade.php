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
                    <h2>Pending KYC</h2>
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
                                        <th>Status</th>
                                        
                                        <th width="280px">Action</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $kyc)
                    <tr>
                    <td>{{ $kyc->id }}</td>
                    <td>{{ $kyc->fname .' '. $kyc->lname}}</td>
                    @php
                    if ($kyc->status==0)
                    {
                        $status='Pending';
                    }else if($kyc->status==1){
                        $status='Approved';
                    }else{
                        $status='Rejected';
                    }
                    @endphp
                    <td>{{ $status }}</td>
                    
                    <td>
                    <form action="{{ route('kyc.destroy',$kyc->id) }}" method="Post">
                    <a class="btn btn-primary" href="{{ route('kyc.edit',$kyc->id) }}">View</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    </td>
                    </tr>
                    @endforeach
                                    
                                </tbody>
                               
                            </table>
                        </div>
                    </div>
                    
                
            </div>    
        </div>
            

@endsection