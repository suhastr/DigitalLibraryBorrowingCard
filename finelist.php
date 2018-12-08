 <?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname1="book";
$dbname2="studentdb";
$dbname3="request";
$conn1 = mysqli_connect($host,$dbuser,$pass,$dbname1);
$conn2 = mysqli_connect($host,$dbuser,$pass,$dbname2);
$conn3 = mysqli_connect($host,$dbuser,$pass,$dbname3);
if(mysqli_connect_errno()){
	die("connection Failed!" . mysqli_connect_errno());
}

?>
<?php



/* Delete Student Detail Php  */

if(isset($_GET['did2'])) // Get Id
{

$did=$_GET['did2'];
$query="DELETE FROM finelist WHERE cardno='$did'";	
$res=mysqli_query($conn3,$query);	
if(!($res)){
	die("Query Failed!" . mysqli_connect_errno());
}
else{
	echo "deleted successfully";
}
	}






?>
<?php
// Start the session
session_start();
?>
<html>
<head>

</head>
<body>
<?php 
if(isset($_GET['did1']))
{
	$did = $_GET['did1'];
	echo $did;
	$sql4="select book_id from finelist where cardno='$did'";
		$res=mysqli_query($conn3,$sql4);
		if(!($res)){
	die("Query Failed! res 103" . mysqli_connect_errno());
}

	$row=mysqli_fetch_assoc($res);
	$bookid=$row['book_id'];
	echo $bookid;
	
	
	$sql3="delete from bookborrowed where  id='$bookid'";
		$res1=mysqli_query($conn2,$sql3);
		if(!($res1)){
	die("Query Failed! res 103" . mysqli_connect_errno());
}
	$sql2="update bookcopies 
set noofcopies=noofcopies+1
where book_id='$bookid'";
$res=mysqli_query($conn1,$sql2);
	
	//$sql1="delete from finelist where cardno='$did'";
	$sql2 = "delete from Returnedbooks where cardno='$did'";
	
	
	
	
	

$res2=mysqli_query($conn3,$sql2);
	if(!($res2)){
	die("Query Failed! res" . mysqli_connect_errno());
}
	
	
	}





?>














<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>USN</td>

<td>cardno</td>
<td>BOOK_ID</td>

<td>Amount</td>
<td>finepaid</td>
<td>paid</td>


</tr>



<?php

$usn=$_SESSION["usn"];
	echo $usn;
$sql="select * from finelist where usn='$usn' and finepaid='no'";
$res=mysqli_query($conn3,$sql);
if(!($res)){
	die("Query Failed! res 102" . mysqli_connect_errno());
}
else{
while($row=mysqli_fetch_assoc($res)){
?>
<tr>
<td><?php echo $row['usn'];?></td>
<td><?php echo $row['cardno'];?></td>



<td>
<?php echo $row['book_id'];?>
</td>

<td><?php echo $row['amount'];?></td>

<td><?php echo $row['finepaid'];?></td>




<td><a href="finelist.php?did1=<?php echo $row['cardno'];?>">paid</a></td>
<td><a href="finelist.php?did2=<?php echo $row['cardno'];?>">delete</a></td>
</tr>
<?php



}	
}

?>
</table>
<!-- Add Student Detail Form  -->
</body>
</html>
<?php 
mysqli_close($conn2);
?>	
	
	
	




