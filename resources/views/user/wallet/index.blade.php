@extends('layouts.user.app')

@section('content')
<!--**********************************
            Content body start
        ***********************************-->
<style>
	/* new styles */
	#example2_filter {
		display: none !important;
	}

	/* new styles */
	.content-body {
		background-image: url(../images/back.jpg);
	}

	h4.font-w600.mb-2.mr-auto.d-block {
		font-size: 1.125rem;
	}

	[data-theme-version="dark"] .header-left h3 {
		color: #000 !important;
		text-transform: uppercase;
		margin-bottom: 0;
	}

	[data-theme-version="dark"] h4 {
		text-transform: uppercase;
	}

	[data-theme-version="dark"] .nav-header {
		background-color: #0f2354;
	}

	[data-theme-version="dark"] {
		background: #ffffff;
	}

	.header {
		background-color: #fff;
		border-color: #fff;
	}

	.nav-control {
		background-color: #fff;
	}

	.main-profile {
		display: none;
	}

	hr.new {
		border: 1px solid #d1d1d1;
		width: 100%;
		margin-left: 0;
		margin-right: 0;
	}

	[data-theme-version="dark"] .deznav .metismenu>li>a {
		-webkit-box-shadow: 0px 0px 22px -3px #000000;
		box-shadow: 0px 0px 22px -3px #000000;
	}

	/* dash_sec_1 */
	.dash_sec_1 {
		color: #fff;
		width: 100%;
		background-color: #447db1;
		text-transform: uppercase;
		padding: 20px;
		text-shadow: 0px 0px 5px #000000;
	}

	.dash_sec_1 span.val {
		font-size: 22px;
		font-weight: bold;
		text-shadow: 0px 0px 5px #000000;
	}

	.dash_sec_1 .col-container,
	.dash_sec_2 .col-container {
		display: table;
		width: 100%;
	}

	.dash_sec_1 .col,
	.dash_sec_2 .col {
		display: table-cell;
		width: unset;
	}

	div#deznav {
		background-color: #0f2354;
		height: 100%;
	}

	[data-theme-version="dark"] .nav-header .hamburger .line {
		background: #000;
	}

	[data-theme-version="dark"] .nav-header {}

	[data-theme-version="dark"] .nav-control {
		background-color: #fff;
	}

	[data-theme-version="dark"] .header {
		background-color: #ffffff;
		border-color: #ffffff;
	}

	[data-theme-version="dark"] .header-right .header-profile>a.nav-link .header-info span,
	[data-theme-version="dark"] .review-table .media-body p,
	[data-theme-version="dark"] .iconbox small,
	[data-theme-version="dark"] .doctor-info-details .media-body p {
		color: #000;
	}

	.metismenu a.has-arrow.ai-icon {
		border: 1px solid #d1d1d1;
		border-radius: 10px;
		margin: 7px;
	}

	/* dash_sec_2 */
	.dash_sec_2 {
		padding: 20px 0;
		width: 100%;
		text-shadow: 0px 0px 5px #000000;
	}

	.dash_sec_2 .first_col {
		background-color: #447db1;
		text-transform: uppercase;
		padding: 10px;
	}

	.dash_sec_2 .first_col span {
		color: #fff;
	}

	.wall_sec .bg_blue,
	.dash_sec_2 .bg_blue,
	.dash_sec_2 .bg_purple,
	.dash_sec_2 .bg_pink {
		padding: 10px;
		width: 100%;
		border-radius: 10px;
		min-width: 50px;
	}

	.dash_sec_2 .bg_blue,
	.wall_sec .bg_blue {
		background-color: #447db1;
	}

	.dash_sec_2 .bg_purple {
		background-color: #373063;
	}

	.dash_sec_2 .bg_pink {
		background-color: #cb457b;
	}

	.metismenu .nav-text {
		text-transform: uppercase;
		font-size: 14px;
		color: #fff;
	}

	#copyButton1,
	#copyButton2 {
		padding: 10px;
		float: left !important;
		border-radius: 10px;
		background-color: #cb457b;
		border-color: unset;
		color: #fff;
		margin: 0;
		width: 100%;
	}

	/* dash_sec_3 */
	.dash_sec_3 .coin_card .dash_sec_3 .coin_card .img {}

	.currency-icon {
		border-radius: 0;
	}

	.coin_sec {
		max-width: 800px;
		margin: auto;
		padding: 50px;
	}

	div#sample\ coin_sec {
		padding: 50px;
	}

	[data-theme-version="dark"] .card {
		background-color: #447db1;
	}

	.card-body {
		padding: 20px;
	}

	div#deznav {
		background-image: url(../images/back.jpg);
		background-size: cover;
		background-repeat: no-repeat;
	}

	/* Wallet styles */
	.wall_sec {
		color: #fff;
	}

	.wall_sec a {
		color: #fff;
	}

	.font-w600.mb-2.mr-auto {
		display: block;
	}

	.dark_blue {
		background-color: #3b6184;
		padding: 10px;
		margin: 2px 0;
	}

	.blue {
		background-color: #447db1;
	}

	span.right {
		float: right;
	}

	.wallt {
		background-repeat: no-repeat;
		background-size: cover;
	}

	[data-theme-version="dark"] .footer .copyright p {
		color: #000;
	}

	td {
		color: #fff;
	}

	/* Mobile sizes */
	@media screen and (max-width: 576px) {

		.dash_sec_1 .col,
		.dash_sec_2 .col {
			display: block;
		}

		.col.first_col {
			margin-bottom: 20px;
		}
	}
</style>
<div class="content-body">
	<!-- New wallet sec -->

	<div class="container-fluid wallt pb-4">
		<div class="form-head mb-sm-5 mb-3 d-flex align-items-center flex-wrap">
			<h4 class="font-w600 mb-0 mr-auto mb-2">My Wallet</h4>
		</div>
		<div class="wall_sec">
			<div class="row text-center">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-12">
							<a href="/add_wallet">
								<div class="bg_blue"> Add Your Crypto Wallet Here</div>
							</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-12">
							<a href="/withdraw">
								<div class="bg_blue"> Withdrawals</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="data_sec mt-3">
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="dark_blue">
							<span class="left">Daily Rewards</span>
							<span class="right">${{ package_log_sum() }}</span>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="dark_blue">
							<span class="left">Available Rewards</span>
							@if (left_right_side_direct(Auth::user()->uid) == 0)
							<span class="right">${{ all_wallet_commision()->available_balance - all_wallet_commision()->binary_balance }}</span><span class="h4 text-red"> (Hold)</span>
							@else
							<span class="right">${{ all_wallet_commision()->available_balance }}</span>
							@endif

						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="dark_blue">
							<span class="left">Referral Rewards</span>
							<span class="right">${{ direct_log_sum()}}</span>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="dark_blue">
							<span class="left">Business Volume Rewards</span>
							<span class="right">${{ binary_log_sum() }}</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-xs-12">
						<div class="dark_blue">
							<span class="left">Total Earnings</span>
							<span class="right"> - </span>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12">
						<div class="dark_blue">
							<span class="left">Holding</span>
							<span class="right">${{ holding_log_sum() }}</span>
						</div>
					</div>
				</div>
			</div>
			<div class="text-center blue my-3 p-3">
				Transaction History
			</div>

		</div>


		<!-- <div class="row">
			<div class="col-xl-12 col-xxl-12">
				<div class="swiper-box">
					<div class="swiper-container card-swiper swiper-container-initialized swiper-container-vertical swiper-container-pointer-events swiper-container-free-mode">
						<div class="swiper-wrapper" style="transform: translate3d(0px, 0px, 0px);" id="swiper-wrapper-0a7812a3110a99a5d" aria-live="polite">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="swiper-slide" role="group" aria-label="3 / 8">
										<div class="card-bx stacked card">
											<img src="images/card/card3.jpg" alt="">
											<div class="card-info">
												<p class="mb-1 text-white fs-14">Total Rewards</p>
												<div class="d-flex justify-content-between">
													<h5 class="num-text text-white mb-5 font-w200">Total - ${{ all_wallet_commision()->wallet_balance + all_hold_wallet_commision()->wallet_balance }}</h5></br>

													<svg width="55" height="34" viewBox="0 0 55 34" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="38.0091" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
														<circle cx="17.4636" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
													</svg>
												</div>
												<div class="d-flex justify-content-between">
													@if (left_right_side_direct(Auth::user()->uid) == 0)
													<h5 class="num-text text-white mb-5 font-w200">Available - ${{ all_wallet_commision()->available_balance - all_wallet_commision()->binary_balance }}<span class="h4 text-red"> (Hold)</span> </h5>
													@else
													<h5 class="num-text text-white mb-5 font-w200">Available - ${{ all_wallet_commision()->available_balance }}</h5>
													@endif

												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="swiper-slide swiper-slide-active" role="group" aria-label="1 / 8">
										<div class="card-bx stacked card">
											<img src="images/card/card1.jpg" alt="">
											<div class="card-info">
												<p class="mb-1 text-white fs-14">Daily Rewards</p>
												<div class="d-flex justify-content-between">

													<h2 class="num-text text-white mb-5 font-w600">${{ package_log_sum() }}</h2>



													<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
														<path d="M19.2744 18.8013H16.0334V23.616H19.2744C19.9286 23.616 20.5354 23.3506 20.9613 22.9053C21.4066 22.4784 21.672 21.8726 21.672 21.1989C21.673 19.8813 20.592 18.8013 19.2744 18.8013Z" fill="white"></path>
														<path d="M18 0C8.07429 0 0 8.07429 0 18C0 27.9257 8.07429 36 18 36C27.9257 36 36 27.9247 36 18C36 8.07531 27.9247 0 18 0ZM21.6627 26.3355H19.5398V29.6722H17.3129V26.3355H16.0899V29.6722H13.8528V26.3355H9.91954V24.2414H12.0898V11.6928H9.91954V9.59863H13.8528V6.3288H16.0899V9.59863H17.3129V6.3288H19.5398V9.59863H21.4735C22.5535 9.59863 23.5491 10.044 24.2599 10.7547C24.9706 11.4655 25.416 12.4611 25.416 13.5411C25.416 15.6549 23.7477 17.3798 21.6627 17.4744C24.1077 17.4744 26.0794 19.4647 26.0794 21.9096C26.0794 24.3453 24.1087 26.3355 21.6627 26.3355Z" fill="white"></path>
														<path d="M20.7062 15.8441C21.095 15.4553 21.3316 14.9338 21.3316 14.3465C21.3316 13.1812 20.3842 12.2328 19.2178 12.2328H16.0334V16.4695H19.2178C19.7959 16.4695 20.3266 16.2226 20.7062 15.8441Z" fill="white"></path>
													</svg>
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="swiper-slide" role="group" aria-label="3 / 8">
										<div class="card-bx stacked card">
											<img src="images/card/card3.jpg" alt="">
											<div class="card-info">
												<p class="mb-1 text-white fs-14">Referrel Rewards</p>
												<div class="d-flex justify-content-between">
													<h2 class="num-text text-white mb-5 font-w600">${{ direct_log_sum()}}</h2>
													<svg width="55" height="34" viewBox="0 0 55 34" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="38.0091" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
														<circle cx="17.4636" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
													</svg>
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="swiper-slide" role="group" aria-label="4 / 8">
										<div class="card-bx stacked card">
											<img src="images/card/card4.jpg" alt="">
											<div class="card-info">
												<p class="mb-1 text-white fs-14">Business Volume Rewards</p>
												<div class="d-flex justify-content-between">

													<h2 class="num-text text-white mb-5 font-w600">${{ binary_log_sum() }} </h2>



													<svg width="55" height="34" viewBox="0 0 55 34" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="38.0091" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
														<circle cx="17.4636" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
													</svg>
												</div>

											</div>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="swiper-slide" role="group" aria-label="4 / 8">
										<div class="card-bx stacked card">
											<img src="images/card/card2.jpg" alt="">
											<div class="card-info">
												<p class="mb-1 text-white fs-14">Holding Balance</p>
												<div class="d-flex justify-content-between">

													<h2 class="num-text text-white mb-5 font-w600">${{ holding_log_sum() }} </h2>



													<svg width="55" height="34" viewBox="0 0 55 34" fill="none" xmlns="http://www.w3.org/2000/svg">
														<circle cx="38.0091" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
														<circle cx="17.4636" cy="16.7788" r="16.7788" fill="white" fill-opacity="0.67"></circle>
													</svg>
												</div>

											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

						<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
					</div>
				</div>
			</div>
		</div> -->
		<div class="table_sec">
			<div class="card">
				<div class="card-body">
					<div class="row align-items-end">
						<div class="col-xl-12 col-lg-12 col-xxl-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Transaction History</h4>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="example2" class="display table table-bordered" style="width:100%">
											<thead>
												<tr>
													<th>Amount</th>
													<th>P2P/Crypto/Buy Package</th>
													<th>Currency Type</th>
													<th>Network</th>
													<th>Wallet Address</th>
													<th>Status</th>
													<th>Update Date</th>
												</tr>
											</thead>
											<tbody>
												@php
												$data = transection();
												@endphp
												@if ($data == NULL)

												@else
												@foreach ($data as $package)
												<tr>
													<td>${{ $package->amount}}</td>
													<td>{{ $package->p2p_id  }} </td>
													<td>{{ $package->currency_type  }} </td>
													<td>{{ $package->network  }} </td>
													<td>{{ $package->wallet_address  }} </td>
													@if ($package->status == 0)
													<td>{{ 'Pending'  }} </td>
													@elseif ($package->status == 1)
													<td>{{ 'Approve'  }} </td>
													@else
													<td>{{ 'Reject'  }} </td>
													@endif


													<td>{{ $package->updated_at  }} </td>
												</tr>
												@endforeach
												@endif

											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
</div>


</div>
</div>


<!--**********************************
            Content body end
        ***********************************-->
@endsection