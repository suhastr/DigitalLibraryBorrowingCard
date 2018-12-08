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
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit  Record</title>
</head>

<body>

<?php
$eid=$_GET['did'];

$getdata=mysqli_query($conn1,"select * from book where book_id='$eid'");
$row=mysqli_fetch_assoc($getdata);
 
 $usn = $_SESSION["usn"];

?>

<h2>hi</h2>
<!-- Edit Student Detail Form  -->
<form method="post" action="booking.php">
<table align="center" width="500px" cellpadding="5" cellspacing="5">

<tr>
<td>BOOKID:</td>
<td><input type="text" name="bookid" value="<?php echo $row['book_id'];?>" /></td>
</tr>


<tr>
<td>TITLE:</td>
<td><input type="text" name="title" value="<?php echo $row['title'];?>" /></td>
</tr>



<tr>
<td>PNAME:</td>
<td><input type="text" name="pname" value="<?php echo $row['pname'];?>" /></td>
</tr>


<tr>
<td>PUBYEAR:</td>
<td><input type="text" name="pubyear" value="<?php echo $row['pubyear'];?>" /></td>
</tr>


<tr>
<td>Department:</td>
<td>
<select name="card">
<option value="<?php echo $usn.'A'?>"><?php echo $usn.'A'?></option>
<option value="<?php echo $usn.'B'?>"><?php echo $usn.'B'?></option>
<option value="<?php echo $usn.'C'?>"><?php echo $usn.'C'?></option>

</select>
</td>
</tr>


<tr>

<td colspan="2" align="center">
<input type="hidden" name="uid" value="<?php echo $eid ?>" />
<input type="submit" name="update" value="Update" /></td>
</table>
</form>
<!-- EDit Student Detail Form  -->
</body>
</html>
<?php 
mysqli_close($conn1);
?>