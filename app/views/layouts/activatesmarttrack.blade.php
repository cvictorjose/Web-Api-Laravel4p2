{{ HTML::script('minisite/js/jquery.ddslick.min.js'); }}
<!--  Navigation -->
		@include('layouts.user-nav')
		<!--content view starts -->
				<!-- Main Container Start -->
        <div id="mws-container" class="clearfix" style="margin-left: 0px;">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	<!-- Intro Content -->
					<div class="content_wrap intro_bg">
						<div class="content clearfix">
							<div class="col100">
		
								<h2><i class="icol32-application-view-tile"></i><?php echo trans('activatesmarttrack.activate_smarttrack');?></h2>
								<?php /*?><p style="text-align:justify">
                                <?php echo Session::get('cc');?>
									{{ trans('userlistcards.description') }} 
									<br/>
									

								</p><?php */?>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
                 <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-magic"></i> <?php echo trans('activatesmarttrack.activate_smarttrack');?></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <form class="mws-form wzd-ajax" id="activatesmarttracking-form" action="php/wizard.php" method="post">
                            
                            <fieldset class="wizard-step mws-form-inline">
                                <legend class="wizard-label"><i class="icol-accept"></i> <?php echo trans('activatesmarttrack.select_your_card');?></legend>
                                <?php 
									$i	=	1;
								?>
                                @foreach($cards as $card)
                                    <?php 
									$activeclass	=	"";
									$activeclass	=	"";
									if($i==1){
										$activeclass	=	"checked";
									}
									?>
                                    <div class="mws-panel-body <?php echo $activeclass;?>" id="carddiv_<?php echo $card->card_id;?>">
                                       
                                           <ul class="mws-summary clearfix">
                                            
                                                <li class='clearfix' style="border-bottom:none">
                                                    
                                                    <span class="key"><img src="{{ asset('images/cards/'.$card->card_color.'.png') }}"  /></span>
                                                    <span class="val">
                                                        <?php 
                                                            $bgfontcolor	=	'color:red';
                                                            if($card->flightnumbers > 0)
                                                                $bgfontcolor	=	'color:green';
                                                        ?>
                                                        <span class="text-nowrap">{{ $card->card_number }}</span><br/>
                                                        <span class="text-nowrap">{{ trans('userlistcards.travel_left').':&nbsp;<b style="'.$bgfontcolor.'">'.$card->flightnumbers.'</b>' }}</span>
                                                        <span class="text-nowrap"> <input type="radio" name="card_id" value="<?php echo $card->card_id;?>" <?php echo $activeclass;?>> </span>
                                                    </span>
                                                </li>
                                                
                                            
                                            </ul>
                                      
    
                                    </div>
                                    <?php $i++;?>
                                @endforeach  
                            </fieldset>
                            
                            <fieldset class="wizard-step mws-form-inline">
                                <legend class="wizard-label"><i class="icol-delivery"></i> <?php echo trans('activatesmarttrack.select_your_bag');?></legend>
                                <?php 
									$i	=	1;
								?>
                                @foreach($bags as $bag)
                                    <?php 
									$activeclass	=	"";
									$activeclass	=	"";
									if($i==1){
										$activeclass	=	"checked";
									}
									?>
                                    <div class="mws-panel-body <?php echo $activeclass;?>" id="carddiv_<?php echo $card->card_id;?>">
                                       
                                           <ul class="mws-summary clearfix">
                                            
                                                <li class='clearfix' style="border-bottom:none">
                                                    @if($bag->picture1 != '' && file_exists(('uploads/'.$bag->picture1)))
                                                        <span class="key"><img src="{{ asset('uploads/'.$bag->picture1) }}"  /></span>
                                                    @else
                                                    	<span class="key"><img src="{{ asset('images/defaultbag.png') }}"  /></span>
                                                    @endif
                                                    @if($bag->picture2 != '' && file_exists(('uploads/'.$bag->picture2)))
                                                        <span class="key"><img src="{{ asset('uploads/'.$bag->picture2) }}"  /></span>
                                                    @endif
                                                    @if($bag->picture3 != '' && file_exists(('uploads/'.$bag->picture3)))
                                                        <span class="key"><img src="{{ asset('uploads/'.$bag->picture3) }}"  /></span>
                                                    @endif
                                                    
                                                    <span class="val">
                                                        <?php 
                                                            $bgfontcolor	=	'color:red';
                                                            if($card->flightnumbers > 0)
                                                                $bgfontcolor	=	'color:green';
                                                        ?>
                                                        <span class="text-nowrap">{{ $card->card_number }}</span><br/>
                                                        <span class="text-nowrap">{{ trans('userlistcards.travel_left').':&nbsp;<b style="'.$bgfontcolor.'">'.$card->flightnumbers.'</b>' }}</span>
                                                        <span class="text-nowrap"> <input type="radio" name="card_id" value="<?php echo $card->card_id;?>" <?php echo $activeclass;?>> </span>
                                                    </span>
                                                </li>
                                                
                                            
                                            </ul>
                                      
    
                                    </div>
                                    <?php $i++;?>
                                @endforeach  
                            </fieldset>
                            
                            <fieldset class="wizard-step mws-form-inline">
                                <legend class="wizard-label"><i class="icol-user"></i> <?php echo trans('activatesmarttrack.select_your_flight');?></legend>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Message <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <textarea name="address" rows="" cols="" class="required large"></textarea>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Subscribe Newsletter <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list inline">
                                            <li><input type="radio" id="sn_yes" name="sn" class="required"> <label for="sn_yes">Yes</label></li>
                                            <li><input type="radio" id="sn_no" name="sn"> <label for="sn_no">No</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="sn" style="display:none"></label>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">I agree to the TOS <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list inline">
                                            <li><input type="checkbox" id="tos_y" name="tos" class="required"> <label for="tos_y">Yes</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="tos" style="display:none"></label>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="wizard-step mws-form-inline">
                                <legend class="wizard-label"><i class="icol-user"></i> <?php echo trans('activatesmarttrack.review_your_order');?></legend>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Message <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <textarea name="address" rows="" cols="" class="required large"></textarea>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">Subscribe Newsletter <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list inline">
                                            <li><input type="radio" id="sn_yes" name="sn" class="required"> <label for="sn_yes">Yes</label></li>
                                            <li><input type="radio" id="sn_no" name="sn"> <label for="sn_no">No</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="sn" style="display:none"></label>
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">I agree to the TOS <span class="required">*</span></label>
                                    <div class="mws-form-item">
                                        <ul class="mws-form-list inline">
                                            <li><input type="checkbox" id="tos_y" name="tos" class="required"> <label for="tos_y">Yes</label></li>
                                        </ul>
                                        <label class="error plain" generated="true" for="tos" style="display:none"></label>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>      
                       
                <!-- Panels End -->

   
   
            </div>
            <!-- Inner Container End -->
            
                
                
                
                
                       
            <!-- Footer -->
            @include('layouts.admin-foot')
            
            
        </div>
        <!-- Main Container End -->
        
    </div>
			
										
<script>
$(document).ready(function() {
	$wzd_v1_form = $( '.wzd-ajax' ).validate({ onsubmit: false });

	$( '.wzd-ajax' ).wizard({
		buttonContainerClass: 'mws-button-row', 
		onStepLeave: function(wizard, step) {
			return $wzd_v1_form.form();
		}, 
		onBeforeSubmit: function() {
			return $wzd_v1_form.form();
		}, 
		ajaxSubmit: true, 
		ajaxOptions: {
			dataType: 'text', 
			beforeSubmit: function(formData) {
				alert( 'You\'re about to submit:\n\n' + $.param(formData) );
				return true;
			}, 
			success: function(response, status, xhr, form) {
				if( confirm( 'Form successfully submitted.\nServer Response:\n' + response + '\n\nReset Wizard?' ) ) {
					form.wizard( 'reset' );
					$wzd_v1_form.resetForm();
				}
			}
		}
	});
});
</script>


