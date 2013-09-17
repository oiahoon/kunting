<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apns extends CI_Controller {
  
  function __construct(){
    parent::__construct();
    $this->load->Model('apns_model','apns');
  }

  function index()
  {
      $this->load->library('apn');
      $this->apn->payloadMethod = 'enhance'; // you can turn on this method for debuggin purpose
      $this->apn->connectToPush();
      $devices = $this->apns->getDevices();
      // print_r($devices);

      // adding custom variables to the notification
      $this->apn->setData(array('url'=>'http://jiutianyoubang.cn/p/1234.json1111111111' ));
      $device_token = "435c4ee00e7c3ccd3ea4fa28818acfc623928f56aba05714c170f5cb306ef712";
      $msg = 'Test notif #6 (TIME:'.date('H:i:s').')';
      $msg .= "您的未读邮件数过多您的未读邮件数过多您的";
      echo strlen($msg.'http://jiutianyoubang.cn/p/1234.json111111111');
      $send_result = $this->apn->sendMessage($device_token, $msg, /*badge*/ 99, /*sound*/ 'default'  );

      if($send_result){
        echo "Sending successful";
        log_message('debug','Sending successful');
      }
      else{
        show_error($this->apn->error);
        log_message('error',$this->apn->error);
      }
      $this->apn->disconnectPush();
  }

  function send_notifications()
  {
      $this->load->library('apn');
      $this->apn->payloadMethod = 'enhance'; // you can turn on this method for debuggin purpose
      $this->apn->connectToPush();

      // adding custom variables to the notification
      $this->apn->setData(array( 'someKey' => true ));

      $send_result = $this->apn->sendMessage($device_token, 'Test notif #1 (TIME:'.date('H:i:s').')', /*badge*/ 2, /*sound*/ 'default'  );

      if($send_result)
          log_message('debug','Sending successful');
      else
          log_message('error',$this->apn->error);


      $this->apn->disconnectPush();
  }

  // designed for retreiving devices, on which app not installed anymore
  public function apn_feedback()
  {
      $this->load->library('apn');

      $unactive = $this->apn->getFeedbackTokens();

      if (!count($unactive))
      {
          log_message('info','Feedback: No devices found. Stopping.');
          return false;
      }

      foreach($unactive as $u)
      {
          $devices_tokens[] = $u['devtoken'];
      }

      /*
      print_r($unactive) -> Array ( [0] => Array ( [timestamp] => 1340270617 [length] => 32 [devtoken] => 002bdf9985984f0b774e78f256eb6e6c6e5c576d3a0c8f1fd8ef9eb2c4499cb4 ) ) 
      */
  }
}