
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
<title>Edit  book</title>
</head>

<body>
<?php



/* Update Student Detail Php  */

if(isset($_POST['uid'])) // Get id
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
	
	$query="update publisher SET pname='$pname',address='$address',phone='$phone'";	
$res1=mysqli_query($conn,$query1);

	
	
$query="update book SET book_id='$book_id',title='$title',sem='$sem',pname='$pname',pubyear='$pubyear',amount='$amount'";	
$res=mysqli_query($conn,$query);	




$query2="update bookauthor SET book_id='$book_id',authorname='$authorname'";	
$res2=mysqli_query($conn,$query2);

$query3="update librarybranch SET branch_id='$branch_id',branchname='$branchname'";	
$res3=mysqli_query($conn,$query3);


$query4="update bookcopies SET book_id='$book_id',branch_id='$branch_id',noofcopies='$noofcopies'";	
$res4=mysqli_query($conn,$query4);


if(!($res)&&!($res1)&&!($res2)&&!($res3)&&!($res4) ){
	die("Query Failed!" . mysqli_connect_errno());
}
else{
	echo "data updated   successfully";
}
}

}

?>

<?php
$eid=$_GET['id'];
$sql="SELECT * FROM b.book_id,b.sem,p.phone,b.amount,b.availability,b.title,ba.authorname,b.pname,b.pubyear,bc.noofcopies,p.address,bc.branch_id,lb.branchname
from book b,publisher p,bookauthor ba,bookcopies bc,librarybranch lb WHERE b.book_id = ba.book_id
and ba.book_id=bc.book_id
and b.pname=p.pname
and bc.branch_id = lb.branch_id
 and b.book_id='$eid'";
$getdata=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($getdata);


?>

<h2>hi</h2>
<!-- Edit Student Detail Form  -->
<form method="post" action="<?php $_SERVER['PHP_SELF']?>">
<table align="center" width="500px" cellpadding="5" cellspacing="5">


<tr>
<td>BOOK ID:</td>
<td><input type="text" name="book_id" value="<?php echo $row['book_id']?>" /></td>
</tr>


<tr>
<td>TITLE:</td>
<td><input type="text" name="title" value="<?php echo $row['title']?>" /></td>
</tr>

<tr>
<td>AUTHOR NAME:</td>
<td><input type="text" name="authorname" value="<?php echo $row['authorname']?>" /></td>
</tr>

<tr>
<td>PUBLISHER NAME:</td>
<td><input type="text" name="pname" value="<?php echo $row['pname']?>" /></td>
</tr>
<tr>
<td>SEM :</td>
<td><input type="text" name="sem" value="<?php echo $row['sem']?>" /></td>
</tr>



<tr>
<td>PUBLISHED YEAR:</td>
<td><input type="text" name="pubyear" value="<?php echo $row['pubyear']?>"  /></td>
</tr>



<tr>
<td>ADDRESS:</td>
<td><input type="text" name="address" value="<?php echo $row['address']?>" /></td>


</tr>

<tr>
<td>PHONE:</td>
<td><input type="text" name="phone" value="<?php echo $row['phone']?>" /></td>
</tr>

<tr>
<td>BRANCH ID:</td>
<td><input type="text" name="branch_id" value="<?php echo $row['branch_id']?>" /></td>
</tr>

<tr>
<td>BRANCH NAME:</td>
<td><input type="text" name="branchname" value="<?php echo $row['branchname']?>" /></td>
</tr>





<tr>
<td>NO OF COPIES:</td>
<td><input type="text" name="noofcopies" value="<?php echo $row['noofcopies']?>" /></td>
</tr>


<tr>
<td>AMOUNT:</td>
<td><input type="text" name="amount" value="<?php echo $row['amount']?>" /></td>
</tr>
 <tr>
 <td>AVAILABILITY:</td>
<td><input type="text" name="availability" value="<?php echo $row['availability']?>" /></td>
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
mysqli_close($conn);
?>