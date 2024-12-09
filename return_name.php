<?php
	require_once 'connectdb.php';

	// $objConnect = mysql_connect("localhost","root","") or die(mysql_error());
	// $objDB = mysql_select_db("bk_exitschool");
	 $strSQL = "SELECT * FROM teacher WHERE 1 AND teacher_pin = '".$_POST["teacher_pin"]."' ";
	
	// $strSQL = "SELECT * FROM teacher WHERE 1 AND teacher_pin = '1319900018601' ";

	$objQuery = mysqli_query($objConnect,$strSQL);
	//echo ($strSQL);
	$intNumField = mysqli_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysqli_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$colObj = mysqli_fetch_field_direct($objQuery,$i); 
			$arrCol[$colObj->name] = $obResult[$i];
			//$arrCol[mysqli_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	
	mysqli_close($objConnect);
	
	echo json_encode($resultArray);
?>