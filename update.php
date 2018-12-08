 <?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname1="book";
$dbname2="studentdb";
$dbname2="request";
$conn1 = mysqli_connect($host,$dbuser,$pass,$dbname1);
$conn2 = mysqli_connect($host,$dbuser,$pass,$dbname2);
$conn3 = mysqli_connect($host,$dbuser,$pass,$dbname2);
if(mysqli_connect_errno()){
	die("connection Failed!" . mysqli_connect_errno());
}

?>

<?php
if(isset($_POST['uid'])) // Get Id
{
	$cardno=$_POST['cardno'];
	
	$usn = $_POST['usn'];
	
	$bookid=$_POST['bookid'];
	
	$datein=$_POST['datein'];
	$dateout=$_POST['dateout'];
	
	

$sql01= "INSERT INTO Returnedbooks VALUES ('$usn','$cardno','$bookid','$datein','$dateout','no')";
    $res7=mysqli_query($conn3,$sql01);
    
	
	
	

	
	
	

$sql6="delete from Requestedbooks where cardno='$cardno'";
$res6=mysqli_query($conn2,$sql6);

if(!($res6)){
	die("Query Failed! res6 in requested list" . mysqli_connect_errno());
}
else{
	 header( "Location: managerequest.php" ); die;
}

}
?>
<html>
<head>
</head>

<body>

<?php
$cardno=$_GET['id'];


$sql="select * from Requestedbooks where cardno='$cardno'";

$res=mysqli_query($conn3,$sql);
$row=mysqli_fetch_assoc($res);


?>


<!-- Edit Student Detail Form  -->
<form method="post" action="update.php">
<table align="center" width="500px" cellpadding="5" cellspacing="5">

<tr>
<td>USN:</td>
<td><input type="text" name="usn" value="<?php echo $row['usn']?>" /></td>
</tr>


<tr>
<td>CARDNO:</td>
<td><input type="text" name="cardno" value="<?php echo $row['cardno']?>" /></td>
</tr>
<tr>
<td>BOOKID:</td>
<td><input type="text" name="bookid" value="<?php echo $row['book_id']?>" /></td>
</tr>

<tr>
<td>DATE IN:</td>
<td><input type="text" name="datein" value="<?php echo $row['Date']?>" /></td>
</tr>
<tr>
<td>DATE OUT:</td>
<td><input type="text" name="dateout" value="" /></td>
</tr>






<td colspan="2" align="center">
<input type="hidden" name="uid" value="<?php echo $cardno ?>" />
<input type="submit" name="update" value="Update" /></td>
</table>
</form>
</body>
</html>