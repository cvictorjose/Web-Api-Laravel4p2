<?php
	$page_mybags = "http://test.safe-bag.com/dashboard/mybags.php";
    $page_lostfound = "http://test.safe-bag.com/dashboard/lost-found.php";
    $style_link_azzuro="color:#255077;font-weight: bold;font-size:14px;";
    $social_twitter="https://twitter.com/intent/tweet?original_referer=https%3A%2F%2Fabout.twitter.com%2Fresources%2Fbuttons&related=Safe_Bag&screen_name=Safe_Bag&share_with_retweet=never&text=%23AskSafeBag&tw_p=tweetbutton";
	$social_facebook="http://www.facebook.com/SafeBagInternational";

	$sfb_iphone="https://itunes.apple.com/hk/app/safebag-application/id833629178?mt=8";
	$sfb_android="https://play.google.com/store/apps/details?id=com.safebagapp.main";
    $link_blu = "color:#255077;font-weight: bold;";
    $link_bold_under = "color:#255077;font-weight: bold;text-decoration:underline;";

    $body	=	'';
   
    // $text = utf8_decode('Ã©Ã©Ã©Ã Ã Ã Ã ');
    /*$body = "<div style=\"font-size: 16px;font-family: Helvetica,Arial, Verdana;\">
                		<p>Hello <strong>$name</strong>,<br></p>
						<p>Your luggage has been properly Updated<br><br>
						<p>At any time you can update the information, add a new bag or make a refund request in case of loss or damage in the  <a href=\"$page_mybags\" style=\"$style_link_azzuro\">MyBag</a> section of the Safe Bag website.</p>

						<p>In case of loss or damage to the bag during the flight, remember to make your refund request at the following <a href=\"$page_lostfound\"  style=\"$style_link_azzuro\">link</a> within <strong>21</strong> days from the date of landing at your final destination.</p>
		
						<p>For easy access to our services at any time, we recommend to download the Safe Bag free mobile app (<a href=\"$sfb_iphone\"  style=\"$link_blu\">Apple Store</a> or  <a href=\"$sfb_android\"  style=\"$link_blu\">Google Play</a>)</p><br>
		
						
						<strong>REGISTERED BAGS:</strong><br><br>";*/
						$body	.=	trans('frontend.updatebag_email_des_1', array('name' => $name, 'page_mybags' => $page_mybags, 'style_link_azzuro' => $style_link_azzuro, 'page_lostfound' => $page_lostfound, 'sfb_iphone' => $sfb_iphone, 'link_blu' => $link_blu, 'sfb_android' => $sfb_android ));
						/*foreach ($bagdetails as $key => $value) {
							$safebagcode = strtoupper($bagdetails[$key]);
							$body .= "$safebagcode<br>";
						}*/
						
						/*$bagdetails	=	array();
						$body	=	trans('frontend.updatebag_email_des_1', array('name' => $name, 'page_mybags' => $page_mybags, 'style_link_azzuro' => $style_link_azzuro, 'page_lostfound' => $page_lostfound, 'sfb_iphone' => $sfb_iphone, 'link_blu' => $link_blu, 'sfb_android' => $sfb_android ));
						if($idbag != ''){
							$bagdetails	=	Claimsbag::find($idbag);
						}*/

	if(!empty($bagdetails))
	{
    $safebagcode = strtoupper($bagdetails['smartcardcode']);
	$body .= "$safebagcode<br>";
	$bookingdetails	=	$bagdetails;
	$airline	=	'';
	if($bookingdetails['airline'] != ''){
		/*$airportsall	=	Airportsall::find($bookingdetails['airline']);
		$airline		=	$airportsall->city;*/
		$airportsall	=	Airlines::where('idairline','=',$bookingdetails['airline'])->get();
		$airline		=	(isset($airportsall[0])) ? $airportsall[0]->name_airline : '';
	}
	$airportslist	=	Airportsall::lists('city','iata');
	
	//$body	.=	trans('frontend.updatebag_email_des_2', array('depport' => $airportslist[$bookingdetails['depport']], 'arrport' => $airportslist[$bookingdetails['arrport']], 'depdate' => date('d/m/Y',$bookingdetails['depdate']), 'arrdate' => date('d/m/Y',$bookingdetails['arrdate']), 'airline' => $airline, 'social_twitter' => $social_twitter, 'social_facebook' => $social_facebook ));
	$body	=	trans('emailtemplet.refund_request', array('name' => $name, 'bag_name'=>$bagdetails['bagname'], 'color'=>$bagdetails['bagcolor'], 'brand'=>$bagdetails['bagbrand'], 'depport' => $airportslist[$bookingdetails['depport']], 'arrport' => $airportslist[$bookingdetails['arrport']], 'depdate' => date('d/m/Y',$bookingdetails['depdate']), 'arrdate' => date('d/m/Y',$bookingdetails['arrdate']), 'airline' => $airline , 'safebagcode'=>$safebagcode, 'claimcode'=>$claimcode));
    /*$body .= "<br><br><strong>FLIGHT DETAILS:</strong><br><br>
						- Departing Airport: ".$airportslist[$bookingdetails['depport']]."<br>
						- Destination Airport: ".$airportslist[$bookingdetails['arrport']]."<br>
						- Departure date: ".date('d/m/Y',$bookingdetails['depdate'])."<br>
						- Arrival date: ".date('d/m/Y',$bookingdetails['arrdate'])."<br>
						- Airline: $airline<br><br>
						
						<p>Thanks, have a nice day!</p>
						<p>Safe Bag<br><span style=\"font-size:12px;\">The world's #.1 traveller's bag protection service</span>
						<br>
						<a  style=\"font-size:12px;color:#255077;font-weight: bold;\" href=\"http://www.borsaitaliana.it/borsa/azioni/aim-italia/scheda.html?isin=IT0004954530&lang=en\">(AIM Italia - MAC: SB.MI - ISIN: IT0004954530)</a>
						</p>
						<p  style=\"font-size:11px;\">
						<i>
							<a href=\"$social_twitter\">#AskSafeBag</a> -  for any questions regarding Passenger Rights in case of damage or loss to luggage, tweet us on <a href=\"$social_twitter\">Twitter</a> or find us on <a href=\"$social_facebook\">FaceBook</a>
						</i>
						</p>
						</div>
						";*/
	}
						
		echo $body;
?>