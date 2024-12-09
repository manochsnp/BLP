<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ค้นหาข้อมูลการลา/ขออนุญาต (ตามเลขประจำตัวประชาชน)</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="jumbotron bg-primary text-light pt-3 pb-3">
        <h1 class="text-center">ค้นหาข้อมูลการลา/ขออนุญาต (ตามเลขประจำตัวประชาชน)</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- สร้างแบบฟอร์มด้วย Bootstrap 4-->

			<div class="col-md-3">
				<div class="container">
                    <form name="search_user" id="search_user" method="POST" action="index_check.php">
                        <div class="form-group row">
						    <label for="xform" class="col-sm-12 col-form-label" align="center">เลขประจำตัวประชาชน</label>
                            <div class="col-sm-12"><input type="text" class="form-control" id="teacher_pin" name="teacher_pin" style="text-align: center;"></div>
                        </div>
						<div class="form-group row">
							<div class="col-sm-12" align="center">
                            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ค้นหา">
                            <input type="button" class="btn btn-primary" id="resetform" name="resetform" value="ล้างข้อมูลการค้นหา">
                            </div>
                        </div>
                    </form>
					<div class="col-md-12">

                    <label id="sumary" name="sumary">

                    </label>
					</div>					
                </div>
            </div>

            <!-- สร้างตารางด้วย Bootstrap 4-->
            <div class="col-md-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr class="bg-primary text-light">
                            <th width="3%">#</th>
                            <th class="text-center" width="10%">เวลาบันทึกข้อมูล</th>
                            <th class="text-center" width="10%">ประเภทรายการ</th>
                            <th class="text-center" width="20%">ชื่อ-สกุล</th>
                            <th class="text-center" width="6%">วันที่</th>
							<th class="text-center" width="6%">เวลา</th>
                            <th class="text-center" width="6%">วันที่</th>
							<th class="text-center" width="6%">เวลา</th>
							<th class="text-center" width="5%">จำนวนวัน</th>
							<th class="text-center" width="8%">ผู้รับมอบหมายงาน</th>
							
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- การส่งข้อมูลด้วย jQuery AJAX เพื่อค้นหา ไปที่ไฟล์ search_result.php-->
    <script>
        $(function(){
            $('form#search_user').submit(function(event) { // เมื่อมีการ submit form
               event.preventDefault();
                var teacher_pin = $('input#teacher_pin').val();
				var teacher_name = $('input#teacher_name').val();
                $.ajax({ // ส่งค่าไป search_resultbypin.php ด้วย jQuery Ajax
                    url: 'search_resultbypin.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        teacher_name:teacher_name,
                        teacher_pin:teacher_pin
                    },
                    success: function(data){
                        if(data.length != 0){
                            var trstring ="";  // กรณีมีข้อมูล // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                            var countrow = 1;   // ตัวแปรนับจำนวนแถว
							var la1n = 0;
							var la2n = 0;
							var la3n = 0;
							var la1day = 0;
							var la2day = 0;
							var la3day = 0;
							var exitn = 0;
							
                            $.each(data, function(key, value){ // วนลูปข้อมูล JSON ลงตาราง // แสดงค่าลงในตาราง 
                                trstring += `
                                    <tr>
                                        <td class="text-center" width="3%">${countrow}</td>
										<td class="text-center" width="10%">${value.timestamp}</td>
                                        <td class="text-center" width="10%">${value.reg_type}</td>
                                        <td class="text-center" width="20%">${value.teacher_name}</td>
                                        <td class="text-center" width="6%">${value.reg_date1}</td>
										<td class="text-center" width="6%">${value.reg_time1}</td>
                                        <td class="text-center" width="6%">${value.reg_date2}</td>
										<td class="text-center" width="6%">${value.reg_time2}</td>
										<td class="text-center" width="5%">${value.ndayx} วัน</td>
										<td class="text-center" width="8%">${value.who_respon}</td>
                                    </tr>`;
									if(value.reg_type == "ลากิจ"){
										la1n += 1;
										la1day += parseFloat(value.ndayx);
									}else if(value.reg_type == "ลาป่วย"){
										la2n += 1;
										la2day += parseFloat(value.ndayx);
									}else if(value.reg_type == "ไปราชการ"){
										la3n += 1;
										la3day += parseFloat(value.ndayx);
									}else if(value.reg_type == "ขออนุญาตออกนอกโรงเรียน"){
										exitn += 1;
									}
                                $('table tbody').html(trstring);
                                countrow++;
                            });
							var sumarystring ="";
							sumarystring = `<table class="table table-striped table-hover">
											<tr class="bg-primary text-light">
											<th class="text-center" width="60%">ประเภทรายการ</th>
											<th class="text-center" width="20%">จำนวนครั้ง</th>
											<th class="text-center" width="20%">จำนวนวัน</th>
											</tr>
											<tr>
											<td class="text-center" width="60%">ลากิจ</td>
											<td class="text-center" width="20%">${la1n}</td>
											<td class="text-center" width="20%">${la1day}</td>
											</tr>
											<tr>
											<td class="text-center" width="60%">ลาป่วย</td>
											<td class="text-center" width="20%">${la2n}</td>
											<td class="text-center" width="20%">${la2day}</td>
											</tr>
											<tr>
											<td class="text-center" width="60%">รวม</td>
											<td class="text-center" width="20%">${la1n+la2n}</td>
											<td class="text-center" width="20%">${la1day+la2day}</td>
											</tr>
											<tr>
											<td class="text-center" width="60%">ไปราชการ</td>
											<td class="text-center" width="20%">${la3n}</td>
											<td class="text-center" width="20%">${la2day}</td>
											</tr>
											<tr>
											<td class="text-center" width="60%">ขออนุญาต</td>
											<td class="text-center" width="20%">${exitn}</td>
											<td class="text-center" width="20%">-</td>
											</tr>
											</table>`;
							$('label#sumary').html(sumarystring);
                        }else{
                            alert('ไม่พบข้อมูลที่ค้นหา'+teacher_pin);
                        }
                    }
                });
            });

            // ============================================================================
            
            $('input#resetform').click(function(){ // เมื่อกดปุ่มล้างข้อมูลการค้นหา
                $("#search_user").trigger('reset'); // ล้างค่าในฟอร์มทั้งหมด
                $('input#teacher_pin').focus(); // โฟกัสช่องชื่อ
				$('table tbody').html("");
				$('label#sumary').html("");
            });
        });
    </script>
</body>
</html>