<?php
	if(isset($_GET['id'])){
	   require_once VIEWS.'instructions/'.$_GET['id'].'.php';
	}
?>