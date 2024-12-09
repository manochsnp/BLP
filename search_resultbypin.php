<?php
include 'connectdb.php';

// รับค่าจาก jQuery
//$reg_date = $_POST['reg_date'];
// เช็คว่าทั้ง 3 ช่องต้องไม่เป็นค่าว่าง
if(!empty($_POST['teacher_pin'])){
	$teacher_pin = $_POST['teacher_pin'];
	//$teacher_pin = '3441000292348';
    $strSQL = "SELECT * FROM reg_data_nday,teacher WHERE reg_data_nday.teacher_pin = teacher.teacher_pin";
	$strSQL = $strSQL . " and teacher.teacher_pin = '$teacher_pin' ";
	$strSQL = $strSQL . " ORDER BY timestamp, reg_date1";
	$objQuery = mysqli_query($objConnect,$strSQL);
    $search_data = array();     // กำหนดตัวแปรไว้เก็บข้อมูลที่ค้นหาได้
    // วนลูปค้นหาข้อมูล
    while($result = mysqli_fetch_assoc($objQuery)){
        $search_data[] = $result;  // เก็บข้อมูลที่ค้นหาได้ลงตัวแปร
    }

    
    // แสดงข้อมูลออกเป็น JSON Data
    echo json_encode($search_data);
}
?>
