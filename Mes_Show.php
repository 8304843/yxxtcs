<?php
require ("conn.php");
header("Access-Control-Allow-Origin: *");
// 允许任意域名发起的跨域请求
$ret_data = '';
$time = date("Y-m-d h:i:sa");
//$flag = isset($_POST["flag"]) ? $_POST["flag"] : '';
// $flag = 'Overdue';

$sql = "SELECT id,姓名 FROM 学生信息 ";
$res = $conn -> query($sql);
if ($res -> num_rows > 0) {
	$i = 0;
	while ($row = $res -> fetch_assoc()) {

//		$ret_data["data"][$i]["address"] = $row["content"];
//		$ret_data["data"][$i]["date"] = $row["time"];
		$ret_data["data"][$i]["id"] = $row["id"];
		$ret_data["data"][$i]["name"] = $row["姓名"];
//		$ret_data["data"][$i]["state"] = $row["workstate"];
//		$ret_data["data"][$i]["route"] = $row["route"];
//		$ret_data["data"][$i]["workshop"] = $row["workshop"];
//		$ret_data["data"][$i]["cuser"] = $row["cuser"];
		$i++;
	}
	$ret_data["success"] = 'success';
}
$conn -> close();
$json = json_encode($ret_data);
echo $json;
?>