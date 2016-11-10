<!--  Navigation -->
		@include('layouts.admin-nav')
		<!--content view starts -->
				<!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Inner Container Start -->
            <div class="container">
            
            	<!-- Intro Content -->
					<div class="content_wrap intro_bg">
						<div class="content clearfix">
							<div class="col100">
		
								<h2><i class="icol32-money-bag"></i>{{ 'Add/Edit Products'}}</h2>
								<p style="text-align:justify">
										
									{{ 'Add/Edit Products' }}
									
								</p>
								
								@include('layouts.admin-message')
								@foreach($errors->all() as $error2)
           						<div class="mws-form-message error">
                            		{{ $error2 }}
                            	</div>
							   @endforeach
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
            		
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-book"></i>Add/Edit Products</span>
                    </div>
                    <div class="mws-panel-body no-padding">
		                    @if(isset($product))
		                    	<?php
		                    	$start_date = date('Y-m-d',$product->start_date);
		                    	$end_date = date('Y-m-d',$product->end_date);
								
								$term_id = $product->terms;
								$idairline = $product->idairline;
								$expArr = @explode(',', $product->aeroporto_di_vendita);
								foreach($airports as $airport){
									if (in_array($airport->depport, $expArr)) {
										 $selectedA =  true;
									}
								}
		                    	?>
							    {{ Form::model($product, array('url' => array('admin/updateproduct/'.$product->id_prodotto),'class'=>'mws-form', 'method' => 'post','id'=>'products_form','enctype'=> "multipart/form-data")) }}
							    {{ Form::hidden('id_prodotto',$product->id_prodotto) }}
							@else
							
								<?php
		                    	$end_date = date('Y-m-d');
								$start_date = date('Y-m-d');
								$term_id = Input::old('terms');
								$idairline = Input::old('idairline');
								$selectedA =  false;
		                    	?>
							    {{ Form::open(array('url' => array('admin/addproduct'),'class'=>'mws-form','id'=>'products_form','method' => 'post','enctype'=> "multipart/form-data")) }}
							@endif
                    		
                    
                    		<div class="mws-form-inline">
                    			
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Airports</label>
                    				<div class="all_airports mws-form-item">
                    					<input type="checkbox" class="checkall"  />	<label for="selectall">Select All Airports</label> <br /><br /><br />
                    					 @if(isset($product))
										               			<?php $expArr = @explode(',', $product['aeroporto_di_vendita']); ?>
												                
												                <?php foreach($airports as $key=>$value){ ?>
												                    <input class="required" <?php if (in_array($airports[$key]['depport'], $expArr)) { echo 'checked=checked'; } ?>  type="checkbox" name="aeroporto_di_vendita[]" id="aeroporto_di_vendita[]" value="<?php echo $airports[$key]['depport']; ?>"><?php echo $airports[$key]['city']; ?><br/>
												                <?php } ?>
										 @else
										 		 <?php foreach($airports as $key=>$value){ ?>
                        								<input class="required" type="checkbox" name="aeroporto_di_vendita[]" id="aeroporto_di_vendita[]" value="<?php echo $airports[$key]['depport']; ?>"><?php echo $airports[$key]['city']; ?><br/>
                								 <?php } ?>
										 @endif		                
						                 
                    					 
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Codice Prodotto</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('codice_prodotto',Input::old('codice_prodotto'), $attributes = array('id'=>'codice_prodotto',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Codice Item</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('codice_item',Input::old('codice_item'), $attributes = array('id'=>'codice_item','class'=>'required')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Titolo</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('titolo',Input::old('titolo'), $attributes = array('id'=>'titolo','class'=>'required')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Service Image</label>
                    				<div class="mws-form-item">
                    					
                    					
                    					@if(isset($product) &&  $product->image!='')
                    						{{ Form::file('picture1', $attributes = array('id'=>'picture1')) }}
                    						{{ HTML::image('uploads/products/'.$product->image, 'Product image') }}
                    					@else
                    						{{ Form::file('picture1', $attributes = array('id'=>'picture1','class'=>'required')) }}	
										@endif
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Descrizione web</label>
                    				<div class="mws-form-item">
                    					{{ Form::textarea('descrizione_web',Input::old('descrizione_web'), $attributes = array('id'=>'descrizione_web',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Descrizione Completa Web</label>
                    				<div class="mws-form-item">
                    					{{ Form::textarea('descrizione_web_full',Input::old('descrizione_web_full'), $attributes = array('id'=>'descrizione_web_full',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Descrizione app</label>
                    				<div class="mws-form-item">
                    					{{ Form::textarea('descrizione_app',Input::old('descrizione_app'), $attributes = array('id'=>'descrizione_app',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Prezzo webapp</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('prezzo_web_app',Input::old('prezzo_web_app'), $attributes = array('id'=>'prezzo_web_app','class'=>'required')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Prezzo Aeroporto</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('prezzo_aeroporto',Input::old('prezzo_aeroporto'), $attributes = array('id'=>'prezzo_aeroporto','class'=>'required')) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Lingua</label>
                    				<div class="mws-form-item">
                    					{{ Form::select('lingua', array('' => '-Select language-', 'en' => 'English', 'it' => 'Italiano', 'fr' => 'Français'), Input::old('lingua'),$attributes = array('id'=>'lingua',"class" => "required")  ); }}
                    					
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Data di scandenza</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('data_di_scandenza',Input::old('data_di_scandenza'), $attributes = array('id'=>'data_di_scandenza',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Start Date</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('start_date',$start_date, $attributes = array('id'=>'start_date',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">End Date</label>
                    				<div class="mws-form-item">
                    					{{ Form::text('end_date',$end_date, $attributes = array('id'=>'end_date',"class" => "required")) }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Airline</label>
                    				<div class="mws-form-item">
                    					{{ Form::select('idairline', $airlines , $idairline, $attributes = array('id'=>'idairline',"class" => "required") ); }}
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Currency</label>
                    				<div class="mws-form-item">
                    					{{ Form::select('currency', array('EUR' => 'EUR', 'CHF' => 'CHF', 'USD' => 'USD', 'BRL' => 'BRL', 'RUB' => 'RUB', 'MXN' => 'MXN', 'GBP' => 'GBP'), Input::old('currency')); }}
                    					
                    				</div>
                    			</div>
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Terms and Conditions</label>
                    				<div class="mws-form-item">
                    					
                    					{{ Form::select('term_id', $terms , $term_id, $attributes = array('id'=>'term_id',"class" => "required")); }}
                    					 
                    				</div>
                    			</div>
                    			
                    			
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	{{ Form::close() }}
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
				
										
