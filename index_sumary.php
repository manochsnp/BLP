<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>สรุปข้อมูลการลา/ขออนุญาต</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="jumbotron bg-primary text-light pt-3 pb-3">
        <h1 class="text-center">สรุปข้อมูลการลา/ขออนุญาต</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- สร้างแบบฟอร์มด้วย Bootstrap 4-->
            <div class="col-md-3">
                <div class="container">
                    <form name="search_user" id="search_user" method="POST">
                        <div class="form-group row">
                            <label for="reg_date1" class="col-sm-3 col-form-label">วันที่</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="reg_date1" name="reg_date1">
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="reg_date2" class="col-sm-3 col-form-label">ถึงวันที่</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="reg_date2" name="reg_date2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="report_type" class="col-sm-3 col-form-label">ประเภทรายงาน</label>
                            <div class="col-sm-9">
								<select name="rep_type" id="rep_type" class="form-control" required>
								<option value="">-เลือกประเภทรายงาน-</option>
								<option value="by_exittype">รายงานสรุปตามประเภท</option>
								<option value="by_person">รายงานสรุปรายบุคคล</option>
								<option value="by_exit">รายงานการขออนุญาต</option>
								<option value="by_lakid">รายงานการลากิจ</option>
								<option value="by_lasick">รายงานการลาป่วย</option>
								<option value="by_lagov">รายงานการไปราชการ</option>
								
								</select>		
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sendform" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                            <input type="button" class="btn btn-primary" id="submit" name="submit" value="ค้นหา">
                            <input type="button" class="btn btn-primary" id="resetform" name="resetform" value="ล้างข้อมูลการค้นหา">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- สร้างตารางด้วย Bootstrap 4-->
            <div class="col-md-9">
				<label id="reporttable" name="reporttable">
				<!--ส่วนที่แสดงตารางข้อมูลรายงาน-->
                </label>            
            </div>

        </div>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- การส่งข้อมูลด้วย jQuery AJAX เพื่อค้นหา ไปที่ไฟล์ search_resultsumary.php-->
	
	<script>
		$("#submit").click(function(){
			$.ajax({
				url: "search_resultsumary.php",
				type: 'POST',
				data: {
                        reg_date1:$('#reg_date1').val(),
                        reg_date2:$('#reg_date2').val(),
						rep_type :$('#rep_type').val()
                },
				success: function(data) {
					$("#reporttable").html(data);
				}
			});
		});
		$("#resetform").click(function(){ // เมื่อกดปุ่มล้างข้อมูลการค้นหา
                //$("#search_user").trigger('reset'); // ล้างค่าในฟอร์มทั้งหมด
                $("#reg_date1").focus(); // โฟกัสช่องชื่อ
				$("#reporttable").html("");
        });

	</script>
</body>
</html>