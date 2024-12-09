<?php  
	$servername = "localhost";
  	$username = "root";
  	$password = "1234567890";
  	$dbname = "bk_exitschool";

	$objConnect = mysqli_connect($servername, $username, $password, $dbname);
  	mysqli_query($objConnect,"SET NAMES UTF8");
  	/** ตรวจสอบข้อผิดพลาดต่างๆ */
  	if (mysqli_connect_errno()) {
    		echo "ไม่สามารถเชื่อมต่อฐานข้อมูล MySQL ได้: " . mysqli_connect_error();
    		exit();
  	}
  	date_default_timezone_set('Asia/Bangkok');
?>