<?php
	require ("conn.php");
	header("Access-Control-Allow-Origin: *");
	// 允许任意域名发起的跨域请求
	$ret_data = '';
	$id = isset($_POST["id"])?$_POST["id"] : '';
	
	$sql = "delete from 学生信息  where id = '".$id."' ";
	$res = $conn -> query($sql);
	
	$ret_data["success"] = 'success';
	
	$conn -> close();
	$json = json_encode($ret_data);
	echo $json;
?>