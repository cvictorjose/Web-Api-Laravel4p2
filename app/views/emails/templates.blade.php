<?php
//mail body links and styles
    $style_link_azzuro="color:#255077;font-weight: bold;font-size:14px;";
    $social_twitter="https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fabout.twitter.com%2Fresources%2Fbuttons&related=Safe_Bag&screen_name=Safe_Bag&share_with_retweet=never&text=%23AskSafeBag&tw_p=tweetbutton";
	$social_facebook="http://www.facebook.com/SafeBagInternational";

	$sfb_iphone="https://itunes.apple.com/hk/app/safebag-application/id833629178?mt=8";
	$sfb_android="https://play.google.com/store/apps/details?id=com.safebagapp.main";
?>

@if ($referer == 'client_register')
    <div style="font-size: 16px;font-family: Helvetica,Arial, Verdana;">
						<p>Hello <b>{{ $name }}</b>,<br></p>
						<p>Welcomeeeee to Safe Bag Community.</p>
						<p>This is our email customer.care@safe-bag.com should you need any assistance or want to give us feedback on what you like or dislike or would like us to change .</p>
						
						<p>For easy access to our services at any time, we recommend you download the Safe Bag Mobile App   (<a href="{{ $sfb_iphone }}"  style="{{ $style_link_azzuro }}">Apple Store</a> or  <a href="{{ $sfb_android }}"  style="{{ $style_link_azzuro }}">Google Play</a>)</p>
						
				        <p>Thanks, have a nice day!</p>
						<p>Safe Bag<br><span style="font-size:12px;">The world's #.1 traveller's bag protection service</span>
						<br><a  style="font-size:12px;color:#255077;font-weight: bold;" href="http://www.borsaitaliana.it/borsa/azioni/aim-italia/scheda.html?isin=IT0004954530&lang=en">(AIM Italia - MAC: SB.MI - ISIN: IT0004954530)</a>
						</p>
						<p  style="font-size:11px;">
						<i>
							<a href="$social_twitter">#AskSafeBag</a> -  for any questions regarding Passenger Rights in case of damage or loss to luggage, tweet us on <a href="{{ $social_twitter }}">Twitter</a> or find us on <a href="{{ $social_facebook }}">FaceBook</a>
						</i>
						</p>
	</div>
@elseif ($referer == 'bag_register')
    <h1>Hi, {{ 'Sam' }}!</h1>
 
	<p>We'd like to personally welcome you to the Laravel 4 Authentication Application. Thank you for registering!</p>
@else
    I don't have any records!
@endif