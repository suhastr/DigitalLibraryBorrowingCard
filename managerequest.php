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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit  book</title>
</head>

<body>

<!-- Manage Student Detail  -->
<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>id</td>
<td>USN</td>
<td>CARDNO</td>
<td>BOOKID</td>

<td>DATEOUT</td>
<td>Edit</td>

</tr>




<?php
if(isset($_POST['submit'])){
$i=1;
$search=$_POST['search'];
$sql="select * from Requestedbooks where usn='$search'";




$getdata=mysqli_query($conn3,$sql);

while($row=mysqli_fetch_array($getdata))
{
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row['usn'];?></td>



<td>
<?php echo $row['cardno'];?>
</td>



<td><?php echo $row['book_id'];?></td>


<td><?php echo $row['Date'];?></td>



<td><a href="update.php?id=<?php echo $row['cardno']?>">Edit</a></td>

</tr>
<?php
$i++;
}
}
?>
</table>
<!-- Add Student Detail Form  -->
</body>
</html>
<?php 
mysqli_close($conn3);
?>