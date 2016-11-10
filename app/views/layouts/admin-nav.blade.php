<!-- Header -->
<div id="mws-header" class="clearfix">

	<!-- Logo Container -->
	<div id="mws-logo-container">

		<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
		<div id="mws-logo-wrap">
			{{ HTML::image('packages/images/logo.png', 'Logo') }}
		</div>
	</div>

	<!-- User Tools (notifications, logout, profile, change password) -->
	<div id="mws-user-tools" class="clearfix">

		<!-- Notifications -->
		<!--<div id="mws-user-notif" class="mws-dropdown-menu">
			<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger"><i class="icon-exclamation-sign"></i></a>

			<!-- Unread notification count -->
			<!--<span class="mws-dropdown-notif">35</span>

			<!-- Notifications dropdown -->
			<!--<div class="mws-dropdown-box">
				<div class="mws-dropdown-content">
					<ul class="mws-notifications">
						<li class="read">
							<a href="#"> <span class="message"> Lorem ipsum dolor sit amet consectetur adipiscing elit, et al commore </span> <span class="time"> January 21, 2012 </span> </a>
						</li>
						<li class="unread">
							<a href="#"> <span class="message"> Lorem ipsum dolor sit amet </span> <span class="time"> January 21, 2012 </span> </a>
						</li>

					</ul>
					<div class="mws-dropdown-viewall">
						<a href="#">View All Notifications</a>
					</div>
				</div>
			</div>
		</div>-->

		<!-- User Information and functions section -->
		<div id="mws-user-info" class="mws-inset">

			<!-- User Photo -->
			<div id="mws-user-photo">
				{{ HTML::image('packages/images/profile.png', 'User photo') }}
			</div>

			<!-- Username and Functions -->
			<div id="mws-user-functions">
				<div id="mws-username">
					Hello, {{ ucwords(Auth::user()->first_name) }}
				</div>
				<ul>
					<!--<li><a href="#">Profile</a></li>
					<li><a href="#">Change Password</a></li>-->
					<li>
						<a href="{{ URL::to('admin/logout') }}">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Start Main Wrapper -->
<div id="mws-wrapper">

	<!-- Necessary markup, do not remove -->
	<div id="mws-sidebar-stitch"></div>
	<div id="mws-sidebar-bg"></div>

	<!-- Sidebar Wrapper -->
	<div id="mws-sidebar">

		<!-- Hidden Nav Collapse Button -->
		<div id="mws-nav-collapse">
			<span></span>
			<span></span>
			<span></span>
		</div>

		<!-- Searchbox -->
		<div id="mws-searchbox" class="mws-inset">
		<form action="#">
		<input type="text" class="mws-search-input" placeholder="Search...">
		<button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
		</form>
		</div>
		<?php $routeaction =  Route::currentRouteAction(); ?>
		<!-- Main Navigation -->
		<div id="mws-navigation">
			<ul>
				<!--<li class="{{ $routeaction == 'AdminController@getDashboard' ? 'active' : '' }}">
					<a href="{{ URL::to('admin/dashboard') }}"><i class="icon-home"></i> Dashboard</a>
				</li>

				<li class="{{ $routeaction == 'AdminController@getListorders' ? 'active' : '' }}">
					<a href="#"><i class="icon-list"></i> Orders Management</a>
					<ul>
						<li>
							<a href="{{ URL::to('admin/listorders') }}">Orders</a>
						</li>

					</ul>
				</li>
				<li class="{{ $routeaction == 'AdminController@getAddcard' || $routeaction == 'AdminController@getListcards' ? 'active' : '' }}">
					<a href="#"><i class="icon-list"></i> Cards Management</a>
					<ul>
						<li>
							<a href="{{ URL::to('admin/addcard') }}">Add Card</a>
						</li>
						<li>
							<a href="{{ URL::to('admin/listcards') }}">List Cards</a>
						</li>
					</ul>
				</li>
				<li class="{{ $routeaction == 'AdminController@getAddpackage' || $routeaction == 'AdminController@getListpackages' ? 'active' : '' }}">
					<a href="#"><i class="icon-list"></i> Packages Management</a>
					<ul>
						<li>
							<a href="{{ URL::to('admin/addpackage') }}">Add Package</a>
						</li>
						<li>
							<a href="{{ URL::to('admin/listpackages') }}">List Packages</a>
						</li>
					</ul>
				</li>
				<li class="{{ $routeaction == 'AdminController@getListriskairports' ? 'active' : '' }}">
					<a href="#"><i class="icon-list"></i> Airport Risk Management</a>
					<ul>
						<li>
							<a href="{{ URL::to('admin/listriskairports') }}">List Risk Airports</a>
						</li>
					</ul>
				</li>-->
				<li>
					<a href="#"><i class="icon-list"></i> Smart-Tracking App</a>
					<ul>
						
							
							<li class="{{ $routeaction == 'AdminController@getAddcard' ? 'active':''}}"><a href="{{ URL::to('admin/addcard') }}">Card Updater</a></li>
							<li class="{{ $routeaction == 'AdminController@getListcards' ? 'active':''}}"><a href="{{ URL::to('admin/listcards') }}">List Cards</a></li>
							<li class="{{ $routeaction == 'AdminController@getListpackages' ? 'active':''}}"><a href="{{ URL::to('admin/listpackages') }}">List Packages</a></li>
							<li class="{{ $routeaction == 'AdminController@getListriskairports' ? 'active':''}}"><a href="{{ URL::to('admin/listriskairports') }}">List Risk Airports</a></li>
						
					</ul>
				</li>
				<li >
					<a href="#"><i class="icon-list"></i> Wrapping App</a>
					<ul>
						<li class="{{ $routeaction == 'AdminController@getAddterm' ? 'active':''}}"><a href="{{ URL::to('admin/addterm') }}">Add Term</a></li>
						<li class="{{ $routeaction == 'AdminController@getTerms' ? 'active':''}}"><a href="{{ URL::to('admin/terms') }}">List Terms</a></li>
						<li class="{{ $routeaction == 'AdminController@getAddproduct' ? 'active':''}}"><a href="{{ URL::to('admin/addproduct') }}">Add Product</a></li>
						<li class="{{ $routeaction == 'AdminController@getProducts' ? 'active':''}}"><a href="{{ URL::to('admin/products') }}">List Products</a></li>
						<li class="{{ $routeaction == 'AdminController@getPaymentcontrol' ? 'active':''}}"><a href="{{ URL::to('admin/paymentcontrol') }}">Payment Controller</a></li>
						
					</ul>
				</li>
			</ul>
			</ul>
		</div>
	</div>

