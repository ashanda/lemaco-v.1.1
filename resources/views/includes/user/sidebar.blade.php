<style>
	img.img-fluid.db_icon {
		max-width: 25px;
		margin-right: 10px;
		filter: invert(1);
	}
</style>
<!--**********************************
            Sidebar start
        ***********************************-->
<div id="deznav" class="deznav">
	<div class="deznav-scroll">
		<div class="main-profile">
			@if (Auth::user()->profile_pic == null)
			<img src="{{ asset('/images/user.png')}}" alt="">

			@else
			<img src="{{ url('profile/img/'.Auth::user()->profile_pic) }}" alt="">

			@endif
			<a href="/dashboard"><i class="fa fa-cog" aria-hidden="true"></i></a>
			<h5 class="mb-0 fs-20 text-black "><span class="font-w400">Hello,</span> {{ Auth::user()->fname.' '.Auth::user()->lname }}</h5>
			<p class="mb-0 fs-14 font-w400">{{ Auth::user()->email }}</p>
		</div>
		<ul class="metismenu" id="menu">
			<li><a class="has-arrow ai-icon" href="/dashboard" aria-expanded="false">
					<!-- <i class="flaticon-144-layout"></i> -->
					<img class="img-fluid db_icon" src="images/product/1.png" alt="">
					<span class="nav-text">Dashboard</span>
				</a>


			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<!-- <i class="flaticon-061-puzzle"></i> -->
					<img class="img-fluid db_icon" src="images/product/2.png" alt="">
					<span class="nav-text">Markets</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="https://www.livecoinwatch.com" target="_blank">livecoinwatch.com</a></li>
					<li><a href="https://coinmarketcap.com" target="_blank">coinmarketcap.com</a></li>
					<li><a href="https://www.coingecko.com" target="_blank">coingecko.com</a></li>
					<li><a href="https://www.cnbc.com" target="_blank">www.cnbc.com</a></li>
					<li><a href="https://www.bloomberg.com" target="_blank">www.bloomberg.com</a></li>
					<li><a href="https://bitcoinmagazine.com" target="_blank">bitcoinmagazine.com</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="/kyc" aria-expanded="false">
					<!-- <i class="flaticon-077-menu-1"></i> -->
					<img class="img-fluid db_icon" src="images/product/3.png" alt="">
					<span class="nav-text">KYC</span>
				</a>

			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<!-- <i class="flaticon-061-puzzle"></i> -->
					<img class="img-fluid db_icon" src="images/product/4.png" alt="">
					<span class="nav-text">Packages</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/active_packages">My Active Packages</a></li>
					<li><a href="/buy_package">Buy package</a></li>
				</ul>

			</li>

			<li><a class="has-arrow ai-icon" href="/genealogy" aria-expanded="false">
					<!-- <i class="flaticon-053-heart"></i> -->
					<img class="img-fluid db_icon" src="images/product/5.png" alt="">
					<span class="nav-text">Genealogy</span>
				</a>

			</li>

			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<!-- <i class="flaticon-381-settings-2"></i> -->
					<img class="img-fluid db_icon" src="images/product/6.png" alt="">
					<span class="nav-text">Wallets</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/wallet">My Wallet</a></li>
					<li><a href="/add_wallet">Add Crypto Wallet</a></li>
				</ul>

			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<!-- <i class="flaticon-381-settings-2"></i> -->
					<img class="img-fluid db_icon" src="images/product/7.png" alt="">
					<span class="nav-text">Reports</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/report_package_earn">Daily Rewards</a></li>
					<li><a href="/report_direct_earn">Referrel Earn</a></li>
					<li><a href="/report_binary_earn">Bussiness Volume Rewards</a></li>
				</ul>

			</li>

		</ul>

	</div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->