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



<html>
<head>
<title>source</title>

</head>
<body>



<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>BOOK_ID</td>

<td>TITLE</td>
<td>PNAME</td>
<td>PUBLISHED_YEAR</td>

<td>AVAILABLITY</td>
<td>ADD</td>

</tr>

<?php



/* Delete Student Detail Php  */

if(isset($_POST['update'])) // Get Id
{
$did=$_POST['uid'];
//echo $did;
$cardno=$_POST['card'];
//echo $cardno . '' ."a";
$sql3="select id,usn,cardno from bookborrowed where cardno='$cardno'";
$res=mysqli_query($conn2,$sql3);
$row=mysqli_fetch_assoc($res);
$str=$row['id'];
$usn2=$row['usn'];
$card=$row['cardno'] ;
//echo $usn2;


//echo $card .''. "b";
if($card!=$cardno){

	
	
	
	$sql5="select b.title,ba.author_name from book b,bookauthor ba where ba.book_id=$did and b.book_id=$did ";
$res3=mysqli_query($conn1,$sql5);
if(!($res3)){
die("Query Failed! res3" . mysqli_connect_errno());
}
while ($row = mysqli_fetch_assoc($res3))
{
    // escape your strings
   $title=$row['title'];
    $author=$row['author_name'];
	$usn = $_SESSION["usn"];
  // echo $title;
   
  // echo $did;
   
   $date=date("Y-m-d");
$chr="a";
$sql10 = " insert into  bookborrowed  values('$did','$usn','$cardno','$title','$author','$date')";
    
	$res7=mysqli_query($conn2,$sql10);
    
	
	
	
	
	if(!($res7)){
die("cannot borrow more than one book using same card" . mysqli_connect_errno());
}
	
	}
	
}
else{
echo "cannot borrow same book more than one";
}
	$date=date("Y-m-d");
	$usn=$_SESSION["usn"];
	$sql8="insert into RequestedBooks values('$usn','$cardno', '$did','$date')";
	
	 $res8=mysqli_query($conn3,$sql8);

if(!($res8)){
die("Query Failed! res8 in requestedbook" . mysqli_connect_errno());
}

	
	$sql2="update bookcopies 
set noofcopies=noofcopies-1
where book_id=$did";
$res=mysqli_query($conn1,$sql2);
		
$sql4="update book 
set availability='no'
where (select noofcopies from bookcopies where book_id=$did)<1
and book_id=$did";
$res1=mysqli_query($conn1,$sql4);
	


if(!($res) && !($res1)){
	die("Query Failed!" . mysqli_connect_errno());
}
else{
	$usn1=$_SESSION["usn"];
	$char1=substr($usn1, 2, 2);
	
$sql3="select * from book
where  exists(
select * from book b,librarybranch lb,bookcopies bc
where b.book_id=bc.book_id
and bc.branch_id = lb.branch_id
and lb.branch_id='$str'
)
and availability='yes'
and sem='$char1'";

$getdata=mysqli_query($conn1,$sql3);
	
if(!($getdata)){
die("Query Failed!" . mysqli_connect_errno());
}

while($row=mysqli_fetch_assoc($getdata))
{
?>
<tr>

<td><?php echo $row['book_id'];?></td>



<td>
<?php echo $row['title'];?>
</td>



<td><?php echo $row['pname'];?></td>




<td>
<?php echo $row['pubyear'];?>
</td>
<td>
<?php echo $row['availability'];?>
</td>
<td><a href="booking.php?did=<?php echo $row['book_id']?>">add</a></td>
</tr>
<?php

}
}

	}

?>

<?php

if(isset($_GET['sid'])){
	
// Echo session variables that were set on previous page
$sem = $_SESSION["usn"];

$char=substr($sem, 2, 2);



	$str = $_GET['sid'];
	
$sql="select * from book
where  exists(
select * from book b,librarybranch lb,bookcopies bc
where b.book_id=bc.book_id
and bc.branch_id = lb.branch_id
and lb.branch_id='$str'
)
and availability='yes'
and sem='$char'";
	$getdata=mysqli_query($conn1,$sql); 
	
if(!($getdata)){
die("Query Failed!" . mysqli_connect_errno());
}

while($row=mysqli_fetch_assoc($getdata))
{
?>
<tr>

<td><?php echo $row['book_id'];?></td>



<td>
<?php echo $row['title'];?>
</td>



<td><?php echo $row['pname'];?></td>




<td>
<?php echo $row['pubyear'];?>
</td>
<td>
<?php echo $row['availability'];?>
</td>
<td><a href="bookrequest.php?did=<?php echo $row['book_id'];?>">add</a></td>
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
mysqli_close($conn1);
?>