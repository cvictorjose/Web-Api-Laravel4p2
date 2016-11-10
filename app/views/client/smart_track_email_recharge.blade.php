<?php
	
		echo trans('emailtemplet.smart_track_email_recharge', array('name'=>$name, 'card_number'=>strtoupper($card_number), 'price' => $price));
?>

