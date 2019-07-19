<?php
	require ("conn.php");
	header("Access-Control-Allow-Origin: *");
	// 允许任意域名发起的跨域请求
	$ret_data = '';
	$name = isset($_POST["name"])?$_POST["name"] : '';
	$id = isset($_POST["id"])?$_POST["id"] : '';
	$province = isset($_POST["province"])?$_POST["province"] : '';
	$num = isset($_POST["num"])?$_POST["num"] : '';
	$sex = isset($_POST["sex"])?$_POST["sex"] : '';
	$message = isset($_POST["message"])?$_POST["message"] : '';
	$xueyuan = isset($_POST["xueyuan"])?$_POST["xueyuan"] : '';
	$dorm = isset($_POST["dorm"])?$_POST["dorm"] : '';
	$zy = isset($_POST["zy"])?$_POST["zy"] : '';
	$address = isset($_POST["address"])?$_POST["address"] : '';
	$code = isset($_POST["code"])?$_POST["code"] : '';
	$phone = isset($_POST["phone"])?$_POST["phone"] : '';
	$receive = isset($_POST["receive"])?$_POST["receive"] : '';
	$result = isset($_POST["result"])?$_POST["result"] : '';
	$sql = "UPDATE 学生信息 SET 姓名='$name',省份='$province',考生号='$num',性别='$sex',身份证号='$message',二级学院='$xueyuan',宿舍号='$dorm',录取专业='$zy',邮寄地址='$address',邮政编码='$code',联系电话='$phone' ,收件人='$receive' ,投档成绩='$result'  where id = '".$id."' ";
	$res = $conn -> query($sql);
	
	$ret_data["success"] = 'success';
	
	$conn -> close();
	$json = json_encode($ret_data);
	echo $json;
?>