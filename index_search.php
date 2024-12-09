<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ค้นหาข้อมูลการลา/ขออนุญาต</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="jumbotron bg-primary text-light pt-3 pb-3">
        <h1 class="text-center">ค้นหาข้อมูลการลา/ขออนุญาต</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- สร้างแบบฟอร์มด้วย Bootstrap 4-->
            <div class="col-md-3">
                <div class="container">
                    <form name="search_user" id="search_user" method="POST" action="index_search.php">
                         <div class="form-group row">
                            <label for="reg_date" class="col-sm-3 col-form-label">วันที่</label>
                            <div class="col-sm-9">
                            <input type="date" class="form-control" id="reg_date" name="reg_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="teacher_name" class="col-sm-3 col-form-label">ชื่อ-สกุล</label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" id="teacher_name" name="teacher_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="province" class="col-sm-3 col-form-label">&nbsp;</label>
                            <div class="col-sm-9">
                            <input type="submit" class="btn btn-primary" id="submit" name="submit" value="ค้นหา">
                            <input type="button" class="btn btn-primary" id="resetform" name="resetform" value="ล้างข้อมูลการค้นหา">
                            </div>
                        </div>
                    </form>
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
            // ============================================================================
            // เริ่มต้นให้โหลดข้อมูลทั้งหมดออกมาแสดง โดยเรียกฟังก์ชัน all_users()
            all_users();  // สร้างฟังก์ชันดึงข้อมูลจากตาราง user ทั้งหมด โดยอ่านจากไฟล์ all_users.php
            function all_users(){
                $.ajax({ 
                        url: 'all_users.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){ // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                                var trstring =""; // ตัวแปรนับจำนวนแถว
                                var countrow = 1;
                                // วนลูปข้อมูล JSON ลงตาราง
                                $.each(data, function(key, value){
                                    // ทดสอบแสดงชื่อ      // console.log(value.fullname); // แสดงค่าลงในตาราง
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
										<td class="text-center" width="5%">${value.nday} วัน</td>
										<td class="text-center" width="8%">${value.who_respon}</td>
										
                                    </tr>`;
                                    $('table tbody').html(trstring);
                                    countrow++;
                        });
                    }
                });
            }

            // ============================================================================
            $('form#search_user').submit(function(event) { // เมื่อมีการ submit form
               event.preventDefault();
                var reg_date = $('input#reg_date').val(); // รับค่าจากฟอร์ม
                var teacher_name = $('input#teacher_name').val();    
				//alert('วันที่ '+reg_date);				
                $.ajax({ // ส่งค่าไป search_result.php ด้วย jQuery Ajax
                    url: 'search_result.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        reg_date:reg_date,
                        teacher_name:teacher_name
                    },
                    success: function(data){
                        if(data.length != 0){
                            var trstring ="";  // กรณีมีข้อมูล // กำหนดตัวแปรเก็บโครงสร้างแถวของตาราง
                            var countrow = 1;   // ตัวแปรนับจำนวนแถว
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
										<td class="text-center" width="5%">${value.nday} วัน</td>
										<td class="text-center" width="8%">${value.who_respon}</td>
										
                                    </tr>`;
                                $('table tbody').html(trstring);
                                countrow++;
                            });
                        }else{
                            alert('ไม่พบข้อมูลที่ค้นหา'+reg_date);
                        }
                    }
                });
            });

            // ============================================================================
            
            $('input#resetform').click(function(){ // เมื่อกดปุ่มล้างข้อมูลการค้นหา
                $("#search_user").trigger('reset'); // ล้างค่าในฟอร์มทั้งหมด
                $('input#reg_date').focus(); // โฟกัสช่องชื่อ
				$('table tbody').html("");
                all_users(); // เรียกแสดงผลข้อมูลทั้งหมด
            });
        });
    </script>
</body>
</html>