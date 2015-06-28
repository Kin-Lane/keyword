<?php
$route = '/keyword/';
$app->post($route, function () use ($app){

	$Add = 1;
	$ReturnObject = array();

 	$request = $app->request();
 	$params = $request->params();

	if(isset($params['keyword'])){ $keyword = mysql_real_escape_string($params['keyword']); } else { $keyword = 'nothing'; }
	if(isset($params['description'])){ $description = mysql_real_escape_string($params['description']); } else { $description = ''; }
	if(isset($params['url'])){ $url = mysql_real_escape_string($params['url']); } else { $url = ''; }

  	$Query = "SELECT * FROM keyword WHERE keyword = '" . $keyword . "'";
	//echo $Query . "<br />";
	$Database = mysql_query($Query) or die('Query failed: ' . mysql_error());

	if($Database && mysql_num_rows($Database))
		{
		$ThisKeyword = mysql_fetch_assoc($Database);
		$keyword_id = $ThisKeyword['ID'];
		}
	else
		{
		$Query = "INSERT INTO keyword(keyword,description,url)";
		$Query .= " VALUES(";
		$Query .= "'" . mysql_real_escape_string($keyword) . "',";
		$Query .= "'" . mysql_real_escape_string($description) . "',";
		$Query .= "'" . mysql_real_escape_string($url) . "'";
		$Query .= ")";
		//echo $Query . "<br />";
		mysql_query($Query) or die('Query failed: ' . mysql_error());
		$keyword_id = mysql_insert_id();
		}

	$ReturnObject['keyword_id'] = $keyword_id;

	$app->response()->header("Content-Type", "application/json");
	echo format_json(json_encode($ReturnObject));

	});
 ?>
