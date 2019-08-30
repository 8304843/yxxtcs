<?php 
	require('conn.php');
	header("Access-Control-Allow-Origin: *");
 require_once 'PHPExcel/IOFactory.php';
 require_once 'PHPExcel/Shared/Date.php';
 require_once 'PHPExcel/Reader/Excel5.php';
 //以上三步加载phpExcel的类
 $objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format
// $filename="./mark.xlsx";//指定excel文件从上传中取出
// $objPHPExcel = PHPExcel_IOFactory::load($filename); //$filename可以是上传的文件，或者是指定的文件
$objPHPExcel = PHPExcel_IOFactory::load($_FILES['file']['tmp_name']); // 读取xlsx文件
 $sheet = $objPHPExcel->getSheet(0);
 $highestRow = $sheet->getHighestRow(); // 取得总行数
 $highestColumn = $sheet->getHighestColumn(); // 取得总列数
 $z = 0;
 //循环读取excel文件,读取一条,插入一条
 //j表示从哪一行开始读取
 //$a表示列号
$time=date("Y-m-d h:i:sa");
echo $time;
for($y=2;$y<=$highestRow;$y++)
  {
//    $b = $objPHPExcel->getActiveSheet()->getCell("B".$y)->getValue();//获取C列的值,缴费情况
//    $d = $objPHPExcel->getActiveSheet()->getCell("D".$y)->getValue();//获取C列的值,缴费情况
	  
      $a = $objPHPExcel->getActiveSheet()->getCell("A".$y)->getValue();//获取A列的值,考生号
      $d = $objPHPExcel->getActiveSheet()->getCell("D".$y)->getValue();//获取D列的值,楼栋
      $e = $objPHPExcel->getActiveSheet()->getCell("E".$y)->getValue();//获取E列的值,宿舍号
      $f = $objPHPExcel->getActiveSheet()->getCell("F".$y)->getValue();//获取F列的值,床号
      //搜索考生号号相同的数据
      
        //插入数据
//      $sql = "update 学生信息 set 缴费情况='$d' where 身份证号='".$b."'";
		$sql = "update 学生信息 set 楼栋='$d',宿舍号='$e',床号='$f' where 考生号='".$a."'";
     //echo $sql;
        $res = $conn->query($sql);
      
  }

 $json = '{"result":"success"}';
  echo $json;
 ?>