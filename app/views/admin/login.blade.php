<div id="mws-login-wrapper">

	<!-- Main Content -->
	<div id="mws-login">

		<img src="http://www.safe-bag.com/images/logo.png">
		<div class="mws-login-lock">
			<i class="icon-lock"></i>
		</div>
		<div id="mws-login-form">

			{{ Form::open(array('url' => 'admin/signin','method'=>'post')) }}

				<div>
					<div>
						<div class="mws-form-row">
							<div class="mws-form-item">

								<input type="text" class="mws-login-username required" placeholder="Email" id="email" name="email"/>
							</div>
						</div>
					</div>
					<div class="mws-form-row">
						<div class="mws-form-item">
							<input type="password" class="mws-login-password required" placeholder="Password" id="password" name="password"/>
						</div>
					</div>
					
					<!--<div id="mws-login-remember" class="mws-form-row mws-inset">
						<ul class="mws-form-list inline">
							<li>
								<input type="checkbox" id="remember_me" name="remember_me" value="1" />
								<label for="remember_me">Remember me:</label>

							</li>
						</ul>
					</div>-->
					<div class="mws-form-row">
						<input type="submit" name="login_user" id="submit" value="Login" class="btn btn-danger mws-login-button"/>
					</div>

			{{ Form::close() }}

			<!--<div class="mws-form-row" style="padding-top:0px;">
				<input type=button onClick="location.href='<?php //echo $base_url; ?>auth/forgotten_password'" value='Password dimenticata.' class="btn mws-login-button">
			</div>-->
		</div>

	</div>
</div>

</div>