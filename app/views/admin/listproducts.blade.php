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
		
								<h2><i class="icol32-routing-go-right"></i>{{ 'Products Manager' }}</h2>
								<p style="text-align:justify">
									{{ 'Admin can manage products' }}
									
								</p>
								@include('layouts.admin-message')
								
								
							</div>
						</div>
					</div>
           
            	<!--Panel start -->
					<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> {{ 'Products  Management' }}</span>
                    </div>
                    <div class="mws-panel-toolbar">
                        <div class="btn-toolbar">
                            
                             <div class="btn-group pull-right">
                                	<input type="button" class="btn btn-primary pull-right" onclick="location.href='{{ url('admin/addproduct', $secure = null) }}'" value='Add a new product'>
                             </div>
                        </div>
                        
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-datatable-fn mws-table" id="tpl_terms">
                            <thead>
                                <tr>
                                	
                                    <th>{{ 'Codice Prodotto' }}</th>
                                    <th>{{ 'Codice Item' }}</th>
                                    <th>{{ 'Titlo' }}</th>
                                    <!--<th>{{-- 'Descrizione web' --}}</th>-->
                                    <!--<th>{{-- 'Descrizione app' --}}</th>-->
                                    <th>{{ 'Prezzo webapp' }}</th>
                                    <th>{{ 'Prezzo aeroporto' }}</th>
                                    <th>{{ 'Stato' }}</th>
                                    <th>{{ 'Lingua' }}</th>
                                    <th>{{ 'Aeroporto di vendita' }}</th>
                                    <th>{{ 'Data di scandenza' }}</th>
                                    <th>{{ 'Start Date' }}</th>
                                    <th>{{ 'End Date' }}</th>
                                    <th>{{ 'Actions' }}</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            	 @foreach ($products as $product)
   			 							
   			 							<tr>
   			 								
		                                   
		                                    <td>{{ $product->codice_prodotto }}</td>
		                                    <td>{{ $product->codice_item }}</td>
		                                    <td>{{ $product->titolo }}</td>
		                                    <!--<td>{{-- html_entity_decode(mb_convert_encoding($product->descrizione_web, 'HTML-ENTITIES', 'UTF-8')) --}}</td>-->
		                                    <!--<td>{{-- $product->descrizione_app --}}</td>-->
		                                    <td>{{ $product->currency.'&nbsp;'.$product->prezzo_web_app }}</td>
		                                    <td>{{ $product->currency.'&nbsp;'.$product->prezzo_aeroporto }}</td>
		                                    <td>		                                    	
		                                    	
		                                    	@if ($product->stato== 1)
												    <span style="color: #008000;font-weight:bold;">Attivo</span>
												@else
												    <span style="color: #e00000;font-weight:bold;">Inattivo</span>
												@endif	
														                                    	
		                                    </td>
		                                    <td>
									            @if($product->lingua=='en')
							                        {{ 'English'  }}
							                    @elseif($product->lingua =='it')
							                        {{ 'Italiano' }}
							                    @elseif($product->lingua=='fr')
							                        {{ 'Français' }}
							                    @endif	
		                                    </td>
		                                    <td>
		                                    	 <?php
								                    $exArr = @explode(',', $product->aeroporto_di_vendita);
								
								                    foreach($exArr as $key=>$value){
								                        //echo $airports[$exArr[$key]].'<br/>';
								                        echo $exArr[$key].'<br/>';
								                    }
								
								                  ?>	
		                                    </td>
		                                    <td>{{ date('d-m-Y', strtotime($product->data_di_scandenza)) }}</td>
		                                    <td>{{ date('d-m-Y', $product->start_date) }}</td>
		                                    <td>{{ date('d-m-Y', $product->end_date) }}</td>
		                                                 
		                                    
		                                    <td>
		                                    	<input type="button" class="btn-primary" onclick="location.href='{{ url('admin/updateproduct', $parameters = array('id_prodotto'=> $product->id_prodotto), $secure = null) }}'" value='Edit'>
		                                    	<input type="button" class="btn-danger" onclick="areyousure('{{ url('admin/deleteproduct', $parameters = array('id_prodotto'=> $product->id_prodotto ), $secure = null) }}')" value='Delete'>
		                                    </td>
		                                   
		                                </tr>
		    					 @endforeach
                                
                                
                            </tbody>
                        </table>
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
				
										
