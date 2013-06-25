<?php

App::uses('MoxieManagerAppController', 'MoxieManager.Controller');

/**
 * MoxieManager Controller
 *
 * PHP version 5
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Paul Gardner <phpmagpie@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class MoxieManagerController extends MoxieManagerAppController {

/**
 * Controller name
 *
 * @var string
 * @access public
 */
	public $name = 'MoxieManager';
	
/**
 * Models used by the Controller
 *
 * @var array
 * @access public
 */
	public $uses = array();
	
  function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->allow('auth');
  }

/**
 * admin_index
 *
 * @return void
 */
	public function admin_index() {
		$this->set('title_for_layout', 'Attachments (Moxie Manager)');
	}
	
/**
 * admin_auth
 *
 * @return void
 */
	public function auth() {
		die('{"result" : {
  	  	"filesystem.rootpath" : "../../../../webroot/uploads",
  	  	"filesystem.local.wwwroot" : "/full/path/to/public_html/webroot/"
	  	}}');
	  	
	  Configure::write('debug', 0);
	  $secretKey = "18sdtadmin40";
	  if (!$secretKey) {
	  	die('{"error" : {"message" : "No secret key set.", "code" : 130}}');
	  }
	  if (!isset($_REQUEST["hash"]) || !isset($_REQUEST["seed"])) {
	  	die('{"error" : {"message" : "Error in input.", "code" : 120}}');
	  }
	  if (!$this->Session->check('Auth.User.id')) {
	  	die('{"error" : {"message" : "Not authenticated.", "code" : 180}}');
	  }
	  
	  $hash = $_REQUEST["hash"];
	  $seed = $_REQUEST["seed"];
	  
	  $localHash = hash_hmac('sha256', $seed, $secretKey);
	  
	  if ($hash == $localHash) {
	  	// Hard code some rootpath, get something from sessions etc.
	  	die('{"result" : {
  	  	"filesystem.rootpath" : "../../../../webroot/uploads",
  	  	"filesystem.local.wwwroot" : "/full/path/to/public_html/webroot/"
	  	}}');
	  } else {
	  	die('{"error" : {"message" : "Error in input.", "code" : 120}}');
	  }
	}

}
