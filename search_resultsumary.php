<?php
include 'connectdb.php';

// รับค่าจาก jQuery
$reg_date1 = $_POST['reg_date1'];
$reg_date2 = $_POST['reg_date2'];
$rep_type = $_POST['rep_type'];
$data = "";
$str_error = "";
$strSQL = "";
// เช็คว่าทั้ง 3 ช่องต้องไม่เป็นค่าว่าง
if($reg_date1 == "" or $reg_date2 == "" or $rep_type == ""){
	$str_error = "เกิดข้อผิดพลาด กรุณาระบุวันที่และประเภทรายงาน";
}else if ($rep_type == "by_exittype"){
	$strSQL = "SELECT reg_type as 'ประเภทการลา'," ;
	$strSQL = $strSQL . " count(teacher_pin) as 'จำนวนครั้ง',sum(nday) as 'จำนวนวัน' " ;
	$strSQL = $strSQL . " FROM reg_data_nday ";
	$strSQL = $strSQL . " Where (('$reg_date1' between reg_date1 AND reg_date2) or ('$reg_date2' between reg_date1 AND reg_date2))";
	$strSQL = $strSQL . " or ((reg_date1  between '$reg_date1' AND '$reg_date2') or (reg_date2  between '$reg_date1' AND '$reg_date2'))";
	$strSQL = $strSQL . " group by reg_type";
	
}else if($rep_type == "by_person"){
	$strSQL = "SELECT CONCAT(left(teacher_pin,8),'*****') as 'เลชประชาชน',teacher_name as 'ชื่อ-สกุล',";
	$strSQL = $strSQL . "sum(if(reg_type='ลากิจ',1,0)) as 'จำนวนคร้้งลากิจ' , sum(if(reg_type='ลากิจ',nday,0)) as 'จำนวนวันลากิจ', ";
	$strSQL = $strSQL . "sum(if(reg_type='ลาป่วย',1,0)) as 'จำนวนครั้งลาป่วย', sum(if(reg_type='ลาป่วย',nday,0)) as 'จำนวนวันลาป่วย'," ;
	$strSQL = $strSQL . "sum(if(reg_type='ขออนุญาตออกนอกโรงเรียน',1,0)) as 'ขออนุญาตออกนอกโรงเรียน', " ;
	$strSQL = $strSQL . "sum(if(reg_type='ไปราชการ',1,0)) as 'จำนวนครั้งไปราชการ' " ;
	$strSQL = $strSQL . " FROM reg_data_nday ";
	$strSQL = $strSQL . " Where ((('$reg_date1' between reg_date1 AND reg_date2) or ('$reg_date2' between reg_date1 AND reg_date2))";
	$strSQL = $strSQL . " or ((reg_date1  between '$reg_date1' AND '$reg_date2') or (reg_date2  between '$reg_date1' AND '$reg_date2')))";
	$strSQL = $strSQL . " GROUP by teacher_pin,teacher_name,sara order by sara";
}else if($rep_type == "by_exit"){
	$strSQL = "SELECT CONCAT(left(teacher_pin,8),'*****') as 'เลชประชาชน',teacher_name as 'ชื่อ-สกุล', ";
	$strSQL = $strSQL . " reg_date1 as 'วันที่',reg_time1 as 'เวลา',reg_date2 as 'ถึงวันที่',reg_time2 as 'เวลา', ";
	$strSQL = $strSQL . " who_respon as 'ผู้รับมอบหมาย',nday as 'จำนวนวัน 1',ndayx as 'จำนวนวัน 2' "; 
	$strSQL = $strSQL . " FROM reg_data_nday " ;
	$strSQL = $strSQL . " Where ((('$reg_date1' between reg_date1 AND reg_date2) or ('$reg_date2' between reg_date1 AND reg_date2))";
	$strSQL = $strSQL . " or ((reg_date1  between '$reg_date1' AND '$reg_date2') or (reg_date2  between '$reg_date1' AND '$reg_date2')))";
	$strSQL = $strSQL . " and (reg_type='ขออนุญาตออกนอกโรงเรียน')";
	$strSQL = $strSQL . " Order by sara";
}else if($rep_type == "by_lakid"){
	$strSQL = "SELECT CONCAT(left(teacher_pin,8),'*****') as 'เลชประชาชน',teacher_name as 'ชื่อ-สกุล', ";
	$strSQL = $strSQL . " reg_date1 as 'วันที่',reg_time1 as 'เวลา',reg_date2 as 'ถึงวันที่',reg_time2 as 'เวลา', ";
	$strSQL = $strSQL . " who_respon as 'ผู้รับมอบหมาย',nday as 'จำนวนวัน 1',ndayx as 'จำนวนวัน 2' "; 
	$strSQL = $strSQL . " FROM reg_data_nday " ;
	$strSQL = $strSQL . " Where ((('$reg_date1' between reg_date1 AND reg_date2) or ('$reg_date2' between reg_date1 AND reg_date2))";
	$strSQL = $strSQL . " or ((reg_date1  between '$reg_date1' AND '$reg_date2') or (reg_date2  between '$reg_date1' AND '$reg_date2')))";
	$strSQL = $strSQL . " and (reg_type='ลากิจ')";
	$strSQL = $strSQL . " Order by sara";
}else if($rep_type == "by_lasick"){
	$strSQL = "SELECT CONCAT(left(teacher_pin,8),'*****') as 'เลชประชาชน',teacher_name as 'ชื่อ-สกุล', ";
	$strSQL = $strSQL . " reg_date1 as 'วันที่',reg_time1 as 'เวลา',reg_date2 as 'ถึงวันที่',reg_time2 as 'เวลา', ";
	$strSQL = $strSQL . " who_respon as 'ผู้รับมอบหมาย',nday as 'จำนวนวัน 1',ndayx as 'จำนวนวัน 2' "; 
	$strSQL = $strSQL . " FROM reg_data_nday " ;
	$strSQL = $strSQL . " Where ((('$reg_date1' between reg_date1 AND reg_date2) or ('$reg_date2' between reg_date1 AND reg_date2))";
	$strSQL = $strSQL . " or ((reg_date1  between '$reg_date1' AND '$reg_date2') or (reg_date2  between '$reg_date1' AND '$reg_date2')))";
	$strSQL = $strSQL . " and (reg_type='ลาป่วย')";
	$strSQL = $strSQL . " Order by sara";
}else if($rep_type == "by_lagov"){
	$strSQL = "SELECT CONCAT(left(teacher_pin,8),'*****') as 'เลชประชาชน',teacher_name as 'ชื่อ-สกุล', ";
	$strSQL = $strSQL . " reg_date1 as 'วันที่',reg_time1 as 'เวลา',reg_date2 as 'ถึงวันที่',reg_time2 as 'เวลา', ";
	$strSQL = $strSQL . " who_respon as 'ผู้รับมอบหมาย',nday as 'จำนวนวัน 1',ndayx as 'จำนวนวัน 2' "; 
	$strSQL = $strSQL . " FROM reg_data_nday " ;
	$strSQL = $strSQL . " Where ((('$reg_date1' between reg_date1 AND reg_date2) or ('$reg_date2' between reg_date1 AND reg_date2))";
	$strSQL = $strSQL . " or ((reg_date1  between '$reg_date1' AND '$reg_date2') or (reg_date2  between '$reg_date1' AND '$reg_date2')))";
	$strSQL = $strSQL . " and (reg_type='ไปราชการ')";
	$strSQL = $strSQL . " Order by sara";
}else{
	
}
echo $$strSQL;
if ($strSQL != ''){
	$objQuery = mysqli_query($objConnect,$strSQL);
	$ncols = mysqli_num_fields($objQuery);
	$data = $data . "<table class='table table-striped table-hover'><tr class='bg-primary text-light'>";

	while ($fieldinfo = mysqli_fetch_field($objQuery)) {
		$data = $data . "<th class='text-center'>" . $fieldinfo->name . "</th>";
	}
	$data = $data . "</tr>";

    while($result = mysqli_fetch_array($objQuery)){
		$data = $data . "<tr>";
		for ($i=0;$i<=$ncols - 1;$i++){
			$data = $data . "<td class='text-center'>" . $result[$i]  . "</td>";
		}
		$data = $data . "</tr>";
    }
	$data = $data . "</table>";
}else{
	$data = "เกิดข้อผิดพลาด" . $str_error;
}

    
    // แสดงข้อมูลออกเป็น html data
	mysqli_close($objConnect);
	
    echo $data;
?>
