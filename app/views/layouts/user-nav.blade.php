<!-- Header -->
<div id="mws-header" class="clearfix">

	<!-- Logo Container -->
	<div id="mws-logo-container">

		<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
		<div id="mws-logo-wrap">
			{{ HTML::image('minisite/img/logo.png', 'Logo') }}
		</div>
	</div>
	
	<!-- User Tools (notifications, logout, profile, change password) -->
	<div id="mws-user-tools" class="clearfix">
		
		

		<!-- User Information and functions section -->
		<!--<div id="mws-user-info" class="mws-inset">

		
			
			<div id="mws-user-functions">
				
				<ul>
					<li class=""><a href="{{ URL::to('#') }}"><span>{{ ucwords(Session::get('name')) }}</span></a></li>
					<li class=""><a href="{{ URL::to('users/listcards') }}"><span>{{ trans('usermenu.yoursmarttrackingcards') }}</span></a></li>
					<li class=""><a href="{{ URL::to('users/listbags') }}"><span>{{ trans('usermenu.yourbags') }}</span></a></li>
					<li class=""><a href="{{ URL::to('users/listflights') }}"><span>{{ trans('usermenu.yourflights') }}</span></a></li>
					<li class=""><a href="{{ URL::to('users/listclaims') }}"><span>{{ trans('usermenu.lostandfound') }}</span></a></li>
					<li>
						<a href="{{ URL::to('users/logout') }}">Logout</a>
					</li>
					
				</ul>
			</div>
		</div>-->
		
		<!-- Notifications -->
		<div id="mws-user-notif" class="mws-dropdown-menu">
			<a href="#" data-toggle="dropdown" class="mws-dropdown-trigger">{{ ucwords(Session::get('name')) }}</a>
			<div class="mws-dropdown-box">
											<div class="mws-dropdown-content">
												<ul class="mws-notifications">
													<li><a href="{{ URL::to('users/viewprofile') }}">&nbsp; Profile</a></li>
													<li><a href="{{ URL::to('users/logout') }}">&nbsp; Logout</a></li>
												</ul>
											</div>
			</div>
		</div>
		
		<div  style="margin-top:13px;display:inline-block;position:relative;vertical-align:top;margin:13px 13px;">
			 <a href="{{ URL::to('users/dashboard') }}"><span class="whitelink">{{ trans('usermenu.yourdashboard') }}</span></a>
		</div>
		<div  style="margin-top:13px;display:inline-block;position:relative;vertical-align:top;margin:13px 13px;">
			 <a href="{{ URL::to('users/listcards') }}"><span class="whitelink">{{ trans('usermenu.yoursmarttrackingcards') }}</span></a>
		</div>
		
		<div style="margin-top:13px;display:inline-block;position:relative;vertical-align:top;margin:13px 13px;">
			 <a href="{{ URL::to('users/listbags') }}"><span class="whitelink">{{ trans('usermenu.yourbags') }}</span></a>
		</div>
		<div style="margin-top:13px;display:inline-block;position:relative;vertical-align:top;margin:13px 13px;">
			 <a href="{{ URL::to('users/listflights') }}"><span class="whitelink">{{ trans('usermenu.yourflights') }}</span></a>
		</div>
		<div style="margin-top:13px;display:inline-block;position:relative;vertical-align:top;margin:13px 13px;">
			 <a href="{{ URL::to('users/listclaims') }}"><span class="whitelink">{{ trans('usermenu.lostandfound') }}</span></a>
		</div>
		
		<div id="mws-user-notif" class="mws-dropdown-menu">
			@include('home.menu-lang')
		</div>
		
		<div id="mws-user-notif" class="mws-dropdown-menu">
			@include('home.menu-currency')
			
			
		</div>
		
		
	</div>
</div>

<!-- Start Main Wrapper -->
<div id="mws-wrapper">

	
