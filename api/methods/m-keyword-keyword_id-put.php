<?php
$route = '/keyword/:keyword_id/';
$app->put($route, function ($keyword_id) use ($app){

	$ReturnObject = array();

 	$request = $app->request();
 	$params = $request->params();

	if(isset($params['keyword'])){ $keyword = mysql_real_escape_string($params['keyword']); } else { $keyword = 'nothing'; }
	if(isset($params['description'])){ $description = mysql_real_escape_string($params['description']); } else { $description = ''; }
	if(isset($params['url'])){ $url = mysql_real_escape_string($params['url']); } else { $url = ''; }

  	$Query = "SELECT * FROM keyword WHERE ID = " . $keyword_id;
	//echo $Query . "<br />";
	$Database = mysql_query($Query) or die('Query failed: ' . mysql_error());

	if($Database && mysql_num_rows($Database))
		{
		$query = "UPDATE keyword SET";

		$query .= " keyword = '" . mysql_real_escape_string($keyword) . "'";

		if($description!='') { $query .= ", description = '" . $description . "'"; }
		if($url!='') { $query .= ", url = '" . $url . "'"; }

		$query .= " WHERE keyword_id = '" . $keyword_id . "'";

		//echo $query . "<br />";
		mysql_query($query) or die('Query failed: ' . mysql_error());
		}

	$F = array();
	$F['keyword_id'] = $keyword_id;
	$F['keyword'] = $keyword;
	$F['description'] = $description;
	$F['url'] = $url;

	array_push($ReturnObject, $F);

	$app->response()->header("Content-Type", "application/json");
	echo stripslashes(format_json(json_encode($ReturnObject)));

	});
 ?>
