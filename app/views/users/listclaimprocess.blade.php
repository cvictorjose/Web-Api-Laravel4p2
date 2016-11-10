 
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
		
								<h2><i class="icol32-application-view-tile"></i>{{ trans('userclaims.your_claims') }}</h2>
								<p style="text-align:justify">
                               
									

								</p>
								@include('layouts.user-message')
							</div>
						</div>
					</div>
 <div class="mws-panel grid_6">
                    <div class="mws-tabs">

                        <ul>
                            <li><a href="#tab-1">{{ trans('userclaims.management') }}</a></li>
                            <li><a href="#tab-2">{{ trans('userclaims.refund_details') }}</a></li>
                            <li><a href="#tab-3">{{ trans('userclaims.documents_collection') }}Documents Collection</a></li>
                            <li><a href="#tab-4">{{ trans('userclaims.refund_release_form_colloection') }}</a></li>
                        </ul>
                        
                        

                        <div id="tab-1">
                             <p>
                            	  
                            	<h3></h3>
                            	<h6>{{ trans('userclaims.refund_management') }}.&nbsp;&nbsp;&nbsp;{{ trans('userclaims.refund_detail') }}:{{ $claimsbags[0]->claimcode }}&nbsp;&nbsp;&nbsp;{{ trans('userclaims.depating_airport') }}:{{ $airportslist[$claimsbags[0]->depport] }}&nbsp;&nbsp;&nbsp;{{ trans('userclaims.destination_airport') }}:{{ $airportslist[$claimsbags[0]->arrport] }}</h6>
                               <?php 
							   	$linguaclaim	=	Session::get('lang');
							   	$stato_claim_cliente = array (
								"it" => array (
								0 => "Pratica aperta correttamente",
								1 => "Modulo di Risarcimento inviato",
								2 => "Raccolta documenti completata",
								3 => "Modulo di quietanza inviato",
								4 => "Modulo di quietanza approvato",
								5 => "Rimborso Pagato",
								6 => "Pratica di Risarcimento Chiusa",
								7 => "Pratica di Risarcimento Chiusa per decorrenza dei termini",
								8 => "Bagaglio ritrovato",
								9 => "Pratica di Risarcimento in contenzioso"
								),
								"en" => array (
								0 => "Refund opened correctly",
								1 => "Refund form was sent correctly",
								2 => "Collection of documents was completed",
								3 => "Refund Release form was sent correctly ",
								4 => "Refund Release form approved",
								5 => "Reimbursement paid",
								6 => "Refund Request closed",
								7 => "Refund request closed for expiry of terms for submitting documentation",
								8 => "Baggage found",
								9 => "Refund in progress"
								)
								);
							   
							   	$tendina_stato=$claimsbags[0]->stato_sinistro;
								
								$stato_del_sinistro=$claimsbags[0]->stato_sinistro;
								
							   	$step_on="color: #000;font-weight: bold;font-size:20px;";
								$step_off="color: #aab0be;font-weight: normal;font-size:20px;";
								
								$step_incorso="color:#459ee0;font-weight: bold; text-align: center;font-style: italic;";
								$step_avviare="color:#990002;font-weight: bold; text-align: center;";
								
								
								$descrizione_sezione_on="color:#000;font-size:15px;";
								$descrizione_sezione_off="color:#aab0be;font-size:15px;";
								
								$step_ok="-ok";
								$step_img_incorso="-incorso";
								$step_img_stop="-stop";
								$num_x_blocco_rosso=$tendina_stato;
								if ($tendina_stato>5){$tendina_stato="6";}
								
								
								$label_gs_azione_incorso = trans('userclaims.in_process');
								$label_gs_azione_avviare = trans('userclaims.in_pending');
								$uploadrefuseform	=	false;
								
								switch ($tendina_stato) {
									case "0":
										$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_on;
										$titolo_sezione_3=$step_off; $titolo_sezione_4=$step_off;
										$titolo_sezione_5=$step_off; $titolo_sezione_6=$step_off;
										
										$descrizione_sezione_1=$descrizione_sezione_off; $descrizione_sezione_2=$descrizione_sezione_on;
										$descrizione_sezione_3=$descrizione_sezione_off; $descrizione_sezione_4=$descrizione_sezione_off;
										$descrizione_sezione_5=$descrizione_sezione_off; $descrizione_sezione_6=$descrizione_sezione_off;
										
										//$msg_sezioni_1= "In corso";
										$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_3= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										$msg_sezioni_4= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										$msg_sezioni_5= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										$msg_sezioni_6= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										
										$img_sezione_1=$step_ok; $img_sezione_2=$step_img_incorso;
										$img_sezione_3=$step_img_stop; $img_sezione_4=$step_img_stop;
										$img_sezione_5=$step_img_stop; $img_sezione_6=$step_img_stop;
										
										break;
										
									case "1":
										$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_off;
										$titolo_sezione_3=$step_on; $titolo_sezione_4=$step_off;
										$titolo_sezione_5=$step_off; $titolo_sezione_6=$step_off;
										
										
										$descrizione_sezione_1=$descrizione_sezione_off; $descrizione_sezione_2=$descrizione_sezione_off;
										$descrizione_sezione_3=$descrizione_sezione_on; $descrizione_sezione_4=$descrizione_sezione_off;
										$descrizione_sezione_5=$descrizione_sezione_off; $descrizione_sezione_6=$descrizione_sezione_off;
										
										//$msg_sezioni_1= "In corso";
										$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_3= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_4= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										$msg_sezioni_5= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										$msg_sezioni_6= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										
										
										$img_sezione_1=$step_ok; $img_sezione_2=$step_ok;
										$img_sezione_3=$step_img_incorso; $img_sezione_4=$step_img_stop;
										$img_sezione_5=$step_img_stop; $img_sezione_6=$step_img_stop;
										
										break;
										
									case "2":
										$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_off;
										$titolo_sezione_3=$step_off; $titolo_sezione_4=$step_on;
										$titolo_sezione_5=$step_off; $titolo_sezione_6=$step_off;
										
										$descrizione_sezione_1=$step_off; $descrizione_sezione_2=$step_off;
										$descrizione_sezione_3=$step_off; $descrizione_sezione_4=$descrizione_sezione_on;
										$descrizione_sezione_5=$descrizione_sezione_off; $descrizione_sezione_6=$descrizione_sezione_off;
										
										//$msg_sezioni_1= "In corso";
										$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_3= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_4= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_5= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										$msg_sezioni_6= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										
										$img_sezione_1=$step_ok; $img_sezione_2=$step_ok;
										$img_sezione_3=$step_ok; $img_sezione_4=$step_img_incorso;
										$img_sezione_5=$step_img_stop; $img_sezione_6=$step_img_stop;
										
										break;
								
									case "3":
										$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_off;
										$titolo_sezione_3=$step_off; $titolo_sezione_4=$step_off;
										$titolo_sezione_5=$step_on; $titolo_sezione_6=$step_off;
										
										$descrizione_sezione_1=$descrizione_sezione_off; $descrizione_sezione_2=$descrizione_sezione_off;
										$descrizione_sezione_3=$descrizione_sezione_off; $descrizione_sezione_4=$descrizione_sezione_off;
										$descrizione_sezione_5=$descrizione_sezione_on; $descrizione_sezione_6=$descrizione_sezione_off;
										
										//$msg_sezioni_1= "In corso";
										$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_3= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_4= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_5= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_6= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										
										$img_sezione_1=$step_ok; $img_sezione_2=$step_ok;
										$img_sezione_3=$step_ok; $img_sezione_4=$step_ok;
										$uploadrefuseform	=	true;
										$img_sezione_5=$step_img_incorso; $img_sezione_6=$step_img_stop;
										
										break;
										
									 case "4":
										$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_off;
										$titolo_sezione_3=$step_off; $titolo_sezione_4=$step_off;
										$titolo_sezione_5=$step_off; $titolo_sezione_6=$step_on;
										
										
										$descrizione_sezione_1=$descrizione_sezione_off; $descrizione_sezione_2=$descrizione_sezione_off;
										$descrizione_sezione_3=$descrizione_sezione_off; $descrizione_sezione_4=$descrizione_sezione_off;
										$descrizione_sezione_5=$descrizione_sezione_off; $descrizione_sezione_6=$descrizione_sezione_on;
									
										//$msg_sezioni_1= "In corso";
										$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_3= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_4= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_5= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_6= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										
										$img_sezione_1=$step_ok; $img_sezione_2=$step_ok;
										$img_sezione_3=$step_ok; $img_sezione_4=$step_ok;
										$img_sezione_5=$step_ok; $img_sezione_6=$step_img_incorso;
									
									  break;
									  
									  case "5":
										$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_off;
										$titolo_sezione_3=$step_off; $titolo_sezione_4=$step_off;
										$titolo_sezione_5=$step_off; $titolo_sezione_6=$step_off;
										
										$descrizione_sezione_1=$descrizione_sezione_off; $descrizione_sezione_2=$descrizione_sezione_off;
										$descrizione_sezione_3=$descrizione_sezione_off; $descrizione_sezione_4=$descrizione_sezione_off;
										$descrizione_sezione_5=$descrizione_sezione_off; $descrizione_sezione_6=$descrizione_sezione_off;
										
									  
										//$msg_sezioni_1= "In corso";
										$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_3= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_4= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_5= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										$msg_sezioni_6= "<p style=\"$step_incorso\">".$label_gs_azione_incorso."</p>";
										
										$img_sezione_1=$step_ok; $img_sezione_2=$step_ok;
										$img_sezione_3=$step_ok; $img_sezione_4=$step_ok;
										$img_sezione_5=$step_ok; $img_sezione_6=$step_ok;
									  
										break;
										
										case "6":
											$titolo_sezione_1=$step_off; $titolo_sezione_2=$step_off;
											$titolo_sezione_3=$step_off; $titolo_sezione_4=$step_off;
											$titolo_sezione_5=$step_off; $titolo_sezione_6=$step_off;
										
											$descrizione_sezione_1=$descrizione_sezione_off; $descrizione_sezione_2=$descrizione_sezione_off;
											$descrizione_sezione_3=$descrizione_sezione_off; $descrizione_sezione_4=$descrizione_sezione_off;
											$descrizione_sezione_5=$descrizione_sezione_off; $descrizione_sezione_6=$descrizione_sezione_off;
										
											//$msg_sezioni_1= "In corso";
											$msg_sezioni_2= "<p style=\"$step_incorso\">".$label_gs_azione_avviare."</p>";
											$msg_sezioni_3= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
											$msg_sezioni_4= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
											$msg_sezioni_5= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
											$msg_sezioni_6= "<p style=\"$step_avviare\">".$label_gs_azione_avviare."</p>";
										
											$img_sezione_1=$step_img_stop; $img_sezione_2=$step_img_incorso;
											$img_sezione_3=$step_img_stop; $img_sezione_4=$step_img_stop;
											$img_sezione_5=$step_img_stop; $img_sezione_6=$step_img_stop;
										
										break;
								}
							   ?>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                   
                                    <th>{{ trans('userclaims.steps') }}</th>
                                    <th>{{ trans('userclaims.description') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                	
                                    <td><img src="{{ asset('images/step1-ok.png') }}"></td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_1') }}</p>
                                    </td>
                                    <td><?php echo $stato_claim_cliente[$linguaclaim][0] ?></td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td><img src="{{ asset('images/step2'.$img_sezione_2.'.png') }}"></td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_2') }}</p>
                                        <?php
										
											$data_modulo_mandato=0;
											$data_quietanza_mandato=0;
											$data_manual_mandato=0;
											
											if ( $claimsbags[0]->openingmail>0)$data_modulo_mandato=date("d/m/Y",$claimsbags[0]->openingmail);
											if ( $claimsbags[0]->receiptmail>0)$data_quietanza_mandato=date("d/m/Y",$claimsbags[0]->receiptmail);
											if ( $claimsbags[0]->modmanuale>0) $data_manual_mandato=date("d/m/Y",$claimsbags[0]->modmanuale);
											
											$sigdate_out=$claimsbags[0]->sigdate;
											$claimcode	=	$claimsbags[0]->claimcode;
											$anno_claim = date ( "Y", $sigdate_out );
											$mese_claim = date ( "m", $sigdate_out );
											$folder_claim = "../../test-safebag/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/";
											$folder_claimdummy = "http://test.safe-bag.com/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/";
											
											
											$step = "1";
											$trova_modulo_xlingua = array (0 => "_ModuloRisarcimento_",1 => "_RefundForm_");
											$trova_modulo_ext_xlingua = array (0 => "it",1 => "en");
											$mostra_modulo_step1="";
											for ($i = 0; $i < 2; $i++) {
												$tipo_modulo_step1=$trova_modulo_xlingua[$i];
												$trova_xlingua=$trova_modulo_ext_xlingua[$i];
												
												$mostra_modulo_step1.= Claimsdocs::searchmodule ( $folder_claim, $claimcode, $tipo_modulo_step1, $step, $trova_xlingua, $folder_claimdummy );
											}
											
											
												if($data_modulo_mandato>0 || $data_manual_mandato>0 ){
													echo"<div id=\"blocco_messaggi_invio\">";
													if($data_modulo_mandato>0){echo "- ".trans('userclaims.label_modulo_mandato').$data_modulo_mandato;} echo"<br>";
													if($data_manual_mandato>0){echo "- ".trans('userclaims.label_modulo_manuale').$data_manual_mandato;}
													echo"</div>";
													echo $mostra_modulo_step1;
												}
												?>
                                    </td>
                                    <td>
                                    	<?php 
											 if ($tendina_stato<1 || $tendina_stato>5) echo $msg_sezioni_2;
										
										?>
											 
										<p style="text-align: center;font-weight: bold;font-size: 13px;color:green;">
												<?php  if ($tendina_stato>0 && $tendina_stato<6) echo $stato_claim_cliente[$linguaclaim][1]; ?>
										</p>
                                   </td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td><img src="{{ asset('images/step3'.$img_sezione_3.'.png') }}"></td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_3') }}</p>
                                        <?php 
										
											$check_modulo=$claimsdoc->modulosinistro;
											$check_pir=$claimsdoc->pir;
											$check_scontrino=$claimsdoc->safebag_receipt;
											$valore_stato=$claimsclosed->closuretype;
											$date_end=date("d/m/Y",$claimsdoc->date_end);
											
											if ($valore_stato>0) echo"- ".trans('userclaims.label_gs_raccolta_inizio'). $data_modulo_mandato."<br>";
  	  										if ($valore_stato>1)echo "- ".trans('userclaims.label_gs_raccolta_fine'). $date_end;
										?>
                                    </td>
                                    <td>
                                    	<?php 
											 if ($tendina_stato<2 || $tendina_stato>5) echo $msg_sezioni_3;
											
										?>
											 
										<p style="text-align: center;font-weight: bold;font-size: 13px;color:green;">
												<?php  if ($tendina_stato>1 && $tendina_stato<6) echo $stato_claim_cliente[$linguaclaim][2]; ?>
										</p>
                                    </td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td><img src="{{ asset('images/step4'.$img_sezione_4.'.png') }}"></td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_4') }}</p>
                                        <?php 
										$trova_modquietanza_xlingua = array (0 => "_ModuloQuietanza_",1 => "_RefundRelease_");
										$trova_modquietanza_ext_xlingua = array (0 => "it",1 => "en");
										$mostra_modulo_step4="";
										for ($i = 0; $i < 2; $i++) {
											$tipo_modulo_step4=$trova_modquietanza_xlingua[$i];
											$trova_xlingua=$trova_modquietanza_ext_xlingua[$i];
										
											$mostra_modulo_step4.=Claimsdocs::searchmodule ($folder_claim,$claimcode,$tipo_modulo_step4,$step,$trova_xlingua,$folder_claimdummy);
										}
										
										$quietanza_mandata	=	0;
										$quietanza_manuale	=	0;
										
										if ( $claimsclosed->openingmail_quietanza>0)$quietanza_mandata=date("d/m/Y",$claimsclosed->openingmail_quietanza);
										if ( $claimsclosed->modmanuale_quietanza>0) $quietanza_manuale=date("d/m/Y",$claimsclosed->modmanuale_quietanza);
										$check_claim_in_closed= $claimsclosed->idclaim;
										$autorizzazione_confermata= $claimsclosed->autorizza_conferma;
										
										if($autorizzazione_confermata>0 && $tendina_stato>1 && $check_claim_in_closed>0 && ($quietanza_mandata>0 || $quietanza_manuale>0) ){ 
		
											echo"<div id=\"blocco_messaggi_invio\">";
											if($quietanza_mandata>0){echo "- ".trans('userclaims.label_modulo_mandato').$quietanza_mandata;} echo"<br>";
											if($quietanza_manuale>0){echo "- ".trans('userclaims.label_modulo_manuale').$quietanza_manuale;}
											echo"</div>";
											echo $mostra_modulo_step4;
										}
										?>
                                    </td>
                                    <td>
                                    	<?php 
											 if ($tendina_stato<3 || $tendina_stato>5) echo $msg_sezioni_4;
										
										?>
											 
										<p style="text-align: center;font-weight: bold;font-size: 13px;color:green;">
												<?php  if ($tendina_stato>2 && $tendina_stato<6) echo $stato_claim_cliente[$linguaclaim][3]; ?>
										</p>
                                    </td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td><img src="{{ asset('images/step5'.$img_sezione_5.'.png') }}"></td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_5') }}</p>
                                        <?php 
											$stato_quietanza= $claimsclosed->conferma_quietanza;
											$valore_stato=$claimsclosed->closuretype;
											$valore_iban=$claimsclosed->iban;
											$valore_swift=$claimsclosed->swift;
											$invio_quietanza_email=$claimsclosed->openingmail_quietanza;
											$invio_quietanza_mano=$claimsclosed->modmanuale_quietanza;
											$date_conferma_quietanza=$claimsclosed->date_conferma_quietanza;
											
											if($invio_quietanza_email>0){
												$invio_quietanza_email=date("d/m/Y",$invio_quietanza_email);
												echo "- ".trans('userclaims.label_quietanza_mandato').$invio_quietanza_email;}
												
											
										   if($invio_quietanza_mano>0){
												$invio_quietanza_mano=date("d/m/Y",$invio_quietanza_mano);
												echo "- ".trans('userclaims.label_quietanza_manuale').$invio_quietanza_mano;}
												echo "<br>";
										
											if ($stato_quietanza>0 && $date_conferma_quietanza>0){echo "- ".trans('userclaims.label_conferma_quietanzatrans').date("d/m/Y",$date_conferma_quietanza);}
										?>
                                    </td>
                                    <td>
                                    	<?php 
											 if ($tendina_stato<4 || $tendina_stato>5) echo $msg_sezioni_5;
										
										?>
											 
										<p style="text-align: center;font-weight: bold;font-size: 13px;color:green;">
												<?php  if ($tendina_stato>3 && $tendina_stato<6) echo $stato_claim_cliente[$linguaclaim][4]; ?>
										</p>
                                    </td>
                                   
                                </tr>
                                 <tr>
                                	
                                    <td><img src="{{ asset('images/step6'.$img_sezione_6.'.png') }}"></td>
                                    <td>
                                    	<p>{{ trans('userclaims.description_6') }}</p>
                                        <?php 
											$valore_stato=$claimsclosed->closuretype;
											$valore_iban=$claimsclosed->iban;
											$valore_swift=$claimsclosed->swift;
											$copia_bonifico=$claimsclosed->copia_bonifico;
											$lasteditdate=$claimsclosed->closuredate;
										?>
                                        <div id="blocco_messaggi_invio">
										  <?php
                                             if ($valore_stato>=5){
                                                echo"<div id=\"blocco_messaggi_invio\">";
                                                echo "- ".trans('userclaims.label_pagamento_ok'). " ". date("d/m/Y",$lasteditdate);
                                                echo"</div>";
                                                $tipo_modulo_step="safebag-pay";
                                                $folder_claim_docs="../../test-safebag/cmsafebag/gestionale-sinistri/sinistro/modules/".$anno_claim."/".$mese_claim."/".$claimcode."/docs/";
												
												$folder_claim_docs_dummy = "http://test.safe-bag.com/cmsafebag/gestionale-sinistri/sinistro/modules/" . $anno_claim . "/" . $mese_claim . "/" . $claimcode . "/docs/";

                                                echo $mostra_modulo_step1=Claimsdocs::searchdocumento($folder_claim_docs,$claimcode,$tipo_modulo_step,"2",$linguaclaim, $folder_claim_docs_dummy);
                                             }
                                             if ($valore_stato==4  && $tendina_stato<6)echo "- ".trans('userclaims.label_pagamento_no');
                                          ?>
                                        </div>
                                    </td>
                                    <td>
                                    	<?php 
											 if ($tendina_stato<5 || $tendina_stato>5) echo $msg_sezioni_6;
										
										?>
											 
										<p style="text-align: center;font-weight: bold;font-size: 13px;color:green;">
												<?php  if ($tendina_stato>4 && $tendina_stato<6) echo $stato_claim_cliente[$linguaclaim][5]; ?>
										</p>
                                    </td>
                                   
                                </tr>
                                
                            </tbody>
                        </table>
                          
                            </p>
                        </div>

                        <div id="tab-2">
                        	<h3></h3>
                            <hr />
                            <p>
                            <table class="mws-table">
                            	<thead>
                            	<tr>
                                	<th colspan="4">{{ trans('userclaims.flight_detail') }}<br /></th>
                                </tr>
                                </thead>
                                <tbody>
                            	<tr>
                                    <td><b>{{ trans('userclaims.depating_airport') }}</b><br />{{ $airportslist[$claimsbags[0]->depport] }}</td>
                                    <td><b>{{ trans('userclaims.depature') }}</b><br />{{ date('d/m/Y', $claimsbags[0]->depdate) }}</td>
                                    <td><b>{{ trans('userclaims.airline') }}</b><br />{{ $airportslist[$claimsbags[0]->iata] }}</td>
                                    <td><b>{{ trans('userclaims.stopover_airport2') }}</b><br />
                                    <?php if($claimsbags[0]->scalo2!=''){
										echo $airportslist[$claimsbags[0]->scalo2]; 
										//echo $claimsbags->scalo2; 
										
										}?>
                                    
                                    
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><b>{{ trans('userclaims.destination_airport') }}</b><br />{{ $airportslist[$claimsbags[0]->arrport] }}</td>
                                    <td><b>{{ trans('userclaims.arrival') }}</b><br />{{ date('d/m/Y', $claimsbags[0]->arrdate) }}</td>
                                    <td><b>{{ trans('userclaims.stopover_airport1') }}</b><br /><?php if($claimsbags[0]->scalo1!=''){echo $airportslist[$claimsbags[0]->scalo1]; }?></td>
                                    <td><b>{{ trans('userclaims.stopover_airport3') }}</b><br /><?php if($claimsbags[0]->scalo3!=''){echo $airportslist[$claimsbags[0]->scalo3]; }?></td>
                                   
                                </tr>
                                </tbody>
                                
                            </table>
                           
                            <table class="mws-table">
                            	<thead>
                            	<tr>
                                	<th colspan="2">{{ trans('userclaims.refund_detail') }}<br />{{ $claimsbags[0]->claimcode }}</th>
                                </tr>
                                </thead>
                                <tbody>
                            	<tr>
                                    <td><b>{{ trans('userclaims.ref_no') }}</b><br /></td>
                                    <td rowspan="5"><b>{{ trans('userclaims.note') }}</b><br /><textarea readonly="readonly">{{ $claimsbags[0]->notes }}</textarea></td>
                                </tr>
                                <tr>
                                    <td><b>{{ trans('userclaims.reporting_date') }}</b><br />{{ date('d/m/Y', $claimsbags[0]->sigdate) }}</td>
                                </tr>
                                <tr><?php $languagelist	=	array('en'=>'English','it'=>'Italian');?>
                                    <td><b>{{ trans('userclaims.refund_language') }}</b><br /><?php  
									if($claimsbags[0]->lingua_sinistro != '')
									echo $languagelist[$claimsbags[0]->lingua_sinistro]; ?></td>
                                </tr>
                                <tr>
                                
                                <?php 
									$requstmade	=	array('1'=>'Web Site','2'=>'Tele Phone','3'=>'Fax','4'=>'Email', '5'=>'APP');
								?>
                                    <td rowspan="2"><b>{{ trans('userclaims.refund_request_made_through') }}</b><br /><?php echo $requstmade[$claimsbags[0]->sigby] ?></td>
                                </tr>
                                
                                </tbody>
                                
                            </table>
                             
                            <table class="mws-table">
                            	<thead>
                            	<tr>
                                	<th colspan="2">{{ trans('userclaims.losr_or_damage_bags') }}<br /></th>
                                </tr>
                                </thead>
                                <tbody>
                            	<tr>
                                    <td>{{ trans('userclaims.safe_bag_code') }}<br /></td>
                                    <!--<td>{{ trans('userclaims.bage_arrived_without_damage') }}<br /></td>-->
                                    <td><b>{{ trans('userclaims.bag_lost') }}</b><br />{{ trans('userclaims.during_the_flight') }}</td>
                                    
                                    
                                </tr>
                                <tr>
                                    <td>{{ $claimsbags[0]->smartcardcode }}</td>
                                  
                                    <td><input type="radio" checked="checked" /></td>
                                    
                                   
                                </tr>
                                </tbody>
                                
                            </table>
                            
                            
                            	<?php /*?><?php
                            	echo "<pre>"; 
                            	print_r($claimsbags);
								echo "</pre>";
                            	?><?php */?>
                            </p>
                        </div>

                        <div id="tab-3">
                            <p>
                            	<h3>{{ trans('userclaims.flight_and_personal_information') }}</h3>
                            	<h6>{{ trans('userclaims.description_7') }}</h6>
                                <div id="errordiv"></div>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="safebag_receipt_tr">
                                	
                                    <td>{{ trans('userclaims.safe_bag_receipt') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref1_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('safebag_receipt') }}
                                        
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref1">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                </tr>
                                <tr id="airticket_tr">
                                    
                                    <td>{{ trans('userclaims.description_8') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref10_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('airticket') }}
                                        {{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    	
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref10">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                  
                                </tr>
                                <tr id="pir_tr">
                                    
                                    <td>{{ trans('userclaims.description_9') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref2_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('pir') }}
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref2">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                  
                                </tr>
                                 <tr id="police_complaint_tr">
                                   
                                    <td>{{ trans('userclaims.valid_id') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref3_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('police_complaint') }}
                                        {{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                    	{{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref3">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                  
                                </tr>
                                <tr id="modulosinistro_tr">
                                    
                                    <td>{{ trans('userclaims.description_10') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref4_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('modulosinistro') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref4">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                  
                                </tr>
                            </tbody>
                        </table>
                            </p>
                            
                            <p>
                            	<h3>{{ trans('userclaims.compensation_of_the_airline') }}</h3>
                            	<h6>{{ trans('userclaims.description_11') }}</h6>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="claim_airline_tr">
                                	
                                    <td>{{ trans('userclaims.airline_reimbursement_receipt') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref5_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('claim_airline') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref5">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                </tr>
                                <tr id="claim_airline2_transfer_tr">
                                    
                                    <td>{{ trans('userclaims.description_12') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref6_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('claim_airline2_transfer') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref6">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                  
                                </tr>
                                
                            </tbody>
                        </table>
                            </p>
                            
                            
                            <p>
                            	<h3>{{ trans('userclaims.details_on_delayed_baggage') }}</h3>
                            	<h6>{{ trans('userclaims.description_13') }}</h6>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="leaflet_tr">
                                	
                                    <td>{{ trans('userclaims.description_14') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref7_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('leaflet') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref7">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                </tr>
                                <tr id="bag_receipt_tr">
                                    
                                    <td>{{ trans('userclaims.description_15') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref8_form', 'enctype'=>'multipart/form-data' )) }}
                                    	<?php /*?>{{ Form::file('cost_reparations') }}<?php */?>
                                        {{ Form::file('bag_receipt') }}
                                    	
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref8">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                  
                                </tr>
                                
                            </tbody>
                        </table>
                            </p>
                        </div>
                          <div id="tab-4">
                             <p>
                             	  <p>
                            	<h3>{{ trans('userclaims.refund_release_form') }}</h3>
                            	<h6>{{ trans('userclaims.description_16') }}</h6>
                            	<table class="mws-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{ trans('userclaims.find') }}</th>
                                    <th>{{ trans('userclaims.load') }}</th>
                                    <th>{{ trans('userclaims.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<?php
								if($uploadrefuseform){
								?>
                                <tr id="conferma_quietanza_tr">
                                	
                                    <td>{{ trans('userclaims.refund_release_form') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsrefuse', 'class'=>'form-signup', 'id'=>'ref9_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('conferma_quietanza') }}
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxuploadrefuse(this);" id="ref9">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                </tr>
                                
                                <?php 
								}
								else{
								?>
                                <tr id="photo_tr">
                                	
                                    <td>{{ trans('userclaims.refund_release_form') }}</td>
                                    <td>
                                    	{{ Form::open(array('url'=>'users/addclaimsdoct', 'class'=>'form-signup', 'id'=>'ref9_form', 'enctype'=>'multipart/form-data' )) }}
                                    	{{ Form::file('photo') }}
                                    	{{ Form::hidden('idclaim',$claimsbags[0]->idclaim) }}
                                        {{ Form::close() }}
                                    </td>
                                    <td>
                                    <button type="submit" onclick="return ajaxupload(this);" id="ref9">{{ trans('userclaims.upload') }}</button></td>
                                    <td>{{ trans('userclaims.pending') }}</td>
                                    
                                </tr>
                                <?php 	
								}
								?>
                            </tbody>
                        </table>
                             </p>
                          </div>
                    </div>
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
            // jQuery-UI Tabs
    $.fn.tabs && $(".mws-tabs").tabs();
	$( document ).ready(function() {
	//console.log( "ready!" );
	<?php
	if(!empty($claimsdoc)){ 
		unset($claimsdoc['iddoc']);
		unset($claimsdoc['idclaim']);
		unset($claimsdoc['date']);
		unset($claimsdoc['date_end']);
	}
	else{
		$claimsdoc	=array();	
	}
	
	if(empty($claimsclosed)){
		$claimsclosed	=	array();	
	}
	
	//if()
	?>
		climsdoct	=	'<?php echo json_encode($claimsdoc); ?>';
		var parsed = JSON.parse(climsdoct);
		disableall	=	'<?php echo $stato_del_sinistro;?>';
		if(parsed != null){ 
			$.each(parsed, function( index, value ) {
				//alert(value);
				row		='#'+index+'_tr';	
				rowid	=	'#'+index+'_tr >td > button';
				$(rowid).html("{{ trans('userclaims.upload') }}");
				if(value == 1){
					//alert(value);
					$(row).find('td:last').html("{{ trans('userclaims.process') }}");
					//$(rowid).html("{{ trans('userclaims.process') }}");	
					//rowid	=	'#'+index+'_tr';	
					//($(rowid).html());
					//$(rowid).attr('disabled','disabled');
				}
				if(value == 2){
					$(rowid).attr('disabled','disabled');
					$(row).find('td:last').html("{{ trans('userclaims.finished') }}");
					//$(rowid).html("Upload");
				}
				if(value == 0){
					$(row).find('td:last').html("{{ trans('userclaims.pending') }}");
				}
				
				if(disableall >=2 ){
					$(rowid).attr('disabled','disabled');
					//$(row).find('td:last').html("{{ trans('userclaims.finished') }}");
				}
				
				//alert( index + ": " + value );
			});
		}
		
		claimsclosed	=	'<?php echo json_encode($claimsclosed); ?>';
		<?php
			if($uploadrefuseform){
		?>
			var parsed = JSON.parse(claimsclosed);
			if(parsed != null){ 
				$.each(parsed, function( index, value ) {
					//alert(value);
					//alert(index);
					row		='#'+index+'_tr';	
					rowid	=	'#'+index+'_tr >td > button';
					$(rowid).html("{{ trans('userclaims.upload') }}");
					if(value == 1){
						//alert(value);
						$(row).find('td:last').html("{{ trans('userclaims.process') }}");
						//$(rowid).html("{{ trans('userclaims.process') }}");	
						//rowid	=	'#'+index+'_tr';	
						//($(rowid).html());
						//$(rowid).attr('disabled','disabled');
					}
					if(value == 2){
						$(rowid).attr('disabled','disabled');
						$(row).find('td:last').html("{{ trans('userclaims.finished') }}");
						//$(rowid).html("Upload");
					}
					if(value == 0){
						$(row).find('td:last').html("{{ trans('userclaims.pending') }}");
					}
					
					
					
					//alert( index + ": " + value );
				});
			}
		<?php 
			}
		?>
		//alert(climsdoct);
	});
		  
	function ajaxupload(val){
		//alert();
		$(val).html("<img src="+"{{ asset('images/loading.gif') }}"+"   />&nbsp;&nbsp;"+"{{ trans('userlistflights.loading_message') }}");
		var	idclaim	=	'<?php echo $claimsbags[0]->idclaim;?>';
		$("#errordiv").html('');
		id	=	'#'+val.id+'_form'		;
		url	=	$( id ).attr( "action" );
		form	=	$( id );
		data	=	$( id ).serializeArray();
		$(id ).ajaxForm(function(result) {
			data	=	result;
			$(val).html("{{ trans('userclaims.upload') }}");
			
			
			if(data.redirect){
				window.location.href ="{{ URL::to('users/dashboard') }}	";
			}
			if(data.fail) {
				
			  $.each(data.errors, function( index, value ) {
				 // alert(value);
				  $( "#errordiv" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				   //$( "#mws-validate-error" ).show();
				   $("#"+val.id).parent('td').parent('tr').find('td:last').html("{{ trans('userclaims.pending') }}")
				   //$(val).html("Upload{{ trans('userclaims.your_claims') }}");
				   
				/*var errorDiv = '#'+index+'_error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  			  		           
			} 
			if(data.success){
				//$(val).html("{{ trans('userclaims.process') }}");
				//$(val).attr('disabled','disabled');
				$("#"+val.id).parent('td').parent('tr').find('td:last').html("{{ trans('userclaims.process') }}")
				$( id ).get(0).reset();
				//location.reload();
				//window.location.href ="{{ URL::to('users/listbags') }}	";
			}
			
			
			 
		}).submit();
		//var token = $('#search > input[name="_token"]').val();
		//data.splice('_token', 1);
		
		return false;
	}
	
	function ajaxuploadrefuse(val){
		//alert();
		$(val).html("<img src="+"{{ asset('images/loading.gif') }}"+"   />&nbsp;&nbsp;"+"{{ trans('userlistflights.loading_message') }}");
		var	idclaim	=	'<?php echo $claimsbags[0]->idclaim;?>';
		$("#errordiv").html('');
		id	=	'#'+val.id+'_form'		;
		url	=	$( id ).attr( "action" );
		form	=	$( id );
		data	=	$( id ).serializeArray();
		$(id ).ajaxForm(function(result) {
			data	=	result;
			$(val).html("{{ trans('userclaims.upload') }}");
			
			
			if(data.redirect){
				window.location.href ="{{ URL::to('users/dashboard') }}	";
			}
			if(data.fail) {
				
			  $.each(data.errors, function( index, value ) {
				 // alert(value);
				  $( "#errordiv" ).append( '<div class="alert alert-danger">'+value+'</div>' );
				   //$( "#mws-validate-error" ).show();
				   $("#"+val.id).parent('td').parent('tr').find('td:last').html("{{ trans('userclaims.pending') }}")
				   //$(val).html("Upload{{ trans('userclaims.your_claims') }}");
				   
				/*var errorDiv = '#'+index+'_error';
				$(errorDiv).addClass('required');
				$(errorDiv).empty().append(value);*/
			  });
			  			  		           
			} 
			if(data.success){
				//$(val).html("{{ trans('userclaims.process') }}");
				//$(val).attr('disabled','disabled');
				$("#"+val.id).parent('td').parent('tr').find('td:last').html("{{ trans('userclaims.process') }}")
				$( id ).get(0).reset();
				//location.reload();
				//window.location.href ="{{ URL::to('users/listbags') }}	";
			}
			
			
			 
		}).submit();
		//var token = $('#search > input[name="_token"]').val();
		//data.splice('_token', 1);
		
		return false;
	}
  </script>