<?php
	
		echo trans('emailtemplet.smart_track_email_card_purchase', array('name'=>$name, 'transaction_id'=>$transaction_id, 'quantity' => $quantity, 'color' => $color, 'price' => $price, 'sh_address' => $sh_address, 'sh_city' => $sh_city, 'sh_province' => $sh_province, 'sh_country' => $sh_country));
?>

