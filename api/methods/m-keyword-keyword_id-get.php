<?php
$route = '/keyword/:keyword_id/';
$app->get($route, function ($keyword_id)  use ($app){


	$ReturnObject = array();

	$Query = "SELECT * FROM keyword WHERE ID = " . $keyword_id;

	$DatabaseResult = mysql_query($Query) or die('Query failed: ' . mysql_error());

	while ($Database = mysql_fetch_assoc($DatabaseResult))
		{
		$keyword_id = $Database['keyword_id'];
		$keyword = $Database['keyword'];
		$description = $Database['description'];
		$url = $Database['url'];

		// manipulation zone

		$F = array();
		$F['keyword_id'] = $keyword_id;
		$F['keyword'] = $keyword;
		$F['description'] = $description;
		$F['url'] = $url;

		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo format_json(json_encode($ReturnObject));
	});
 ?>
