<?php
require ("conn.php");
header("Access-Control-Allow-Origin: *");
// 允许任意域名发起的跨域请求
$ret_data = '';
$time = date("Y-m-d h:i:sa");
//$flag = isset($_POST["flag"]) ? $_POST["flag"] : '';

$sql = "SELECT * FROM 学生信息 order by Recognition_time DESC";
$res = $conn -> query($sql);
if ($res -> num_rows > 0) {
	$i = 0;
	while ($row = $res -> fetch_assoc()) {
		$ret_data["data"][$i]["province"] = $row["省份"];
		$ret_data["data"][$i]["num"] = $row["考生号"];
		$ret_data["data"][$i]["id"] = $row["id"];
		$ret_data["data"][$i]["name"] = $row["姓名"];
		$ret_data["data"][$i]["sex"] = $row["性别"];
		$ret_data["data"][$i]["message"] = $row["身份证号"];
		$ret_data["data"][$i]["xueyuan"] = $row["二级学院"];
		$ret_data["data"][$i]["building"] = $row["楼栋"];
		$ret_data["data"][$i]["dorm"] = $row["宿舍号"];
		$ret_data["data"][$i]["bed"] = $row["床号"];		
		$ret_data["data"][$i]["zy"] = $row["录取专业"];
		$ret_data["data"][$i]["address"] = $row["邮寄地址"];
		$ret_data["data"][$i]["code"] = $row["邮政编码"];
		$ret_data["data"][$i]["phone"] = $row["联系电话"];
		$ret_data["data"][$i]["receive"] = $row["收件人"];
		$ret_data["data"][$i]["result"] = $row["投档成绩"];
		$ret_data["data"][$i]["payment"] = $row["缴费情况"];
		$ret_data["data"][$i]["date"] = $row["录入时间"];
		$ret_data["data"][$i]["photo"] = $row["photo"];
		$ret_data["data"][$i]["state"] = $row["state"];
		$ret_data["data"][$i]["userId"] = $row["userId"];
		$ret_data["data"][$i]["photo_Base64"] = $row["photo_Base64"];
		$ret_data["data"][$i]["registe"] = $row["registe"];
		$ret_data["data"][$i]["classmate"] = $row["classmate"];
		
		$i++;
	}
	$ret_data["success"] = 'success';
}
$conn -> close();
$json = json_encode($ret_data);
echo $json;
?>