<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "test";
?>
<?php
require("db.php");
// 允许上传的图片后缀
$allowedExts = array("xls");
$temp = explode(".", $_FILES["file"]["name"]);
/* echo $_FILES["file"]["size"]; */
$extension = end($temp);     // 获取文件后缀名
if ((($_FILES["file"]["type"] == "application/vnd.ms-excel")
)
&& ($_FILES["file"]["size"] < 20480000)   // 小于 20 Mb
&& in_array($extension, $allowedExts))
{
	if ($_FILES["file"]["error"] > 0)
	{
		echo "错误：: " . $_FILES["file"]["error"] . "<br>";
	}
	else
	{
		// 判断当期目录下的 upload 目录是否存在该文件
		// 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
		if (file_exists("upload/" . $_FILES["file"]["name"]))
		{
			echo $_FILES["file"]["name"] . " 文件已经存在。 ";
		}
		else
		{	
			$imagename =  $_FILES["file"]["size"].".xls";
			// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
			move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $imagename);
			$pwd= "upload/" .$imagename;
		}
	}
}
else
{
 echo '<script>alert("只允许上传.xls文件");window.location.href="index.html";</script>';
}
if (!empty($pwd)){
require_once 'PHPExcel.php';
require_once 'PHPExcel/IOFactory.php';
require_once 'PHPExcel/Reader/Excel5.php';
//以上三步加载phpExcel的类
$objReader = PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
$filename=$pwd;//指定excel文件从上传中取出
$objPHPExcel = $objReader->load($filename); //$filename可以是上传的文件，或者是指定的文件
$sheet = $objPHPExcel->getSheet(0); 
$highestRow = $sheet->getHighestRow(); // 取得总行数 
$highestColumn = $sheet->getHighestColumn(); // 取得总列数
$k = 0;
//循环读取excel文件,读取一条,插入一条
//j表示从哪一行开始读取
//$a表示列号
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    mysqli_set_charset($coon, "utf8");
for($j=2;$j<=$highestRow;$j++)
{
    $a = $objPHPExcel->getActiveSheet()->getCell("A".$j)->getValue();//获取A列的值
    $b = $objPHPExcel->getActiveSheet()->getCell("B".$j)->getValue();//获取B列的值
    $c = $objPHPExcel->getActiveSheet()->getCell("C".$j)->getValue();//获取C列的值
	$sql = "INSERT INTO kt (ktname,ktform,ktteacher)
	VALUES ('$a','$b','$c')";
	$result = mysqli_query($conn, $sql);
	if($result){
		$sta="ok";
	}
	else{
		$sta="on";
	}
}
$highestRow=$highestRow-1;
if($sta=="ok"){
 echo '<script>alert("数据导入成功！");window.location.href="index.html";</script>';
}}
$filename = $pwd;
fopen($filename,'a+');
unlink($filename);
?>