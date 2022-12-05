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
                @if(!empty($successMsg))
                <div class="alert alert-success"> {{ $successMsg }}</div>
                @endif
                  <div class="table-responsive">
                      <table id="example2" class="display" style="width:100%">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Package commission</th>
                                  <th>Date and time</th>
                            
                                  
                                  
                                  </tr>
                          </thead>
                          <tbody>
                            @php
                            $i=1;
                            $sum=0;
                            @endphp
                            @foreach (get_package_commission_list() as $current_earn)
            <tr>
            <td>{{ $i }}</td>
            <td>{{ $current_earn->fname .' '. $current_earn->lname}}</td>
            <td>{{ $current_earn->package_commission }}</td>
            <td>{{ $current_earn->updated_at }}</td>
            

            
            
            
            
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


</div>
@endsection




