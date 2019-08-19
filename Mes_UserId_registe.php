<?php
	require ("conn.php");
	header("Access-Control-Allow-Origin: *");
	// 允许任意域名发起的跨域请求
	$ret_data = '';
	$userId = isset($_POST["userId"])?$_POST["userId"] : '';
	$compareTime = isset($_POST["compareTime"])?$_POST["compareTime"] : '';
	
	$sql = "UPDATE 学生信息 SET registe = '已注册' where userid= '".$userId."' and registe='未注册' and userid !='' ";
	$res = $conn -> query($sql);
	if($compareTime)
	{
	$sql1= "UPDATE 学生信息 SET Recognition_time = '$compareTime' where userid= '".$userId."' and Recognition_time = '' ";
	$res = $conn -> query($sql1);
	}
	
	$ret_data["success"] = 'success';
	
	$conn -> close();
	$json = json_encode($ret_data);
	echo $json;
?>