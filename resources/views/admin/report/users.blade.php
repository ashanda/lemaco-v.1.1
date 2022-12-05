@extends('layouts.admin.app')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="table-responsive">
                <table id="example2" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.ID</th>
                            <th>S.No</th>
                            <th>ID Number</th>  
                            <th>NIC/PP/DL</th> 
                            <th>Name</th>
                            <th>R.Date</th>
                            <th>Phone</th>
                            <th>email</th>
                            <th>Side</th>
                            <th>Sponser Name</th>
                            <th>Sponser ID</th>
                            <th>Sponser phone</th>
                            <th>Package status</th>
                            <th width="280px">Action</th>

                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($data as $kyc)
                        <tr>
                            <td>{{ $kyc->uid }}</td>
                            <td>{{ $kyc->system_id }}</td>
                            <td>{{ $kyc->id_number }}</td>
                            <td>{{ $kyc->dbType }}</td>
                            <td>{{ $kyc->fname .' '. $kyc->lname}}</td>
                            <td>{{ $kyc->register}}</td>
                            @if ($kyc->phone_number == null)
                            <td><span class="badge light badge-danger">{{ 'Kyc Not Submit' }}</span></td>
                            @else
                            <td>{{ $kyc->phone_number }}</td>
                            @endif
                            <td>{{ $kyc->email }}</td> 
                            @php
                            $get_parent = get_parent_name_email($kyc->parent_id);
                            @endphp
                             @php
                            $get_my_side = get_my_side($kyc->uid);
                            @endphp
                            @if ($get_my_side->ref_s == 0)
                            <td>{{ 'Left Side' }}</td>
                            @elseif($get_my_side->ref_s == 1)
                            <td>{{ 'Right Side' }}</td>
                            @else
                            <td><span class="badge light badge-danger">{{ 'No Side' }}</span></td
                            @endif
                            
                            @if ($get_parent==null)
                            <td>{{ 'No Parent name' }}</td>
                            <td><span class="badge light badge-danger">{{ 'Kyc Not Submit' }}</span></td>
                            @else
                            <td>{{ $get_parent->fname .' '.$get_parent->lname }}</td>
                            <td>{{ $get_parent->system_id }}</td>
                            @if ($get_parent->phone_number == null)
                            <td><span class="badge light badge-danger">{{ 'Kyc Not Submit' }}</span></td>
                            @else
                            <td>{{ $get_parent->phone_number}}</td>
                            @endif

                            @endif



                            @if ($kyc->status==0)
                            <td><span class="badge light badge-danger">{{ 'Banned' }}</span></td>
                            @else
                            <td><span class="badge badge-warning">{{ 'Activate' }}</span></td>
                            @endif
                            <td>
                                <a class="btn btn-primary" href="{{ route('user.edit',$kyc->uid) }}">View</a>
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