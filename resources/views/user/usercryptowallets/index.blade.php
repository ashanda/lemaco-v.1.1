@extends('layouts.user.app')
@section('content')
<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
    <div class="container-fluid">
        <div class="container mt-2 overflow-auto">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">

                    </div>
                    <div class="mb-2">
                        @php
                        $get_user_wallets_count = get_user_wallets_count();
                        @endphp
                        @if ($get_user_wallets_count < 3) <a class="btn btn-success" href="{{ route('add_wallet.create') }}"> Added New wallet</a>
                            @endif

                    </div>
                </div>
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered">
                <tr>
                    <th>S.No</th>
                    <th>Currency Type</th>
                    <th>Network</th>
                    <th>Wallet Address</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($usercryptowallets as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->currency_type }}</td>
                    <td>{{ $company->network }}</td>
                    <td>{{ $company->wallet_address }}</td>

                    <td>
                        <form action="{{ route('add_wallet.destroy',$company->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('add_wallet.edit',$company->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


@endsection