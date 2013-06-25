<?php
$this->set('showActions', false);
$this->extend('/Common/admin_index');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb('Attachments (Moxie Manager)', array('controller' => 'moxie_manager', 'action' => 'index'));
?>

<a href="javascript:moxman.browse();" class="btn btn-success">Browse</a>