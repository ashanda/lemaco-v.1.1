@extends('layouts.user.app')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->

<!-- Add Project -->


<div class="row" style="margin-top: 85px;padding:20px;">

    <div class="col-xl-3 col-lg-3 col-sm-3">
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
    </div>

    <div class="col-xl-9 col-lg-9 col-sm-9">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('buy_package.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="new-arrival-product">

                        <div class="new-arrival-content text-center mt-3">

                            <ul class="star-rating">
                                <h4>Pay Your Package</h4>
                            </ul>
                            <div class="form-group">
                                <label> Currency Type (select one):</label>
                                <div class="dropdown bootstrap-select form-control default-select dropup">
                                    <select class="form-control default-select" id="sel1" tabindex="-98" name="currency_type" required>
                                        <option value="click">Click to select</option>
                                        <option value="USDT">USDT</option>
                                        <option value="USDC">USDC</option>
                                        <option value="BUSD">BUSD</option>
                                        <option value="DAI">DAI</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Network (select one):</label>
                                <div class="dropdown bootstrap-select form-control default-select dropup">
                                    <select class="form-control default-select" id="sel2" tabindex="-98" name="network" required onchange="ChangeAddress()">
                                        <option value="click">Click to select</option>
                                        <option value="Tron-(TRC20)">Tron (TRC20)</option>
                                        <option value="BNB-Smart-Chain-(BEP20)">BNB Smart Chain (BEP20)</option>
                                        <option value="Ethereum-(ERC20)">Ethereum (ERC20)</option>
                                        <option value="Polygon">Polygon</option>
                                        <option value="Solana">Solana</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label> Deposit Address:</label>
                                <input type="text" name="deposit_add" id="deposit_add" readonly value="No address yet">
                                <button onclick="myFunction()">Copy</button>
                            </div>
                            <div class="form-group">
                                <strong class="Profe">Profe Screen Shot:</strong>
                                <input type="file" name="deposite_ss" class="form-control"  placeholder="Profe Screen Shot" required>
                                @error('deposite_ss')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" name="package_cat_id" value="{{ $buy_package[0]->package_cat_id }}">
                            <input type="hidden" name="pref_id" value="{{ get_ref()->parent_id }}">
                            <input type="hidden" name="package_id" value="{{ $buy_package[0]->id  }}">
                            <input type="hidden" name="package_value" value="{{ $buy_package[0]->package_value  }}">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox ml-1">
                                    <input type="checkbox" class="custom-control-input" id="basic_checkbox_1" required>
                                    <label class="custom-control-label" for="basic_checkbox_1"><a target="_blank" href="/disclaimer_notice" class="disclaimer">Disclaimer Notice</a></label>
                                </div>
                            </div>
                            
                            <span class="price">${{ $buy_package[0]->package_value+10  }}</span>
                            <span class="userMsg">{{ '(Will be charged $10 as a service charge)'  }}</span>
                           

                            <div>
                                @php
                                if(!empty($buy_package[0]->status)){
                                $package_data = $buy_package[0]->status;
                                }else{
                                $package_data = 'null';
                                }
                                @endphp
                                @if ( $package_data == '1')

                                <button type="submit" class="btn btn-primary" disabled>Already Bought</button>

                                @elseif($package_data == '2')
                                <button type="submit" class="btn btn-primary" disabled>Wait For Admin Approve</button>
                                @else
                                <button type="submit" class="btn btn-primary ml-3">Buy Package</button>
                                @endif



                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>


</div>


<script>
    // change adderss by option

    function ChangeAddress() {
        var x = document.getElementById("sel1").value;
        var y = document.getElementById("sel2").value;
        var z;
        if (x == "USDT" && y == "Tron-(TRC20)") {
            z = "TJftK2SA5X13znBu3crSDgPdcjzrG8jiV8";
        }
        if (x == "USDT" && y == "BNB-Smart-Chain-(BEP20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "USDT" && y == "Ethereum-(ERC20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "USDT" && y == "Polygon") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "USDT" && y == "Solana") {
            z = "DdJWtY4AngbHFS2zEmjvJwzrcqXEybavbxEWyYssdW4D";
        }
        if (x == "USDC" && y == "Tron-(TRC20)") {
            z = "TJftK2SA5X13znBu3crSDgPdcjzrG8jiV8";
        }
        if (x == "USDC" && y == "BNB-Smart-Chain-(BEP20)") {
            z = "No address yet";
        }
        if (x == "USDC" && y == "Ethereum-(ERC20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "USDC" && y == "Polygon") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "USDC" && y == "Solana") {
            z = "DdJWtY4AngbHFS2zEmjvJwzrcqXEybavbxEWyYssdW4D";
        }
        if (x == "BUSD" && y == "Tron-(TRC20)") {
            z = "No address yet";
        }
        if (x == "BUSD" && y == "BNB-Smart-Chain-(BEP20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "BUSD" && y == "Ethereum-(ERC20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "BUSD" && y == "Polygon") {
            z = "No address yet";
        }
        if (x == "BUSD" && y == "Solana") {
            z = "No address yet";
        }
        if (x == "DAI" && y == "Tron-(TRC20)") {
            z = "No address yet";
        }
        if (x == "DAI" && y == "BNB-Smart-Chain-(BEP20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "DAI" && y == "Ethereum-(ERC20)") {
            z = "0x024406145cee6a4c209e28cfec7faea8e1bed67f";
        }
        if (x == "DAI" && y == "Polygon") {
            z = "No address yet";
        }
        if (x == "DAI" && y == "Solana") {
            z = "No address yet";
        }
        if (x == "click" ||y == "click") {
            z = "Please select currencies";
        }
        document.getElementById("deposit_add").value = z;
    }
</script>



<!--**********************************
            Content body end
        ***********************************-->
@endsection