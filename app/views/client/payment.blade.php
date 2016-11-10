<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<section id="getappContainer" class="section-80-130 whiteBgSection">
<div class="row">
			<!--contact info-->
				<div class="twelve-col">
				<h1 class="sectionTitle"><?php echo trans('frontend.confirm_and_pay');?></h1>
				<div class="titleSeparator"></div>
				<div class="clear"></div>
				</div>
				<div class="four-col prefix-one">
				<h3><?php echo trans('frontend.your_order');?></h3>
				<br>
				<br>
					<!--payment form-->
                    {{ Form::open(array('url'=>'client/payment', 'class'=>'form-signup', 'id'=>'payment-form', 'name'=>'payment-form' )) }}
					
					1.<?php echo trans('frontend.select_quantity');?>:
					<br>
					<br>
                    {{ Form::select('qty', $qtyList, null, array('id'=>'qty', 'class' => 'form-control', 'style'=>'width:130px;margin-bottom:0;', 'required' => '')) }}
					 
			            	<a style="vertical-align:middle" href="#" id="updatprice" class="dlButtondark"><span class="dlButtonWrap"><span class="dlButtonSmall"> <?php echo trans('frontend.update');?></span></span></a>
			            	<br><br>
						2.<?php echo trans('frontend.select_your_colors');?>:<br><br>
                    
                     <div id="colorsdropdowndiv">   
					{{ Form::hidden('colour[1]', 1 ,array('id'=>'colour')) }}
                   
            <select id="picdropdown_1">
            	<option value="1" selected="selected"  data-imagesrc="{{ asset('minisite/img/cards/1-blue-34.png') }}"
                    data-description="Color: Blue">Smart Track Card</option>
                <option value="2" data-imagesrc="{{ asset('minisite/img/cards/2-black-34.png') }}"
                    data-description="Color: black">Smart Track Card</option>
                <option value="3" data-imagesrc="{{ asset('minisite/img/cards/3-violet-34.png') }}"
                    data-description="Color: violet">Smart Track Card</option>
                <option value="4" data-imagesrc="{{ asset('minisite/img/cards/4-pink-34.png') }}"
                    data-description="Color: pink">Smart Track Card</option>
                <option value="5" data-imagesrc="{{ asset('minisite/img/cards/5-darkblue-34.png') }}"
                    data-description="Color: dark blue">Smart Track Card</option>
                <option value="6" data-imagesrc="{{ asset('minisite/img/cards/5-orange-34.png') }}"
                    data-description="Color: yellow">Smart Track Card</option>                
                <option value="7" data-imagesrc="{{ asset('minisite/img/cards/6-green-34.png') }}"
                    data-description="Color: green">Smart Track Card</option>
                <option value="8" data-imagesrc="{{ asset('minisite/img/cards/7-darkgreen-34.png') }}"
                    data-description="Color: dark green">Smart Track Card</option>
            	<?php /*?><?php 
					$colorsorders	=	Clients::getColor();
					if(!empty($colorsorders)){
						foreach($colorsorders as $key=>$value){
							?>
                            <option value="<?php echo $key;?>" selected="selected"  data-imagesrc="{{ asset('images/cards/<?php echo $key;?>.png') }}"
                    data-description="Color: <?php echo $value;?>">Smart Track Card</option>
                            <?php	
						}
					}
				?><?php */?>
                
    		</select>
            		</div>
    <br>
    <br>
    3. <?php echo trans('frontend.confirm_and_pay');?>
    <br>
    <br>
    <h2><?php echo trans('frontend.subtotal');?>: <span id="subtotal">€9.90</span></h2>
    <br>
    <h2><?php echo trans('frontend.tax');?> 22%:  <span id="taxtotal">€9.90</span></h2>
    <br>
    <h2><?php echo trans('frontend.total');?>:    <span id="total">€9.90</span></h2>
    <br><br>

						<input type="submit" value="<?php echo trans('frontend.pay_with_paypal');?>"><i class="fa fa-spin fa-circle-o-notch fa-form-wait" style="display: none;"></i>
					{{ Form::close() }}
					<p id="formSubmitMessage"></p>
				</div>


				<!--separator-->
				<div class="two-col">
				<div class="separator2"></div>
				</div>
				<!--login-->

				<div class="five-col  last-col" id="viewshipaddress">
				<h3><?php echo trans('frontend.invoice_and_shipping');?></h3>
				<br>
				<br>
                <?php // var_dump($userdetail);?>
				<?php echo trans('frontend.your_invoice_address');?>:<br><br>
				<?php echo $userdetail['name']; ?> <?php echo $userdetail['surname']; ?> <br>
				<?php echo $userdetail['address']; ?><br>
				<?php echo $userdetail['city']; ?><br>
				<?php 
				if($userdetail['province'] != '' && $userdetail['province'] != NULL)
				echo $userdetail['province'].'<br>'; ?>
				<?php echo $countryList[$userdetail['nationality']]; ?>
				<br>
				<br>
				<?php echo trans('frontend.your_delivery_address');?>:<br><br>
				<?php echo $userdetail['name']; ?> <?php echo $userdetail['surname']; ?><br>
				<?php echo $userdetail['sh_address']; ?><br>
				<?php echo $userdetail['sh_city']; ?><br>
				<?php 
				if($userdetail['sh_province'] != '' && $userdetail['sh_province'] != NULL)
				echo $userdetail['sh_province'].'<br>'; ?>
				<?php 
				if($userdetail['sh_country'] != '' && $userdetail['sh_country'] != NULL)
					echo $countryList[$userdetail['sh_country']]; ?>
				<br>
				<br>
				<br>
				<a style="vertical-align:middle" href="#" class="dlButtondark" data-target="#myModal" onclick="return updateshipaddress();"><span class="dlButtonWrap"><span class="dlButtonSmall"> <?php echo trans('frontend.update');?></span></span></a>
				</div>
                <div class="five-col  last-col" id="editshipaddress" style="display:none">
				@include('client.updateship')
				</div>
				<div class="clear"></div>
                <!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>-->
			</div>
			<img class="triangleBottom" src="{{ asset('minisite/img/tri-white-bot.png') }}" alt="" />
            
</section>
            
{{ HTML::script('minisite/js/jquery.ddslick.min.js'); }}


<script>


$('#picdropdown').change(function() {
	calculateprice();
});
$('#qty').change(function() {
	calculateprice();
	colorsdropdowndiv();
	
});

$('#updatprice').click(function() {
	calculateprice();
});

$( document ).ready(function() {
   calculateprice();
   colorsdropdowndiv();
   $('.dd-options').click(function() {
		calculateprice();
	});
});

function updateshipaddress(){
	//window.location.href ="{{ URL::to('client/updateshipaddress') }}	";
	$("#viewshipaddress").hide();
	$("#editshipaddress").show();
	
	return false;
}

function colorsdropdowndiv(){
	//$("#colour").val($('.dd-selected-value').val());
	url	=	"{{ URL::to('client/ajaxcolorsdropdown') }}";
	data	=	$( "#payment-form" ).serializeArray();
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'html',
		data: data,
		success: function(data) {
			$("#colorsdropdowndiv").html(data);
			
			//alert(data.message);
			
		}
	});
}

function calculateprice(){
	$("#colour").val($('.dd-selected-value').val());
	url	=	"{{ URL::to('client/ajaxcalculateprice') }}";
	data	=	$( "#payment-form" ).serializeArray();
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'json',
		data: data,
		success: function(data) {
			if(data.redirect){
				window.location.href ="{{ URL::to('/') }}	";
			}
			if(data.fail) {
			  
			} 
			if(data.success){
				$("#subtotal").html(data.symbol+'  '+data.amount);
				$("#taxtotal").html(data.symbol+'  '+data.tax);
				$("#total").html(data.symbol+'  '+data.totalamount);
			}
			//alert(data.message);
			
		}
	});
}

//Make it slick!
$('#picdropdown').ddslick({
    onSelected: function(selectedData){
        //callback function: do something with selectedData;
    }   
});
</script>

<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
