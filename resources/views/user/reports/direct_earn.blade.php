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
                                    <th>Earn ($)</th>
                                    <th>Date</th>
                                    
                                    
                                    
                                    </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach ($data as $current_earn)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $current_earn->earn}}</td>
                    <td>{{ $current_earn->created_at}}</td>
              
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