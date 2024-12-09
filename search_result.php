<?php
include 'connectdb.php';

// รับค่าจาก jQuery
$reg_date = $_POST['reg_date'];
$teacher_name = $_POST['teacher_name'];

// เช็คว่าทั้ง 3 ช่องต้องไม่เป็นค่าว่าง
if(!empty($reg_date) or !empty($teacher_name)){
    //$strSQL = "SELECT * FROM reg_data WHERE teacher_name LIKE '%$fullname%' "//AND reg_date between '%$reg_date%' AND '%$reg_date'";
    $strSQL = "SELECT * FROM reg_data_nday,teacher WHERE reg_data_nday.teacher_pin = teacher.teacher_pin";
	if(!empty($reg_date)) {
		//$strSQL = $strSQL . " and reg_data_nday between '%$reg_date%' AND '%$reg_date'";
		$strSQL = $strSQL . " and ('$reg_date' between reg_date1 AND reg_date2)";
	}
	if(!empty($teacher_name)) {
		$strSQL = $strSQL . " and teacher.teacher_name LIKE '%$teacher_name%' ";
	}
	$strSQL = $strSQL . " ORDER BY timestamp, reg_date1";
	$objQuery = mysqli_query($objConnect,$strSQL);
	
    // กำหนดตัวแปรไว้เก็บข้อมูลที่ค้นหาได้
    $search_data = array();
    // วนลูปค้นหาข้อมูล
    while($result = mysqli_fetch_assoc($objQuery)){
        // เก็บข้อมูลที่ค้นหาได้ลงตัวแปร
        $search_data[] = $result;
    }

    // ทดสอบแสดงผลลัพธ์ที่ค้นเจอ
    /*
    echo "<pre>";
    print_r($search_data);
    echo "</pre>";
    */
    
    // แสดงข้อมูลออกเป็น JSON Data
    echo json_encode($search_data);
}
?>
