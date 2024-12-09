<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>ระบบบันทึกการลา/ขออนุญาตออกนอกโรงเรียน</title>
    <!-- sweet alert  -->
    

    <script src="http://code.jquery.com/jquery-latest.js"></script>
	
    <script type="text/javascript">
	$(document).ready(function(){

	//	$("#teacher_pin").on('focusout', function(){
	//		alert("ssss");
	//	});
		
		$("#teacher_pin").change(function(){
			$.ajax({ 
				url: "return_name.php" ,
				type: "POST",
				data: 'teacher_pin=' +$("#teacher_pin").val()
				
			})
			.success(function(result) { 
				var obj = jQuery.parseJSON(result);
					if(obj == ''){
						//$('input[type=text]').val('');
						$("#teacher_name").val('');
						alert ('ไม่พบข้อมูลบุคลากร เลขประชาชน ' + $("#teacher_pin").val() + 'กรุณาตรวจสอบ');
						$('#teacher_pin').focus(); // โฟกัสช่อง
					}
					else{
						$.each(obj, function(key, inval) {
							$("#teacher_name").val(inval["teacher_name"]);
						});
					}
			});

		});
	});
    </script>
	<script language="javascript">
	function toggle() {
		let time1 = document.getElementById("time1"); 
		let time2 = document.getElementById("time2"); 
		reg_date1 = new Date();
		reg_date2 = new Date();
		if (document.getElementById('reg_type').value == "ขออนุญาตออกนอกโรงเรียน"){
			time1.style.display="" ;
			time2.style.display="" ;
			ndaydiv.style.display="none";
		}
		else{
			time1.style.display="none" ;
			reg_time1.value = "08:00";
			time2.style.display="none" ;
			reg_time2.value = "08:00";
			ndaydiv.style.display="";
		};
	}
//-->
</script>

<script language="javascript">
function checkform()
{
	if(document.form1.reg_type.value == "")
	{
		alert('กรุณาเลือกประเภทรายการ');
		document.form1.reg_type.focus();
		return false;
	}	
	if(document.form1.teacher_pin.value == "")
	{
		alert('กรุณาตรวจสอบเลขประชาชน');
		document.form1.teacher_pin.focus();		
		return false;
	}
	if(document.form1.teacher_name.value == "")
	{
		alert('กรุณาตรวจสอบเลขประชาชน');
		document.form1.teacher_pin.focus();		
		return false;
	}	
	if(document.form1.reg_date1.value == "")
	{
		alert('กรุณาตรวจสอบวันที่');
		document.form1.reg_date1.focus();		
		return false;
	}	
	if(document.form1.reg_date2.value == "")
	{
		alert('กรุณาตรวจสอบวันที่');
		document.form1.reg_date2.focus();		
		return false;
	}	
	document.form1.submit();
}
</script>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-primary" role="alert">
            <h3>บันทึกข้อมูลการลา / ขออนุญาต</h3>
          </div>
          <form name="form1" method="post" action="save_exitreq.php" enctype="multipart/form-data" onsubmit="return checkform();">
            <div class="row mb-3">
              <div class="col">
                เลือกรายการ
                <select name="reg_type" id="reg_type" class="form-control" required onchange="toggle();">
                  <option value="">-เลือกรายการ-</option>
                  <option value="ลากิจ">ลากิจ</option>
                  <option value="ลาป่วย">ลาป่วย</option>
                  <option value="ไปราชการ">ไปราชการ</option>
                  <option value="ขออนุญาตออกนอกโรงเรียน">ขออนุญาตออกนอกโรงเรียน</option>
                </select>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                เลขประชาชน
		<input type="number" name="teacher_pin" id="teacher_pin" class="form-control" placeholder="เลขประชาชน" min="1000000000000" max="9999999999999" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                ชื่อ-สกุล
		<input type="text" name="teacher_name" id="teacher_name" class="form-control" placeholder="ชื่อ-สกุล" readonly required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col">
                ระบุเหตุผล/รายละเอียด
		<input type="text" name="remark" id="remark" class="form-control" placeholder="ระบุเหตุผล/รายละเอียด" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12 col-sm-6">
                เลือกวันที่
                <input type="date" name="reg_date1" id="reg_date1" class="form-control" placeholder="วันที่" required >
              </div>
              <div class="col-12 col-sm-6" id="time1">
                เวลา
                <input type="time" name="reg_time1" id="reg_time1" class="form-control" placeholder="เวลา" required>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-12 col-sm-6">
                ถึงวันที่
                <input type="date" name="reg_date2" id="reg_date2" class="form-control" placeholder="วันที่" required >
              </div>
              <div class="col-12 col-sm-6" id="time2">
                เวลา
                <input type="time" name="reg_time2" id="reg_time2" class="form-control" placeholder="เวลา" required>
              </div>
            </div>
            <div class="row mb-3" id="ndaydiv">
              <div class="col">
				จำนวนวัน (กรณีลา)
			    <select name="nday" id="nday" class="form-control" required>
				<option value="0" selected>0 วัน</option>
				<?php 
					for ($i = 1;$i<=20; $i++){
						$nday = $i/2;
						echo "<option value=$nday> $nday วัน</option>";
					}
				?>
                </select>
              </div>
            </div>		
            <div class="row mb-3">
              <div class="col">
<!-- 
                แนบไฟล์เอกสาร
		<input type="file" name="fileupload" id="fileupload" name="file" class="form-control" placeholder="วุฒิการศึกษา1">
 -->
     ชื่อผู้รับมอบหมายสอนแทน (กรณีลาให้ระบุชื่อหัวหน้ากลุ่มสาระฯ)
		<input type="text" name="who_respon" id="who_respon"  class="form-control" placeholder=" ชื่อผู้รับมอบหมายสอนแทน (กรณีลาให้ระบุชื่อหัวหน้ากลุ่มสาระฯ)" required>

              </div>
            </div>
               <div class="d-grid gap-2 col-12 mx-auto">
              <br>
              <button class="btn btn-primary" type="submit">บันทึก</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
