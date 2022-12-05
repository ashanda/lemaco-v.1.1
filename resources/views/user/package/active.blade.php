@extends('layouts.user.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
<div class="container mt-2">
    <div class="row">
    <div class="col-lg-12 margin-tb">
    
    
    </div>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
    <p>{{ $message }}</p>
    </div>
    @endif
    <table class="table table-bordered">
    <tr>
    <th>Index</th>
    
    <th>Package Name</th>
    
    <th>Package status</th>
    <th width="280px">Active Date</th>
    <th width="280px">Valid till</th>
    </tr>
    @php
        $i = 1;
    @endphp
    
    @foreach ($data as $package)
    <tr>
    <td>{{ $i }}</td>
    
    <td>{{ $package->package_name}}</td>
    @if ($package->status==2)
    <td>{{ 'Pending' }}</td>
    @elseif($package->status==1)
    <td>{{ 'Activate' }}</td>
    @else
    <td>{{ 'Rejected' }}</td>
    @endif
    <td>{{ $package->created_at}}</td>
    <td>
        @php
            $original_date = $package->created_at;
            $time_original = strtotime($original_date);
            $package_active_date = $package->package_duration + 6;
            $time_add      = $time_original + (3600*24*$package_active_date); //add seconds of one day
            $new_date      = date("Y-m-d H:i:s", $time_add);
            
            echo $new_date; 
        @endphp
        
    </td>
    
    
    
    </tr>
    @php
        $i++;
    @endphp
    @endforeach
    </table>
</div>
    </div>
</div>

@endsection