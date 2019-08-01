<?php
	require ("conn.php");
	header("Access-Control-Allow-Origin: *");
	// 允许任意域名发起的跨域请求
	$ret_data = '';
	$userId = isset($_POST["userId"])?$_POST["userId"] : '';
	$num = isset($_POST["num"])?$_POST["num"] : '';
	
	$sql = "UPDATE 学生信息 SET userId = '$userId' where 考生号 = '".$num."' ";
	$res = $conn -> query($sql);
	
	$ret_data["success"] = 'success';
	
	$conn -> close();
	$json = json_encode($ret_data);
	echo $json;
?>