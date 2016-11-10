<?php

class Claimsdocs extends Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'claims_docs';
	
	
	public $timestamps = false;
	public $incrementing = true;
	public $primaryKey ='iddoc';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	
	
	
	public function claims()
    {
        return $this->hasOne('Claims', 'idclaim', 'idclaim');
    }
	
	
	public static function getDocdefinition(){
		$returnarray	=	array(
								"modulosinistro" => "Modulo Firmato",
								"airticket" => "Biglietto aereo",
								"pir" => "Rapporto di irregolarit&agrave;",
								"safebag_receipt" => "Scontrino Safe Bag S.p.A",
								"leaflet" => "Volantino contrattuale",
								"claim_airline" => "Risarcimento dell\'aerolinea",
								"claim_airline2_transfer" => "Bonifico o assegno ricevuto",
								"police_complaint" => "Documento identit&agrave;",
								"bag_receipt" => "Lettera di vettura del corriere che ha provveduto alla riconsegna del bagaglio",
								"cost_reparations" => "Documento rilasciato dalla compagnia aerea al momento del ritiro del bagaglio",
								"irreparable" => "Lettera di vettura del corriere in caso di invio di una nuova valigia sostitutiva",
								"photo" => "Foto del danno"
								/*"modulosinistro" => "Modulo Firmato",			
								'safebag_receipt'=>'Scontrino SB',
								'airticket'=>'Carte di imbarco',
								'pir'=>'PIR',
								'leaflet'=>'Leaflet',
								'claim_airline'=>'Liberatoria',
								'claim_airline2_transfer'=>'Copia di Risarcimento',
								'police_complaint'=>'Id valido',
								'bag_receipt'=>'Fatture',
								'cost_reparations'=>'Costo della reparazione',
								'photo'=>'Foto',*/
								
							);	
							
		return $returnarray;
	}
	
	public static function getDocdefinitionupload(){
		$returnarray	=	array(
								'modulosinistro'=>'Modulo di Risarcimento',
								//"modulosinistro" => "Modulo Firmato",			
								'safebag_receipt'=>'Scontrino SB',
								'airticket'=>'Carte di imbarco',
								'pir'=>'PIR',
								'leaflet'=>'Leaflet',
								'claim_airline'=>'Liberatoria',
								'claim_airline2_transfer'=>'Copia di Risarcimento',
								'police_complaint'=>'Id valido',
								'bag_receipt'=>'Delivery Bag',
								'cost_reparations'=>'Pick up Bag',
								'photo'=>'Foto',
								'irreparable'=>'Documento irreparable',
								
							);	
							
		return $returnarray;
	}
	
	/**BLOCCO CHE TROVA I MODULI DI OGNI STEP**/
	public static function searchmodule($folder_claim,$claimcode,$tipo_modulo,$step, $trova_xlingua, $folder_claimdummy){
		$documento_trovato	=	'';
		if (file_exists($folder_claim)) {
			$module_dir = opendir($folder_claim);
			rewinddir($module_dir);
			$documento_trovato="";
			
			$download = array (
					"it"  => array (1=> " Puoi scaricare la documentazione qui: ".$tipo_modulo.$claimcode),
					"en" => array (1=> " You can download the documentation here: ".$tipo_modulo.$claimcode)
			);
			
			$linguaclaim	=	Session::get('lang');
			
			while(($file = readdir($module_dir))) {
				$trova="_.$claimcode._";
				if (preg_match("$trova", $file)) {
					$file2=$file;
					$trova_mod=$tipo_modulo;
			
					if (preg_match("$trova_mod", $file2)) {
						$check_file=$file2;
						$delete_modulo=$folder_claim."/".$file2;
			
						$documento_trovato.="<input name=\"modulefile_step_".$step."\" type=\"hidden\" value=\"$delete_modulo\" />";
						$documento_trovato.="<div style=\"float:left;width:90%;\"><ul style=\"padding:0;padding-left:13px;\"><li><a href=\"".$folder_claimdummy."/".$file2."\" target=\"_blank\" class=\"link_modulo\">".$download[$linguaclaim][1]."</a></li></ul></div>";
						 
						//$documento_trovato.="<div style=\"float:right;height:15px;width:5%;padding-top:10px;\"><input name=\"del_module_step".$step."\" type=\"submit\"  class=\"bottone_sinistro_delete\" /></div>";
					}
				}
			}
		}
		return $documento_trovato;
	}
	
	//public static  $output='';
	
	public static function searchdocumento_new($folder_claim_docs_list, $folder_claim,$claimcode,$tipo_modulo,$stato_delete,$linguaclaim,$folder_claim_docs_dummy){
		$documento_trovato	=	'';
		$arrayfile	=	explode('$%^&*',$folder_claim_docs_list);
		if (!empty($arrayfile)) {
			$formcount	=	1;
			foreach($arrayfile as $file) {
				if (preg_match("/$tipo_modulo\\b/", $file)) {
						$check_file=$file;
						$file_links = explode("_", $check_file);
						//$file_link = $file_link[1].$file_link[2].$file_link[3];
						$k=0;
						$file_link	=	'';
						foreach($file_links as $linkdummy){
							if($k != 0){
								$file_link.=$linkdummy;	
							}
							$k++;
						}
						//$file_link = str_replace('_','',$check_file);
						//file_link = $file_link[1].$file_link[2].$file_link[3];
						
						$delete_modulo=$folder_claim."/".$file;
						$documento_trovato.="<form  action=\"\" method=\"post\" id=\"".$formcount.$tipo_modulo."docform\" name=\"docs\"  >";
						$documento_trovato.="<input name=\"_token\" type=\"hidden\" value='".csrf_token()."' />";
						$documento_trovato.="<input name=\"docclaimcode\" type=\"hidden\" value='".$claimcode."' />";
						$documento_trovato.="<input name=\"file_pir\" type=\"hidden\" value=\"$delete_modulo\" />";
						$documento_trovato.="<div style=\"float:left;width:80%;padding-top:5px;\">- <a href=\"".$folder_claim_docs_dummy."/".$file."\" target=\"_blank\" class=\"link_modulo\">".$file_link."</a></div>";
						
						if ($stato_delete<2)
						{
						$documento_trovato.="<div style=\"float:left;width:10%;padding-top:2px;\"><input name=\"del_module_pir\" type=\"submit\"  onclick=\"return  confirmDelete(this)\" class=\"bottone_sinistro_delete_xs\" id=\"".$formcount.$tipo_modulo."doc\" value=\"\" /></div><div style=\"clear:both;\"></div>";
						//$documento_trovato.="<div style=\"float:left;width:10%;padding-top:2px;\"><a name=\"del_module_pir\" type=\"submit\"  onclick=\"return  confirmDelete(this)\" class=\"bottone_sinistro_delete_xs\" id=\"".$formcount.$tipo_modulo."doc\" href=\"#\" />X</a></div><div style=\"clear:both;\"></div>";
						}
						
						$documento_trovato.="<input type=\"hidden\" name=\"loadtab\" value=\"3\">";
						$documento_trovato.="<input type=\"hidden\" name=\"qualedoc\" value=\"$file_link\">";
						$documento_trovato.="</form>";
				}	
				$formcount++;
			}
		}
		return $documento_trovato;
	}
	
	
	/**BLOCCO CHE TROVA I MODULI DI OGNI STEP**/
	public static function searchmoduleold($folder_claim,$claimcode,$tipo_modulo,$step, $trova_xlingua, $folder_claimdummy){
		$documento_trovato	=	'';
		if (file_exists($folder_claim)) {
			$module_dir = opendir($folder_claim);
			rewinddir($module_dir);
			$documento_trovato="";
			
			$download = array (
					"it"  => array (1=> " Puoi scaricare la documentazione qui: ".$tipo_modulo.$claimcode),
					"en" => array (1=> " You can download the documentation here: ".$tipo_modulo.$claimcode)
			);
			
			$linguaclaim	=	Session::get('lang');
			
			while(($file = readdir($module_dir))) {
				$trova="_.$claimcode._";
				if (preg_match("$trova", $file)) {
					$file2=$file;
					$trova_mod=$tipo_modulo;
			
					if (preg_match("$trova_mod", $file2)) {
						$check_file=$file2;
						$delete_modulo=$folder_claim."/".$file2;
			
						$documento_trovato.="<input name=\"modulefile_step_".$step."\" type=\"hidden\" value=\"$delete_modulo\" />";
						$documento_trovato.="<div style=\"float:left;width:90%;\"><ul style=\"padding:0;padding-left:13px;\"><li><a href=\"".$folder_claimdummy."/".$file2."\" target=\"_blank\" class=\"link_modulo\">".$download[$linguaclaim][1]."</a></li></ul></div>";
						 
						//$documento_trovato.="<div style=\"float:right;height:15px;width:5%;padding-top:10px;\"><input name=\"del_module_step".$step."\" type=\"submit\"  class=\"bottone_sinistro_delete\" /></div>";
					}
				}
			}
		}
		return $documento_trovato;
	}
	
	
	public static function searchdocumento($folder_claim,$claimcode,$tipo_modulo,$stato_delete,$linguaclaim,$folder_claim_docs_dummy){
		$documento_trovato	=	'';
		if (file_exists($folder_claim)) {

			$module_dir = opendir($folder_claim);
			rewinddir($module_dir);
			$documento_trovato="";
			$formcount	=	1;
			while(($file = readdir($module_dir))) {
				if (preg_match("/$tipo_modulo\\b/", $file)) {
						$check_file=$file;
						$file_links = explode("_", $check_file);
						//$file_link = $file_link[1].$file_link[2].$file_link[3];
						$k=0;
						$file_link	=	'';
						foreach($file_links as $linkdummy){
							if($k != 0){
								$file_link.=$linkdummy;	
							}
							$k++;
						}
						//$file_link = str_replace('_','',$check_file);
						//file_link = $file_link[1].$file_link[2].$file_link[3];
						
						$delete_modulo=$folder_claim."/".$file;
						$documento_trovato.="<form  action=\"\" method=\"post\" id=\"".$formcount.$tipo_modulo."docform\" name=\"docs\"  >";
						$documento_trovato.="<input name=\"_token\" type=\"hidden\" value='".csrf_token()."' />";
						$documento_trovato.="<input name=\"docclaimcode\" type=\"hidden\" value='".$claimcode."' />";
						$documento_trovato.="<input name=\"file_pir\" type=\"hidden\" value=\"$delete_modulo\" />";
						$documento_trovato.="<div style=\"float:left;width:80%;padding-top:5px;\">- <a href=\"".$folder_claim_docs_dummy."/".$file."\" target=\"_blank\" class=\"link_modulo\">".$file_link."</a></div>";
						
						if ($stato_delete<2)
						{
						$documento_trovato.="<div style=\"float:left;width:10%;padding-top:2px;\"><input name=\"del_module_pir\" type=\"submit\"  onclick=\"return  confirmDelete(this)\" class=\"bottone_sinistro_delete_xs\" id=\"".$formcount.$tipo_modulo."doc\" value=\"\" /></div><div style=\"clear:both;\"></div>";
						//$documento_trovato.="<div style=\"float:left;width:10%;padding-top:2px;\"><a name=\"del_module_pir\" type=\"submit\"  onclick=\"return  confirmDelete(this)\" class=\"bottone_sinistro_delete_xs\" id=\"".$formcount.$tipo_modulo."doc\" href=\"#\" />X</a></div><div style=\"clear:both;\"></div>";
						}
						
						$documento_trovato.="<input type=\"hidden\" name=\"loadtab\" value=\"3\">";
						$documento_trovato.="<input type=\"hidden\" name=\"qualedoc\" value=\"$file_link\">";
						$documento_trovato.="</form>";
				}	
				$formcount++;
			}
		}
		return $documento_trovato;
	}
	

}
