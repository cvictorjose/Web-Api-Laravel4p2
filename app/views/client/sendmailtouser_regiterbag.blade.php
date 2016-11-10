<?php
	//$body	=	trans('frontend.sendmailtouser_regiterbag', array('card_number' => $card_number));
	if(isset($card_number))
		echo trans('emailtemplet.smart_card_register', array('name' => $name, 'card_number'=>strtoupper($card_number)));
	else
		echo trans('emailtemplet.smart_card_register', array('name' => $name));
						
		
?>