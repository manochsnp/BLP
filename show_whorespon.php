<?php
include('connectdb.php'); 
$who_respon = $_GET['who_respon'];
$sql = "SELECT * FROM teacher WHERE teacher_name LIKE '%".$who_respon."%'"; 
$result = $conn->query($sql); 
if ($result->num_rows > 0) {
  $teacherData = array(); 
  while($row = $result->fetch_assoc()) {
   $data['id']    = $row['id']; 
   $data['value'] = $row['teacher_name'];
   array_push($teacherData, $data);
} 
}
 echo json_encode($teacherData);
?>