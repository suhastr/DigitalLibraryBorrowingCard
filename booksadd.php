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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Record</title>

</head>
<h2 align="center">Simple add,edit,update,delete using php-Phpboys.in</h2>
<body>
<?php


 // Database Config

/* Add Student Detail Php  */

if(isset($_POST['add'])) // Check form submit or not
{
$book_id=$_POST['book_id'];	

$sem=$_POST['sem'];

$title=$_POST['title'];		

$pname=$_POST['pname'];

$pubyear=$_POST['pubyear'];

$amount=$_POST['amount'];

$noofcopies=$_POST['noofcopies'];

$availability=$_POST['availability'];

$address=$_POST['address'];

$branch_id=$_POST['branch_id'];

$branchname=$_POST['branchname'];
$phone=$_POST['phone'];

if(empty($book_id) || empty($sem) || empty($title) || empty($pname) || empty($pubyear) || empty($amount) || empty($noofcopies) || empty($availability) || empty($address) || empty($branch_id) || empty($branchname)){
		echo "Oops can't leave fields empty";
	}

else
{
	
$sql="insert into  publisher values('$pname','$address','$phone')";
$sql1="insert into  book values('$book_id','$sem','$title','$pname','$pubyear','$amount','$availability')";
$sql2="insert into  bookauthor values('$book_id','$branch_id','$noofcopies')";
$sql3="insert into librarybranch values('$branch_id','$branchname')";
$sql4="insert into bookcopies values('$book_id','$branch_id','$noofcopies')";


$res=mysqli_query($conn,$sql);
$res1=mysqli_query($conn,$sql1);
$res2=mysqli_query($conn,$sql2);
$res3=mysqli_query($conn,$sql3);
$res4=mysqli_query($conn,$sql4);

if(!($res)&&!($res1)&&!($res2)&&!($res3)&&!($res4)){
	die("Query Failed!" . mysqli_connect_errno());
}
else{
	echo "data inserted   successfully";
}
	}
}

?>
<h2><?php echo "data inserted   successfully" ?></h2> 


<table align="center" width="400px" cellpadding="5" cellspacing="5" bgcolor="#E6E6E6" border="1" rules="all">
<tr>
<td><a href="booksadd.php">Add books to library</a></td>

<td><a href="manage-bookdetail.php">Manage books</a></td>

</tr>

</table>




<!-- Add Student Detail Form  -->
<h3 align="center">Add books Detail</h3>
<form  action="booksadd.php" method="POST">
<table align="center" width="500px" cellpadding="5" cellspacing="5">

<tr>

<td>PUBLISHER NAME:</td>
<td><input type="text" name="pname" /></td>
</tr>

<td>SEM :</td>
<td><input type="text" name="sem" /></td>
</tr>


<td>TITLE:</td>
<td><input type="text" name="title" /></td>
</tr>


<td>BOOK ID:</td>
<td><input type="text" name="book_id" /></td>
</tr>


<td>PUBLISHED YEAR:</td>
<td><input type="text" name="pubyear" /></td>
</tr>


<td>AUTHOR NAME:</td>
<td><input type="text" name="authorname" /></td>
</tr>


<td>ADDRESS:</td>
<td><input type="text" name="address" /></td>


</tr>


<td>PHONE:</td>
<td><input type="text" name="phone" /></td>
</tr>


<td>BRANCH ID:</td>
<td><input type="text" name="branch_id" /></td>
</tr>


<td>BRANCH NAME:</td>
<td><input type="text" name="branchname" /></td>
</tr>


<td>AVAILABILITY:</td>
<td><input type="text" name="availability" /></td>
</tr>



<td>NO OF COPIES:</td>
<td><input type="text" name="noofcopies" /></td>
</tr>



<td>AMOUNT:</td>
<td><input type="text" name="amount" /></td>
</tr>





<td colspan="2" align="center"><input type="submit" name="add" value="Add book" /></td>
</table>
</form>
<!-- Add Student Detail Form  -->
</body>
</html>
<?php 
mysqli_close($conn);
?>