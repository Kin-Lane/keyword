<?php
$route = '/keyword/:keyword_id/';
$app->delete($route, function ($keyword_id) use ($app){

	$Add = 1;
	$ReturnObject = array();

 	$request = $app->request();
 	$_POST = $request->params();

	$query = "DELETE FROM keyword WHERE ID = " . $keyword_id;
	//echo $query . "<br />";
	mysql_query($query) or die('Query failed: ' . mysql_error());

	});	
 ?>
