<?php
class ErrorsController extends SparkPlugAppController {

	var $name = 'Errors';
	var $uses = array();
	
	function unauthorized(){
		//TODO: make this code more cake compliant - this should go inside the layout
		header('HTTP/1.1 401 Unauthorized');
	}
}
?>