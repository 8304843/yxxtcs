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
      $a = $objPHPExcel->getActiveSheet()->getCell("A".$y)->getValue();//获取A列的值,名字name
      $b = $objPHPExcel->getActiveSheet()->getCell("B".$y)->getValue();//获取B列的值,省份
      $c = $objPHPExcel->getActiveSheet()->getCell("C".$y)->getValue();//获取C列的值,考生号gNum
      $d = $objPHPExcel->getActiveSheet()->getCell("D".$y)->getValue();//获取D列的值,性别department
      $e = $objPHPExcel->getActiveSheet()->getCell("E".$y)->getValue();//获取E列的值,身份证号phone
      $f = $objPHPExcel->getActiveSheet()->getCell("F".$y)->getValue();//获取F列的值,二级学院terminal
      $g = $objPHPExcel->getActiveSheet()->getCell("G".$y)->getValue();//获取G列的值,宿舍号workShop
      $h = $objPHPExcel->getActiveSheet()->getCell("H".$y)->getValue();//获取A列的值,录取专业
      $i = $objPHPExcel->getActiveSheet()->getCell("I".$y)->getValue();//获取B列的值,邮寄地址
      $j = $objPHPExcel->getActiveSheet()->getCell("J".$y)->getValue();//获取C列的值,邮政编码
      $k = $objPHPExcel->getActiveSheet()->getCell("K".$y)->getValue();//获取D列的值,联系电话
      $l = $objPHPExcel->getActiveSheet()->getCell("L".$y)->getValue();//获取E列的值,收件人
      $m = $objPHPExcel->getActiveSheet()->getCell("M".$y)->getValue();//获取F列的值,投档成绩
      $n = $objPHPExcel->getActiveSheet()->getCell("N".$y)->getValue();//获取F列的值,投档成绩
      $o = $objPHPExcel->getActiveSheet()->getCell("O".$y)->getValue();//获取F列的值,投档成绩
      $p = $objPHPExcel->getActiveSheet()->getCell("P".$y)->getValue();//获取F列的值,投档成绩
      //搜索考生号号相同的数据
      $sqlNum = "SELECT * from 学生信息 where 考生号='$c'";
      $result = $conn->query($sqlNum);
      if ($result->num_rows > 0) {
        $ret_data["error"]=$c;
        $json=json_encode($ret_data);
        echo $json;
      }else{
        //插入数据
        $sql = "INSERT INTO 学生信息 (姓名,省份,考生号,性别,身份证号,二级学院,宿舍号,录取专业,邮寄地址,邮政编码,联系电话,收件人,投档成绩,录入时间,registe,state,classmate) VALUES ('$e','$b','$d','$f','$g','$h','','$i','$k','$l','$m','$o','$p','$time','未注册','未上传','$j')";
     //echo $sql;
        $res = $conn->query($sql);
      }
  }

 $json = '{"result":"success"}';
  echo $json;
 ?>