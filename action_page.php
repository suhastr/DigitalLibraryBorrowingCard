<?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname1="Bank";
$dbname2="authentication";
$conn1 = mysqli_connect($host,$dbuser,$pass,$dbname1);
$conn2 = mysqli_connect($host,$dbuser,$pass,$dbname2);
if(mysqli_connect_errno()){
	die("connection Failed!" . mysqli_connect_errno());
}

?>
<html>
<head>
<title>source</title>

</head>
<body>
<?php

if(isset($_POST['update'])){
	$usn1=$_POST['usn'];
	$sname2=$_POST['sname'];
	$sem=$_POST['sem'];
	$branch = $_POST['branch'];
	$fee = $_POST['feepaid'];
	
	if(empty($usn1) || empty($sname2) || empty($sem) || empty($branch) || empty($fee)){
		echo "Oops can't leave fields empty";
	}
	else{
		$sql1="insert into studentlist values('$usn1','$sname2','$sem','$branch','$fee')";
		$sql2="insert into student values('$usn1','$sname2','$sem','$branch','$fee');";
		$res1=mysqli_query($conn1,$sql2);
		$res2=mysqli_query($conn2,$sql1);
	
if(!($res1 && $res2)){
	die("Query Failed!" . mysqli_connect_errno());
}
else{
	 header( "Location: bank.php" ); die;
}
	}
}
?>

</body>
</html>
<?php 
mysqli_close($conn1);
mysqli_close($conn2);

?>