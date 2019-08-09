<?php
namespace App\customs;
 
/* 
Aouthor Anthony Kariuki 
connec to sparkpost API and send retrieve data */

class sparkpost {

	private $sp_url;
	public $api_token='';

	public function __construct(){	
		$this->sp_url = 'https://api.sparkpost.com/api/v1';
		
	}
    
     
	public function sp_create($url, $json){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sp_url.$url); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  'Content-Type: application/json',
		  'Authorization: '.$this->api_token
		));
		$response = curl_exec($ch);
		curl_close($ch);

		
		return json_decode($response);
	}

	public function sp_update($url, $json){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sp_url.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Content-Type: application/json",
		  "Authorization: ".$this->api_token
		));
		$response = curl_exec($ch);
		curl_close($ch);

		return json_decode($response);
	}

	public function sp_get($url){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sp_url.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Authorization: ".$this->api_token,
		  "Accept: application/json"
		));
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response);
		
	}

	public function sp_delete($url){
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->sp_url.$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		  "Authorization: ".$this->api_token
		));
		$response = curl_exec($ch);
		curl_close($ch);
		return json_decode($response);
	}
	

	// TEMPLATE FUNCTIONS

	public function createTemplate($json){
		
		$url="/templates";
		return $this->sp_create($url, $json);

	}

	public function updateTemplate($template_id, $json){

		$url="/templates/".$template_id."?update_published=true";
		$this->sp_update($url, $json);
	}

	public function retrieveTemplates(){

		$url="/templates/";
		return $this->sp_get($url);
	}

	public function retrieveTemplate($template_id){

		$url="/templates/".$template_id."?show_recipients=true";
		return $this->sp_get($url);
	}

	public function deleteTemplate($template_id){

		$url = "/templates/".$template_id;
		return $this->sp_delete($url);
	}



	// RECIPIENT LIST FUNCTIONS

	public function createRecipientList($json){

		$url = "/recipient-lists";
		$this->sp_create($url, $json);
	}

	public function updateRecipientList($list_id, $json){
		
		$url = "/recipient-lists/".$list_id."?num_rcpt_errors=3";
		return $this->sp_update($url, $json);

	}
	
	public function retrieveRecipientList($list_id){

		$url = "/recipient-lists/".$list_id."?show_recipients=true";
		return $this->sp_get($url);
	}

	public function retrieveRecipientLists(){

		$url = "/recipient-lists/";
		return $this->sp_get($url);
	}

	public function deleteRecipientList($list_id){

		$url = "/recipient-lists/".$list_id;
		return $this->sp_delete($url);
	}

	
	// TRANSMISSION FUNCTIONS createTransmission($list_id, $template_id, $campaign_id, $name, $start_time)

	public function createTransmission($list_id, $template_id, $name, $start_time){
		
		$arr = array(
		    "options"=>array(
		      "open_tracking"=>true,
		      "click_tracking"=>true,
		      "start_time"=>$start_time
		    ),
		    "description"=>$name,
		    //"campaign_id"=>$campaign_id,
		    "return_path"=>"info@tickle-media.com",
		    "recipients"=>array(
		        "list_id"=>$list_id
		    ),
		    "content"=>array(
		        "template_id"=>$template_id 
		    )
		);

		$json = json_encode($arr);
		$url = "/transmissions?num_rcpt_errors=3";
		return $this->sp_create($url, $json);
	}

	public function createMailshotTransmission($list_id, $template_id, $campaign_id){
		
		$arr = array(
		    "options"=>array(
		      "open_tracking"=>true,
		      "click_tracking"=>true
		    ),
		    "campaign_id"=>$campaign_id,
		    "return_path"=>"info@tickle-media.com",
		    "recipients"=>array(
		        "list_id"=>$list_id
		    ),
		    "content"=>array(
		        "template_id"=>$template_id 
		    )
		);

		$json = json_encode($arr);
		$url = "/transmissions?num_rcpt_errors=3";
		return $this->sp_create($url, $json);
	}

	public function createSingleTransmission($json){
		
		$url = "/transmissions?num_rcpt_errors=3";
		return $this->sp_create($url, $json);
	}

	public function retrieveTransmission($transmission_id){
		
		$url="/transmissions/".$transmission_id;
		return $this->sp_get($url);
	}

	public function retrieveTransmissions($campaign_id){
		
		$url="/transmissions?campaign_id=".$campaign_id;
		return $this->sp_get($url);
	}

	public function deleteTransmission($transmission_id){

		$url = "/transmissions/".$transmission_id;
		return $this->sp_delete($url);
	}




}