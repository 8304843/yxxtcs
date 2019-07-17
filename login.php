<?php
	header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
	require("conn.php");
	$flag = isset($_POST["flag"])?$_POST["flag"]:'';
	if($flag == "Login"){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * FROM 用户信息  WHERE account = '".$username."' ";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();
		if($password==$row["password"])	{
			$data['status']='success';
		}else{
			$data='error';
		}
		
	}
	$json = json_encode($data);
	echo $json;
	$conn->close();	
?>