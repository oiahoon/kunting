<?php

CroogoNav::add('media.children.attachments', array(
	'title' => __d('croogo', 'Attachments'),
	'url' => array(
		'admin' => true,
		'plugin' => 'moxie_manager',
		'controller' => 'moxie_manager',
		'action' => 'index',
	),
));

Croogo::hookHelper('*', 'MoxieManager.MoxieManager');
