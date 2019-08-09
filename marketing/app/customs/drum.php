<?php
namespace App\customs;
class drum {

  private $accessNumbers = [];
  public $session = '';
  public $meetingsid = '';
  public $room = "";
  public $test = [];

  public  function __construct()
    {
    $this->getNumbers();
    }

  public  function run($orgamizer, $orgamizerEmail, $meetingTitle, $meetingRoom,$time)
    {
    $this->createSession($orgamizer, $orgamizerEmail, $meetingTitle, $meetingRoom,$time);
   
    }



  public  function createSession($orgamizer, $orgamizerEmail, $meetingTitle, $meetingRoom,$time)
    {
        $ch = curl_init();
    $data = array(
      'userRef' => $orgamizerEmail,
      'displayName' => $orgamizer,
      'role' => 'chair'
    );
    $jsond = json_encode($data);
    $url = 'https:/thisisdrum.com/drum-meeting-daemon/accounts/anthonykariuki1/sessions';
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsond);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'content-type: application/json',
      'Keep-alive: 300000',
      'Connection: keep-alive',
      'authorization:0d4fb3f2-9a36-4a33-ace1-d2f5ac1285d8'
    ));
    $result = curl_exec($ch);
    if ($result)
      {
      $jason = json_decode($result, true);
    //  $this->test = $jason;
      $this->session = $jason['sessionToken'];
           
        $this->createMetting($orgamizer, $orgamizerEmail, $meetingTitle, $meetingRoom,$time);
      }
    }

  public  function createMetting($orgamizer, $orgamizerEmail,$meetingTitle,$meetingRoom,$time)
    {
    $ch = curl_init();
    $data = array(
      'type' => 'web',
      'organiser' =>$orgamizerEmail,
      'displayName' =>$orgamizer,
      'room' =>'test',
      'name' =>'test',
      'role' => 'chair',
      'recordMeeting'=>true,
      'duration' => 300000,
      'accessNumbers' => $this->accessNumbers,

      // 'chairPin'=>$this->Profile->getUser_email_firstname($userId)->drumChairPin,
      // 'guestPin'=>$this->Profile->getUser_email_firstname($userId)->drumGuestPin,

      'lectureMode' => true,
      'startTime' => $time//'2018-10-14T08:00:00'
    );
    $jsond = json_encode($data);
    $url = 'https://thisisdrum.com/drum-meeting-daemon/v1/meetings';
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'content-type: application/json',
      'Keep-alive: 300000',
      'Connection: keep-alive',
      'authorization:'.$this->session
    ));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsond);
    $result = curl_exec($ch);
    curl_close($ch);
    if ($result)
      {
 
      $jason = json_decode($result, true);
       $this->test = $jason;     


     //$this->meetingsid = $jason['meeting']['id'];
      }
    }

  public  function getNumbers()
    {
    $this->accessNumbers = array(
      0 => array(
        'name' => 'USA',
        'routingNumber' => '13476309869',
        'displayNumber' => '+13476309869',
        'timeZone' => 'US/Central'
      ) ,
      1 => array(
        'name' => 'Canada',
        'routingNumber' => '16474900079',
        'displayNumber' => '+16474900079',
        'timeZone' => 'Canada/Central'
      ) ,
      2 => array(
        'name' => 'Netherlands',
        'routingNumber' => '31202620139',
        'displayNumber' => '+31202620139',
        'timeZone' => 'Europe/Amsterdam'
      ) ,
      3 => array(
        'name' => 'Belgium',
        'routingNumber' => '3228943334',
        'displayNumber' => '+3228943334',
        'timeZone' => 'Europe/Brussels'
      ) ,
      4 => array(
        'name' => 'France',
        'routingNumber' => '33368912471',
        'displayNumber' => '+33368912471',
        'timeZone' => 'Europe/Paris'
      ) ,
      5 => array(
        'name' => 'Spain',
        'routingNumber' => '34931767621',
        'displayNumber' => '+34931767621',
        'timeZone' => 'Europe/Madrid'
      ) ,
      6 => array(
        'name' => 'Ireland',
        'routingNumber' => '35319079760',
        'displayNumber' => '+35319079760',
        'timeZone' => 'Europe/Dublin'
      ) ,
      7 => array(
        'name' => 'UK',
        'routingNumber' => '442070789113',
        'displayNumber' => '+442070789113',
        'timeZone' => 'Europe/London'
      ) ,
      8 => array(
        'name' => 'Germany',
        'routingNumber' => '4930255555768',
        'displayNumber' => '+4930255555768',
        'timeZone' => 'Europe/Berlin'
      ) ,
      9 => array(
        'name' => 'Australia',
        'routingNumber' => '61386090053',
        'displayNumber' => '+61386090053',
        'timeZone' => 'Australia/Canberra'
      )
    );
    }
  }
