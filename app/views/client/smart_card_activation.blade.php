<?php 
	if(isset($bagdetails)){
		
		$bookingdetails	=	$bagdetails;
		$airline	=	'';
		if($bookingdetails['airline'] != ''){
			$airportsall	=	Airlines::where('idairline','=',$bookingdetails['airline'])->get();
			$airline		=	(isset($airportsall[0])) ? $airportsall[0]->name_airline : '';
		}
		$airportslist	=	Airportsall::lists('city','iata');
		
		$safebagcode = strtoupper($bagdetails['smartcardcode']);
		
		echo trans('emailtemplet.smart_card_activation', array('name' => $name, 'bag_name'=>$bagobject->name, 'color'=>$bagobject->color, 'brand'=>$bagobject->brand,'depport' => $airportslist[$bookingdetails['depport']], 'arrport' => $airportslist[$bookingdetails['arrport']], 'depdate' => date('d/m/Y',$bookingdetails['depdate']), 'arrdate' => date('d/m/Y',$bookingdetails['arrdate']), 'airline' => $airline, 'safebagcode'=>$safebagcode));
	}
	else
		echo trans('emailtemplet.smart_card_activation', array('name' => $name));
?>

