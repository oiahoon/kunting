<?php

App::uses('AppHelper', 'View/Helper');

/**
 * MoxieManager Helper
 *
 * PHP version 5
 *
 * @category MoxieManager.Helper
 * @package  MoxieManager.View.Helper
 * @version  1.5
 * @author   Paul Gardner <phpmagpie@webbedit.co.uk>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class MoxieManagerHelper extends AppHelper {

/**
 * Other helpers used by this helper
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html',
		'Js',
	);
		
/**
 * Actions
 *
 * Format: ControllerName/action_name => settings
 *
 * @var array
 */
	public $actions = array();

/**
 * beforeRender
 *
 * @param string $viewFile
 * @return void
 */
 	public function beforeRender($viewFile) {
 		if (is_array(Configure::read('Wysiwyg.actions'))) {
 			$this->actions = Hash::merge($this->actions, Configure::read('Wysiwyg.actions'));
 		}
 		$action = Inflector::camelize($this->params['controller']) . '/' . $this->params['action'];
 		if ($action === 'MoxieManager/admin_index') {
 			$this->Html->script(
 		    array('/MoxieManager/js/moxman.loader.min'),
 		    array('inline' => false)
 		  );
 		} elseif (Configure::read('Writing.wysiwyg') && isset($this->actions[$action])) {
 		  $this->_CroogoPlugin = new CroogoPlugin();
 		  if ($this->_CroogoPlugin->isActive('ckeditor')) {
 	  	  Configure::write('Js.Wysiwyg.attachmentsPath', Router::url('/MoxieManager/ckeditor.php'));
 		  } elseif ($this->_CroogoPlugin->isActive('tinymce')) {
        $this->Html->scriptBlock('$(document).ready(function() {
          tinymce.PluginManager.load("moxiemanager", "/MoxieManager/plugin.min.js");
        });', array('inline' => false));
        
        Croogo::mergeConfig('Tinymce.defaults', array('extra_plugins'=>'moxiemanager'));
 		  }
 		}
 	}
}
