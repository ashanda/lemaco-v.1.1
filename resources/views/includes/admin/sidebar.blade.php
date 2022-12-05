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


			<img src="{{ url('profile/img/'.Auth::user()->profile_pic) }}" alt="">


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
					<!-- <i class="flaticon-077-menu-1"></i> -->
					<img class="img-fluid db_icon" src="images/product/2.png" alt="">
					<span class="nav-text">KYC</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/kyc">Un-approved KYCs</a></li>
					<li><a href="/kyc_all">All KYCs</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<img class="img-fluid db_icon" src="images/product/3.png" alt="">
					<!-- <i class="flaticon-061-puzzle"></i> -->
					<span class="nav-text">Packages</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/package">Create Package</a></li>
					<li><a href="/user_buy_package">Activate Packages</a></li>
				</ul>
			</li>


			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<!-- <i class="flaticon-053-heart"></i> -->
					<img class="img-fluid db_icon" src="images/product/4.png" alt="">
					<span class="nav-text">Genealogy</span>
				</a>

			</li>
			<li><a href="/package_earn" class="ai-icon" aria-expanded="false">
					<!-- <i class="flaticon-381-settings-2"></i> -->
					<img class="img-fluid db_icon" src="images/product/5.png" alt="">
					<span class="nav-text">Package Earning</span>
				</a>
			</li>
			<li><a href="javascript:void()" class="ai-icon" aria-expanded="false">
					<img class="img-fluid db_icon" src="images/product/6.png" alt="">
					<!-- <i class="flaticon-381-settings-2"></i> -->
					<span class="nav-text">Wallets</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/wallet">New withdrawels</a></li>
					<li><a href="/wallet_approved">Approved withdrawels</a></li>
					<li><a href="/wallet_rejects">Rejects withdrawels</a></li>
				</ul>
			</li>
			<li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
					<img class="img-fluid db_icon" src="images/product/7.png" alt="">
					<!-- <i class="flaticon-061-puzzle"></i> -->
					<span class="nav-text">Reports</span>
				</a>
				<ul aria-expanded="false">
					<li><a href="/report_earn">User earn</a></li>
					<li><a href="/report_earn_user">Approved Package Details</a></li>
					<li><a href="/report_kyc">Sign up but not kyc</a></li>
					<li><a href="/report_users">Users</a></li>
				</ul>
			</li>


		</ul>

	</div>
</div>
<!--**********************************
            Sidebar end
        ***********************************-->