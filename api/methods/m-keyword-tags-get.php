<?php
$route = '/keyword/tags/';
$app->get($route, function ()  use ($app){

	$ReturnObject = array();

 	$request = $app->request();
 	$params = $request->params();

	$Query = "SELECT t.Tag_ID, t.Tag, count(*) AS API_Count from tags t";
	$Query .= " INNER JOIN keyword_tag_pivot btp ON t.Tag_ID = btp.Tag_ID";
	$Query .= " GROUP BY t.Tag ORDER BY count(*) DESC";

	$DatabaseResult = mysql_query($Query) or die('Query failed: ' . mysql_error());

	while ($Database = mysql_fetch_assoc($DatabaseResult))
		{

		$tag_id = $Database['Tag_ID'];
		$tag = $Database['Tag'];
		$keyword_count = $Database['Keyword_Count'];

		$F = array();
		$F['tag_id'] = $tag_id;
		$F['tag'] = $tag;
		$F['keyword_count'] = $keyword_count;

		array_push($ReturnObject, $F);
		}

		$app->response()->header("Content-Type", "application/json");
		echo format_json(json_encode($ReturnObject));
	});	
 ?>
