{{ HTML::script('minisite/js/jquery.ddslick.min.js'); }}
<?php 
	$colorsorders	=	Clients::getColor();
	for($i=1; $i<=$qty; $i++){
		?>
        {{ Form::hidden('colour['.$i.']', 1 ,array('id'=>'colour_'.$i)) }}
        <select id="picdropdown_<?php echo $i;?>" class=".picdropdown">
        <?php 
					
					if(!empty($colorsorders)){
						foreach($colorsorders as $key=>$value){
							if($key==1){
							?>
                            <option value="<?php echo $key;?>" selected="selected"  data-imagesrc="{{ asset('images/cards/'.$key.'.png') }}"
                    data-description="Color: <?php echo $value;?>">Smart Track Card</option>
                            <?php	
							}
							else{
							?>
                            <option value="<?php echo $key;?>"  data-imagesrc="{{ asset('images/cards/'.$key.'.png') }}"
                    data-description="Color: <?php echo $value;?>">Smart Track Card</option>
                            <?php		
							}
						}
					}
				?>
                
    		</select>
            <br>
            <script type="text/javascript">
			$('#picdropdown_<?php echo $i;?>').ddslick({
				onSelected: function(selectedData){
					//callback function: do something with selectedData;
				}   
			});
			</script>
        <?php
	}
?>

<script type="text/javascript">
$('.dd-options').click(function() {
		parent		=	$(this).parent().attr('id');
		parentarray	=	parent.split("_");
		parentid	=	'#'+$(this).parent().attr('id')+' '+".dd-select";
		value	=	$(parentid).children(".dd-selected-value").val();
		
		colourid	=	"#colour_"+parentarray[1];
		$(colourid).val(value);
	});
</script>