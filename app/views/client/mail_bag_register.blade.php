<?php
	if(isset($bag_name)) 
		echo trans('emailtemplet.bag_register', array('name'=>$name, 'bag_name'=>$bag_name, 'color'=> $color, 'brand'=>$brand));
	else
		echo trans('emailtemplet.bag_register', array('name' => $name));
?>

