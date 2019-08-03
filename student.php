<?php
	require("conn.php");
	header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
	$ret_data = '';
	$time=date("Y-m-d h:i:sa");
	$ret_data["success"] = 'success';
	$name = isset($_POST["name"])?$_POST["name"] : '';
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
	$payment = isset($_POST["payment"])?$_POST["payment"] : '';
	$state = isset($_POST["state"])?$_POST["state"] : '';
//	 $time = time();
	$sql = "SELECT 考生号 FROM 学生信息 where 考生号='".$num."' order by id ASC";
	$res = $conn -> query($sql);
	if ($res -> num_rows > 0) {
//		echo '人员已存在';
		$ret_data["states"] = '已存在';
	}else{
		$sqli = "INSERT INTO 学生信息 (姓名,省份,考生号,性别,身份证号,二级学院,宿舍号,录取专业,邮寄地址,邮政编码,联系电话,收件人,投档成绩,缴费情况,录入时间,photo,state) VALUES ('$name','$province','$num','$sex','$message','$xueyuan','$dorm','$zy','$address','$code','$phone','$receive','$result','$payment','$time','$filenames','$state')";
		$result = $conn->query($sqli);
	}
		
    $conn->close();
	$json=json_encode($ret_data); 
	echo $json
?>