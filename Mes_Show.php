<?php
    require("conn.php");
	header("Access-Control-Allow-Origin: *");
	$sqldate = "";
	$sql = "select * from 学生信息 ";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		while($row = $result->fetch_assoc()){
			$sqldate = $sqldate.'{"id":"'.$row["id"].'","姓名":"'.$row["姓名"].'"},';
		}
	}
	$jsonresult = 'success';
	$otherdate = '{"result":"'.$jsonresult.'"
				}';
	$json = '['.$sqldate.$otherdate.']';	
	echo $json;
	$conn->close();		
?>