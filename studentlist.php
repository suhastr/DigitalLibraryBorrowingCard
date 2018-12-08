<?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname="authentication";
$dbname1="studentdb";
$conn1 = mysqli_connect($host,$dbuser,$pass,$dbname1);
$conn = mysqli_connect($host,$dbuser,$pass,$dbname);
if(mysqli_connect_errno()){
	die("connection Failed!" . mysqli_connect_errno());
}
else{
	echo "";
}
?>

<?php
if(isset($_GET['did']))
{
	$usn=$_GET['did'];
echo $usn;
	
	  do{
		  $i=1;
	  foreach (range('A', 'C') as $char) {
   
	$result = $usn . $char;
	
	$sql1="insert into card values ('$usn','$result')";
	$query1 =  mysqli_query($conn1,$sql1);
	 
	
	
	  }
	   $i++;
	   
	   }while($i!=3);

	 
	
    $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string_shuffled = str_shuffle($string);
    $password = substr($string_shuffled, 1, 7);

  


    $password = base64_encode($password);
	
	  mysqli_query($conn,"insert into student(usn) values ('$usn')  ");
  
	
    $query = mysqli_query($conn,"UPDATE student SET  pass='$password' WHERE usn ='$usn'  ");
 
	
	
	if(!($query) ){
	die("Query Failed!" . mysqli_connect_errno());
}else{
	  mysqli_query($conn,"delete from studentlist where usn='$usn'  ");
}
}

?>




















<table align="center" width="400px" cellpadding="5" cellspacing="5" bgcolor="#E6E6E6" border="1" rules="all">


</table>

<!-- Manage Student Detail  -->
<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>ID</td>
<td>usn</td>
<td>sname</td>
<td>sem</td>
<td>branch</td>
<td>feepaid</td>
<td>generate</td>
</tr>




<?php
$i=1;
$sql="select * from studentlist";
$getdata=mysqli_query($conn,$sql);
if(!($getdata) ){
	die("Query Failed! getdata" . mysqli_connect_errno());
}

while($row=mysqli_fetch_assoc($getdata))
{
?>
<tr>
<td><?php echo $i ?></td>
<td><?php echo $row['usn'];?></td>


<td>
<?php echo $row['sname'];?>
</td>



<td>
<?php echo $row['sem'];?>
</td>



<td><?php echo $row['branch'];?></td>


<td><?php echo $row['feepaid'];?></td>



<td><a href="studentlist.php?did=<?php echo $row['usn']?>">generate</a></td>



</tr>
<?php
$i++;
}
?>
</table>
</body>
</html>