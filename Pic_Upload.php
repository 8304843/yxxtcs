<?php
	require("conn.php");
	header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
	$files =$_POST["file"];
	$id = $_POST["id"];
	$Base64 = isset($_POST["Base64"])?$_POST["Base64"] : '';
	$sjcNmae=time();
	$strsShuzu = $files;
	$length=count($strsShuzu);
//	echo $length;
	$filenames="";
	for ($i= 0;$i< $length; $i++){
		$fengeOk=substr($strsShuzu[$i],1); 
		$files1= explode(',', $strsShuzu);
		$tmp  = base64_decode($files1[1]);  //解码
		$sjcNmae=time().$i;
		$s=dirname(__FILE__); //获的服务器路劲
//		echo $s;
		$fp=$s."/upload/".$sjcNmae.".jpg";  //确定图片文件位置及名称
//		echo $fp;
		$filenames=$filenames.$sjcNmae.".jpg";
		//写文件
		file_put_contents( $fp, $tmp);     
	}	
	//if(图片url为空则insert，否则update)
	$sql="select photo from 学生信息 where id = '".$id."'";
	$res = $conn->query($sql);
	if($res->num_rows > 0){
		$sqli = "update 学生信息 set photo = '$filenames',state='已上传',photo_Base64='$Base64' where id='".$id."'";
		if ($conn->query($sqli) === TRUE) {
			$jsonresult='success';
		} else {
			$jsonresult='error';
		} 
	}else{
//		$sqli = "INSERT INTO 学生信息 (photo) VALUES ('$filenames')";
//		if ($conn->query($sqli) === TRUE) {
//			$jsonresult='success';
//		} else {
//			$jsonresult='error';
//		}
	} 
		
	$json = '{"result":"'.$jsonresult.'"}';
	echo $json;
	$conn->close();
	
?>