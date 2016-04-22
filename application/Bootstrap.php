<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initPlaceholders()
	{

		$this->bootstrap('View');
		$view = $this->getResource('View');
		$view->headTitle('Blogy')->setSeparator(' :: ');
		$view->headLink()->appendStylesheet('/static/css/bootstrap.css');
		$view->headLink()->appendStylesheet('/static/css/style.css');
		$view->headScript()->appendFile('/static/js/jquery-2.2.0.min.js');
		$view->headScript()->appendFile('/static/js/bootstrap.js');
		$view->headScript()->appendFile('/static/js/script.js');
	}

}
