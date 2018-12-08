<?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname="book";
$conn = mysqli_connect($host,$dbuser,$pass,$dbname);
if(mysqli_connect_errno()){
	die("connection Failed!" . mysqli_connect_errno());
}
else{
	echo "connected  to database {$dbname}";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Record</title>
</head>

<body>
<?php



/* Delete Student Detail Php  */

if(isset($_GET['did'])) // Get Id
{

$did=$_GET['did'];
$query="DELETE FROM book WHERE book_id='$did'";	
$res=mysqli_query($conn,$query);	
if(!($res)){
	die("Query Failed!" . mysqli_connect_errno());
}
else{
	echo "deleted successfully";
}
	}






?>

<?php
if(isset($_GET['msg']))
{
?>
<h2 align="center"><?php echo $_GET['msg'] // Message From Edit Page?></h2> 
<?php	
}
?>
<h2 align="center"><?php echo "edit" ?></h2> 


<table align="center" width="400px" cellpadding="5" cellspacing="5" bgcolor="#E6E6E6" border="1" rules="all">
<tr>
<td><a href="booksadd.php">Add book</a></td>

<td><a href="manage-bookdetail.php">Manage BOOK</a></td>

</tr>

</table>

<!-- Manage Student Detail  -->
<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>id</td>
<td>TITLE</td>
<td>AUTHOR NAME</td>
<td>PNAME</td>
<td>PUBLISHED YEAR</td>
<td>NO OF COPIES</td>
<td>Edit</td>
<td>Delete</td>
</tr>




<?php
$i=1;
$sql="select b.book_id,b.title,ba.author_name,b.pname,b.pubyear,bc.noofcopies from book b,bookauthor ba ,bookcopies bc
where b.book_id=ba.book_id
and ba.book_id=bc.book_id
and b.book_id=bc.book_id";
$getdata=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($getdata))
{
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row['title'];?></td>



<td>
<?php echo $row['author_name'];?>
</td>



<td><?php echo $row['pname'];?></td>


<td><?php echo $row['pubyear'];?></td>
<td><?php echo $row['noofcopies'];?></td>


<td><a href="edit-bookdetail.php?id=<?php echo $row['book_id']?>">Edit</a></td>
<td><a href="manage-bookdetail.php?did=<?php echo $row['book_id']?>">Delete</a></td>
</tr>
<?php
$i++;
}
?>
</table>
<!-- Add Student Detail Form  -->
</body>
</html>
<?php 
mysqli_close($conn);
?>