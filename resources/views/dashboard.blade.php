@extends('layouts.user.app')

@section('content')


<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body">
	<div class="container-fluid">
		<div class="form-head d-flex flex-wrap align-items-center">
			<h4 class="font-w600 mb-2 mr-auto d-block">Dashboard - {{ date('Y-m-d') }}</h5>

				<hr class="new">
				<div class="dash_sec_1">

					<div class="col-container">
						<div class="col">
							<div class="text-center">
								<h5>Total Earnings</h5>
								<span class="val">${{ binary_log_sum() + direct_log_sum() + package_log_sum() }}</span>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<h5>Daily Rewards</h5>
								<span class="val">${{ package_log_sum() }}</span>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<h5>Referral Rewards</h5>
								<span class="val">${{ direct_log_sum() }}</span>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<h5>B/V Rewards</h5>
								<span class="val">${{ binary_log_sum() }}</span>
							</div>
						</div>
						<div class="col">
							<div class="text-center">
								<h5>Holding Balance</h5>
								<span class="val"> - </span>
							</div>
						</div>

					</div>
				</div>
				<div class="dash_sec_2">
					<div class="col-container">
						<div class="col first_col">
							<div class="text-center">
								<h5>Total Invesments = ${{ invest() }} </h5>
								<span>Active Packages = - </span>
							</div>
						</div>
						<!-- Changed sec -->
						<div class="col">
							<div class="row">
								<div class="col-sm-3 col-6 text-center">
									<h6 class="bg_blue">LEFT BV REWARDS</h6>
								</div>
								<div class="col-sm-3 col-6 text-center">
									<h6 class="bg_blue">${{ binary_commision_left()}}</h6>
								</div>
								<div class="col-sm-3 col-6 text-center">
									<h6 class="bg_blue">RIGHT BV REWARDS</h6>
								</div>
								<div class="col-sm-3 col-6 text-center">
									<h6 class="bg_blue">${{ binary_commision_right() }}</h6>
								</div>
							</div>
							<div class="row">
								@php
								$user_package_count = user_package_count()
								@endphp
								@if ($user_package_count == 0)

								@else
								<div class="col-sm-3 col-6 text-center">
									<span style="position: absolute; z-index: -9999;"><input type="text" readonly id="copyTarget1" class="form-control" value="{{ url('/') }}/register/?ref={{ $user_data[0]->system_id }}&ref_s={{ 0 }}"></span>
									<h6 class="bg_purple">
										LEFT REFERRAL LINK
									</h6>
								</div>
								<div class="col-sm-3 col-6 text-center">
									<span id="copyButton1" onclick="clipboardClicked1()" class="bg_pink" title="Click to copy"> Copy
									</span>
									<span class="alert alert-success" id="clickedMessage-1">Copied !</span>
								</div>
								@endif

								@if ($user_package_count == 0)

								@else
								<div class="col-sm-3 col-6 text-center">
									<span style="position: absolute; z-index: -9999;"><input type="text" readonly id="copyTarget2" class="form-control" value="{{ url('/') }}/register/?ref={{ $user_data[0]->system_id }}&ref_s={{ 1 }}"></span>
									<h6 class="bg_purple"> RIGHT REFERRAL LINK
									</h6>
								</div>
								<div class="col-sm-3 col-6 text-center">
									<span id="copyButton2" onclick="clipboardClicked2()" class="bg_pink" title="Click to copy"> Copy
									</span>
									<span class="alert alert-success" id="clickedMessage-2">Copied !</span>
								</div>
								@endif
							</div>
						</div>
						<!-- Changed sec -->

						<!-- <div class="col">
							<div class="row">
								@php
								$user_package_count = user_package_count()
								@endphp
								@if ($user_package_count == 0)

								@else

								<div class="col">
									<div class="text-center">
										<h6 class="bg_blue">Left Link Count</h6>
										<span style="position: absolute; z-index: -9999;"><input type="text" readonly id="copyTarget1" class="form-control" value="{{ url('/') }}/register/?ref={{ $user_data[0]->system_id }}&ref_s={{ 0 }}"></span>
										<h6 class="bg_purple">
											LEFT REFERRAL LINK
										</h6>
									</div>
								</div>
								<div class="col">
									<div class="text-center">
										<h6 class="bg_blue"> - </h6>
										<span id="copyButton1" onclick="clipboardClicked1()" class="bg_pink" title="Click to copy"> Copy
										</span>
										<span class="alert alert-success" id="clickedMessage-1">Copied !</span>
									</div>
								</div>
								@endif
							</div>
						</div>
						<div class="col">
							<div class="row">
								@if ($user_package_count == 0)

								@else
								<div class="col">
									<div class="text-center">
										<h6 class="bg_blue">Right Link Count</h6>
										<span style="position: absolute; z-index: -9999;"><input type="text" readonly id="copyTarget2" class="form-control" value="{{ url('/') }}/register/?ref={{ $user_data[0]->system_id }}&ref_s={{ 1 }}"></span>
										<h6 class="bg_purple"> RIGHT REFERRAL LINK
										</h6>
									</div>
								</div>
								<div class="col">
									<div class="text-center">
										<h6 class="bg_blue"> - </h6>
										<span id="copyButton2" onclick="clipboardClicked2()" class="bg_pink" title="Click to copy"> Copy
										</span>
										<span class="alert alert-success" id="clickedMessage-2">Copied !</span>
									</div>
								</div>
								@endif
							</div>
						</div> -->
					</div>
				</div>

				<!-- <div class="dash_sec_3">
					<div class="row">
						<div class="col-sm-3">
							<div class="coin_card text-center">
								<img class="img img-fluid" src="" alt="">
								<h6>Gold <br> - </h6>
							</div>
						</div>

					</div>
				</div> -->

				<!-- <div class="col-xl-12 col-xxl-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="card-bx stacked card">
								<img src="images/card/card1.jpg" alt="">
								<div class="card-info">

									<div class="d-flex justify-content-between">
										<h2 class="num-text text-white mb-2 font-w600">Left Chain</h2>
									</div>
									<h3 id="">Business Volume ${{ binary_commision_left()}}</h3>
									@php
									$user_package_count = user_package_count()
									@endphp
									@if ($user_package_count == 0)

									@else
									<div class="d-flex">
										<div class="text-white">
											<span><input type="text" readonly id="copyTarget1" class="form-control" value="{{ url('/') }}/register/?ref={{ $user_data[0]->system_id }}&ref_s={{ 0 }}"></span>
											<span id="copyButton1" onclick="clipboardClicked1()" class="btn btn-outline-success float-right" title="Click to copy"> Copy Referral
												<i class="fa fa-clipboard" aria-hidden="true"></i>
											</span>
											<span class="alert alert-success" id="clickedMessage-1">Copied !</span>
										</div>
									</div>
									@endif

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card-bx stacked card">
								<img src="images/card/card2.jpg" alt="">
								<div class="card-info">

									<div class="d-flex justify-content-between">
										<h2 class="num-text text-white mb-2 font-w600">Right Chain</h2>
									</div>
									<h3 id="">Business Volume ${{ binary_commision_right() }}</h3>
									@if ($user_package_count == 0)

									@else
									<div class="d-flex">

										<div class="text-white">

											<span><input type="text" readonly id="copyTarget2" class="form-control" value="{{ url('/') }}/register/?ref={{ $user_data[0]->system_id }}&ref_s={{ 1 }}"></span>
											<span id="copyButton2" onclick="clipboardClicked2()" class="btn btn-outline-success float-right" title="Click to copy"> Copy Referral
												<i class="fa fa-clipboard" aria-hidden="true"></i>
											</span>
											<span class="alert alert-success" id="clickedMessage-2">Copied !</span>
										</div>
									</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-12 col-xxl-12">
					<div class="row">
						<div class="col-sm-6">
							<div class="card-bx stacked card t-earning">

								<div class="card-info">

									<div class="d-flex justify-content-between">
										<h2 class="num-text text-white mb-2 font-w600">Total Investments</h2>
									</div>
									<h3 id="">${{ invest() }}</h3>

								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="card-bx stacked card t-invesments">

								<div class="card-info">

									<div class="d-flex justify-content-between">
										<h2 class="num-text text-white mb-2 font-w600">Total Earnings</h2>
									</div>
									<table width="100%">
										<tr>
											<td>Daily Rewards</td>
											<td>${{ package_log_sum() }}</td>
										</tr>
										<tr>

											<td>Referral Rewards</td>
											<td>${{ direct_log_sum() }}</td>
										</tr>

										<tr>
											<td>Business Volume Rewards</td>
											<td>${{ binary_log_sum() }}</td>
										</tr>
										<tr>
											<td>Holding Balance</td>
											<td>${{ holding_log_sum() }}</td>
										</tr>

										<tr>
											<td>Total</td>
											<td>${{ binary_log_sum() + direct_log_sum() + package_log_sum() }}</td>
										</tr>


									</table>
								</div>
							</div>
						</div>
					</div>
				</div> -->



		</div>
		<div id="sample coin_sec">
			<div class="row">

				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">
							<img src="images/1.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">GOLD</h6>
							<h2 class="text-black mb-2 font-w600">
								<p class="mb-0 fs-13">
									<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g filter="url(#filter0_d2)">
											<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
										</g>
										<defs>
											<filter id="filter0_d2" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
												<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
												<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
												<feOffset dy="1"></feOffset>
												<feGaussianBlur stdDeviation="2"></feGaussianBlur>
												<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
												</feColorMatrix>
												<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
												</feBlend>
												<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
											</filter>
										</defs>
									</svg>
									<span class="text-success mr-1">45%</span>This week
								</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">
							<img src="images/2.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">BITCOIN</h6>
							<h2 class="text-black mb-2 font-w600">
								${{ number_format(Cryptocap::getSingleAsset('bitcoin')->data->priceUsd,2) }}</h2>

							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d1)">
										<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d1" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-success mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">
							<img src="images/3.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">ETH</h6>
							<h2 class="text-black mb-2 font-w600">
								${{ number_format(Cryptocap::getSingleAsset('ethereum')->data->priceUsd,2) }}</h2>
							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d4)">
										<path d="M5 4C5.91797 5.08433 8.89728 8.27228 10.5 10L16.5 7L23.5 16" stroke="#FF2E2E" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d4" x="-3.05176e-05" y="0" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 0.180392 0 0 0 0 0.180392 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-danger mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">

							<img src="images/4.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">BNB</h6>
							<h2 class="text-black mb-2 font-w600">
								- </h2>
							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d5)">
										<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d5" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-success mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">

							<img src="images/5.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">OIL</h6>
							<h2 class="text-black mb-2 font-w600">
								- </h2>
							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d5)">
										<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d5" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-success mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">

							<img src="images/6.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">NASDAQ</h6>
							<h2 class="text-black mb-2 font-w600">
								- </h2>
							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d5)">
										<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d5" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-success mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">

							<img src="images/7.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">DOW JONES</h6>
							<h2 class="text-black mb-2 font-w600">
								- </h2>
							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d5)">
										<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d5" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-success mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 m-t35">
					<div class="card card-coin mx-3">
						<div class="card-body text-center">

							<img src="images/8.png" class="mb-3 currency-icon" width="80" height="80" alt="">
							<h6 class="text-center">S&P 500</h6>
							<h2 class="text-black mb-2 font-w600">
								- </h2>
							<p class="mb-0 fs-14">
								<svg width="29" height="22" viewBox="0 0 29 22" fill="none" xmlns="http://www.w3.org/2000/svg">
									<g filter="url(#filter0_d5)">
										<path d="M5 16C5.91797 14.9157 8.89728 11.7277 10.5 10L16.5 13L23.5 4" stroke="#2BC155" stroke-width="2" stroke-linecap="round"></path>
									</g>
									<defs>
										<filter id="filter0_d5" x="-3.05176e-05" y="-6.10352e-05" width="28.5001" height="22.0001" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
											<feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
											<feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0"></feColorMatrix>
											<feOffset dy="1"></feOffset>
											<feGaussianBlur stdDeviation="2"></feGaussianBlur>
											<feColorMatrix type="matrix" values="0 0 0 0 0.172549 0 0 0 0 0.72549 0 0 0 0 0.337255 0 0 0 0.61 0">
											</feColorMatrix>
											<feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow">
											</feBlend>
											<feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow" result="shape"></feBlend>
										</filter>
									</defs>
								</svg>
								<span class="text-success mr-1">45%</span>This week
							</p>
						</div>
					</div>
				</div>
			</div>

			<!-- <div class="row">
				@php
				$events = Cryptocap::getAssets();
				$data = json_decode(json_encode($events),true);


				@endphp

				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Today's Cryptocurrency Prices by Market Cap</h5>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<div id="example4_wrapper" class="dataTables_wrapper no-footer">


									<table id="example4" class="display dataTable no-footer" style="min-width: 845px" role="grid" aria-describedby="example4_info">
										<thead>
											<tr role="row">
												<th class="sorting_asc" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 52.45px;" aria-sort="ascending" aria-label="Roll No: activate to sort column descending">#</th>
												<th class="sorting" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 102.3px;" aria-label="Student Name: activate to sort column ascending">Name
												</th>
												<th class="sorting" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 112.067px;" aria-label="Invoice number: activate to sort column ascending">Price
												</th>
												<th class="sorting" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 74.7px;" aria-label="Fees Type : activate to sort column ascending">24H %
												</th>
												<th class="sorting" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 66px;" aria-label="Status : activate to sort column ascending">Marketcap
												</th>
												<th class="sorting" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 74.7px;" aria-label="Fees Type : activate to sort column ascending">
													Volume(24h) </th>
												<th class="sorting" tabindex="0" aria-controls="example4" rowspan="1" colspan="1" style="width: 74.7px;" aria-label="Fees Type : activate to sort column ascending">
													Circulating Supply </th>
											</tr>
										</thead>
										<tbody>
											@foreach($events->data as $idx => $data)
											<tr>
												<td>{{ $data->rank }}</td>
												<td>{{ $data->symbol .'-'. $data->name }}</td>
												<td>{{ number_format($data->priceUsd,2) }}</td>
												<td>{{ $data->changePercent24Hr }}</td>
												<td>{{ number_format($data->marketCapUsd,0) }}</td>
												<td>{{ number_format($data->volumeUsd24Hr,0) }}</td>
												<td class='has-details'> <span class="details">Calcutale Supply -
														{{ number_format($data->supply,0) }}<br> Max Supply -
														{{ number_format($data->maxSupply,0) }}</span>{{ number_format($data->supply,0) }}<br><small>{{ number_format($data->maxSupply,0) }}</small>
												</td>
											</tr>
											@endforeach

										</tbody>
									</table>

								</div>
							</div>
						</div>
					</div>




				</div>
			</div> -->


		</div>
	</div>
	<!--**********************************
            Content body end
        ***********************************-->
	@endsection