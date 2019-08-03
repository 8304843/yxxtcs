<?php
	require("conn.php");
	header("Access-Control-Allow-Origin: *"); // 允许任意域名发起的跨域请求
	$files =$_POST["file"];
	
	$sjcNmae=time();
	$strsShuzu = $files;
	$length=count($strsShuzu);
//	echo $length;
	$filenames="";
	$Base64 = isset($_POST["Base64"])?$_POST["Base64"] : '';
	if($files=='null'){
		
	}else{
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
	}
	
		
	$conn->close();
	require('student.php')
?>