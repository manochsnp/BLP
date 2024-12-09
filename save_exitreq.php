<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>ระบบบันทึกการลา/ขออนุญาตออกนอกโรงเรียน</title>
    <!-- sweet alert  -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

    <script src="http://code.jquery.com/jquery-latest.js"></script>
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-primary" role="alert">  
<?php 
	function checkExist($checkSQL,$objConnect){
		//echo $checkSQL . "<br>";
		$objChkQuery = mysqli_query($objConnect,$checkSQL);
		if($objChkQuery){
			$nRows = mysqli_num_rows($objChkQuery);
			if ($nRows == 0){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
?>

<?php 
$teacher_name =(isset($_POST['teacher_name']) ? $_POST['teacher_name'] : '');
if (!isset($_POST['reg_type']) or !isset($_POST['teacher_pin']) or !isset($_POST['teacher_name']) or !isset($_POST['reg_date1']) or !isset($_POST['reg_date2'])){
			echo "<div class='panel panel-warning'>" ;
			echo "<div class='panel-body'>การบันทึกข้อมูลผิดพลาด</div>" ;
			echo "<div class='panel-footer'>กรอกข้อมูลไม่ครบถ้วน</div>" ;
			echo "</div>";
}
else{
    require_once 'connectdb.php';
    //$date1 = date("Ymd_His"); //สร้างตัวแปรวันที่เพื่อเอาไปตั้งชื่อไฟล์ใหม่
    //$numrand = (mt_rand()); //สร้างตัวแปรสุ่มตัวเลขเพื่อเอาไปตั้งชื่อไฟล์ที่อัพโหลดไม่ให้ชื่อไฟล์ซ้ำกัน
    //$doc_file = (isset($_POST['fileupload']) ? $_POST['fileupload'] : '');
    //$upload=$_FILES['fileupload']['name'];

    //มีการอัพโหลดไฟล์
    //if($upload !='') {
	//	$typefile = strrchr($_FILES['fileupload']['name'],"."); //ตัดขื่อเอาเฉพาะนามสกุล
	//	if($typefile !=''){ 
	//สร้างเงื่อนไขตรวจสอบนามสกุลของไฟล์ที่อัพโหลดเข้ามา
    //โฟลเดอร์ที่เก็บไฟล์ **สร้างไฟล์ index.php หรือ index.html (ไม่ต้องมี code) ไว้ในโฟลเดอร์ด้วยนะครับจะได้ป้องกันการเข้าถึงทุกไฟล์ในโฟลเดอร์
	//		$path="docs/";
	//		$newname = 'doc_'.$numrand.$date1.$typefile; //ตั้งชื่อไฟล์ใหม่เป็น สุ่มตัวเลข+วันที่
	//		$path_copy=$path.$newname; //คัดลอกไฟล์ไปยังโฟลเดอร์
	//echo $path_copy;
	//		move_uploaded_file($_FILES['fileupload']['tmp_name'],$path_copy); 
	//	}
	//}else{
	//	$newname = "";
	//}
	

	
    //ประกาศตัวแปรรับค่าจากฟอร์ม
	$reg_type =(isset($_POST['reg_type']) ? $_POST['reg_type'] : '');
	$teacher_pin =(isset($_POST['teacher_pin']) ? $_POST['teacher_pin'] : '');
	$teacher_name =(isset($_POST['teacher_name']) ? $_POST['teacher_name'] : '');
	$reg_date1 = (isset($_POST['reg_date1']) ? $_POST['reg_date1'] : date("Y-m-d"));
	$reg_date2 = (isset($_POST['reg_date2']) ? $_POST['reg_date2'] : date("Y-m-d"));
	$reg_time1 = (isset($_POST['reg_time1']) ? $_POST['reg_time1'] : date("H:i:s"));
	$reg_time2 = (isset($_POST['reg_time2']) ? $_POST['reg_time2'] : date("H:i:s"));
	$who_respon = (isset($_POST['who_respon']) ? $_POST['who_respon'] : '');
	$remark =(isset($_POST['remark']) ? $_POST['remark'] : '');
	$nday =(isset($_POST['nday']) ? $_POST['nday'] : 0);
	
	$checkSQL = "select id from reg_data where teacher_pin = '$teacher_pin' and reg_date1='$reg_date1' and reg_type = '$reg_type' and reg_time1='$reg_time1'" ; 
	if(checkExist($checkSQL,$objConnect)){
			echo "<div class='alert alert-success' align='center'>" ;
			echo "<strong>บันทึกข้อมูลเรียบร้อย</strong><br><a href='index.php' class='alert-link'>
			ประเภท  $reg_type   <br>ชื่อ-สกุล  $teacher_name <br> วันที่  $reg_date1 เวลา : $reg_time1 ถึงวันที่  $reg_date2 เวลา : $reg_time2 <br>
			จำนวน $nday วัน <br>
			รายละเอียด : $remark ผู้รับมอบหมายงานแทน : $who_respon</a></div>";
	}
	else{
    //sql insert
		$strSQL = "INSERT INTO reg_data (teacher_pin, reg_type,reg_date1,reg_time1,reg_date2,reg_time2,remark,who_respon,nday) " ;
		$strSQL = $strSQL ." VALUES ('$teacher_pin', '$reg_type','$reg_date1','$reg_time1','$reg_date2','$reg_time2','$remark','$who_respon','$nday')";
		$objQuery = mysqli_query($objConnect,$strSQL);
	//เงื่อนไขตรวจสอบการเพิ่มข้อมูล
		if($objQuery){
			echo "<div class='alert alert-success' align='center'>" ;
			echo "<strong>บันทึกข้อมูลเรียบร้อย</strong><br><a href='index.php' class='alert-link'>
			ประเภท  $reg_type   <br>ชื่อ-สกุล  $teacher_name <br> " ;
			if ($reg_type == "ขออนุญาตออกนอกโรงเรียน"){
				echo "วันที่  $reg_date1 เวลา : $reg_time1 ถึงวันที่  $reg_date2 เวลา : $reg_time2 <br>";
			}
			else{
				echo "วันที่  $reg_date1 ถึงวันที่  $reg_date2 <br>";
			}
			echo "จำนวน $nday วัน <br>รายละเอียด : $remark ผู้รับมอบหมายงานแทน : $who_respon</a></div>";
			
	/** Send Line **/
			$token = "rkeoangt5xeklD54ILpQ5xj37Zu9mlBsLPOfCHnsSKE" ; // LINE Token
			$mymessage = "เรื่อง: $reg_type \n"; //Set new line with '\n'
			$mymessage .= "จาก: $teacher_name \n";
			if ($reg_type == "ขออนุญาตออกนอกโรงเรียน"){
				$mymessage .= "วันที่ : $reg_date1 เวลา : $reg_time1 ถึง $reg_date2 เวลา : $reg_time2 \n";
			}else{
				$mymessage .= "วันที่ : $reg_date1  ถึง $reg_date2 \n";
			}
			$mymessage .= "จำนวนวัน : $nday วัน \n";
			$mymessage .= "ผู้รับมอบหมายงานแทน : $who_respon \n";
			$mymessage .= "รายละเอียด : $remark \n";
			
//$imageFile = new CURLFILE('cat.jpg'); // Local Image file Path
			$sticker_package_id = '2';  // Package ID sticker
			$sticker_id = '34';    // ID sticker
			$data = array (
				'message' => $mymessage,
    //'imageFile' => $imageFile,
				'stickerPackageId' => $sticker_package_id,
				'stickerId' => $sticker_id
			);

			$chOne = curl_init();
			curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt( $chOne, CURLOPT_POST, 1);
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, $data);
			curl_setopt( $chOne, CURLOPT_FOLLOWLOCATION, 1);
			$headers = array( 'Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$token, );
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec( $chOne );

  
  //Check error
  //if(curl_error($chOne)) { echo 'error:' . curl_error($chOne); }
  //else { $result_ = json_decode($result, true);
  //echo "status : ".$result_['status']; echo "message : ". $result_['message']; 
  //}
  //Close connection
			curl_close( $chOne );
/** End Send Line **/  	
		}else{
			echo "<div class='panel panel-warning'>" ;
			echo "<div class='panel-body'>การบันทึกข้อมูลผิดพลาด</div>" ;
			echo "<div class='panel-footer'>ลองใหม่อีกครั้ง</div>" ;
			echo "</div>";
			echo "<div class='alert alert-danger' align='center'>" ;
			echo "<strong>การบันทึกข้อมูลผิดพลาด</strong><a href='index.php' class='alert-link'>ลองใหม่อีกครั้ง </a></div>";
		} //else ของ if result
	}
} //isset
?>
      </div>
    </div>
  </body>
</html>