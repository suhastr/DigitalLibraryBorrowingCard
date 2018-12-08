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
// Start the session
session_start();
?>
<html>
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 26px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification:hover {
  background: red;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;

  
.topnav .search-container {
  float: right;
}

.topnav input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}

.topnav .search-container button {
  float: right;
  padding: 6px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=text], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
  .topnav input[type=text] {
    border: 1px solid #ccc;  
  }

  
  
  
  
  }
</style>
</head>
<body>
<?php
if(isset($_GET['did'])) // Get Id
{
	
	$did=$_GET['did'];
	
$sql3="select usn from Returnedbooks where cardno='$did'";
$res=mysqli_query($conn3,$sql3);
$row=mysqli_fetch_assoc($res);
$str=$row['usn'];
$sql = "select cardno from finelist where cardno='$did'";
$res2=mysqli_query($conn3,$sql);
$row1=mysqli_fetch_assoc($res2);
$str2=$row1['cardno'];
$sql1="select Date ,DateOut,book_id from Returnedbooks where cardno='$did' ";
$result=mysqli_query($conn3,$sql1);
$row1=mysqli_fetch_assoc($result);

$dateout=$row1['DateOut'];
$bid=$row1['book_id'];

$datetoday=date("Y/m/d");
$date = new DateTime($datetoday);
$now = new DateTime($dateout);

$diff = $date->diff($now)->format("%a");


$i=15;
if($diff > $i){
	$diff = $diff-10;
	echo $diff;
	$res45=mysqli_query($conn3,"insert into finelist values('$str','$did','$bid','$diff','no')");
if(!($res45)){
	die("Query Failed! res45 in returned list" . mysqli_connect_errno());
}else{
	 header( "Location: finelist.php" ); die;
}
	}
if($did==$str2){
	  header( "Location: finelist.php" ); die;
}
else{
	$sql0="update bookcopies set noofcopies=noofcopies+1 where book_id='$bid'";
	
	$sql6="select book_id from Returnedbooks where usn='$str' ";

$res6=mysqli_query($conn3,$sql6);

$row3=mysqli_fetch_array($res6);

$str1=$row3['book_id'];
	mysqli_query($conn1,$sql0);
$sql7="delete from bookborrowed where id='$bid'";

	$res4=mysqli_query($conn2,$sql7);
	
	if(!($res4)){
	die("Query Failed! res4 in returned list" . mysqli_connect_errno());
}





	$sql5="delete  from Returnedbooks where cardno='$did'";
	$res3=mysqli_query($conn3,$sql5);
	if(!($res3)){
	die("Query Failed! res6 in requested list" . mysqli_connect_errno());
}


	}
	
	
}



?>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Logo</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Aboutus</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Dropdown link
      </a>
     
    </li>
  </ul>
</nav>

<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>USN</td>
<td>CARDNO</td>

<td>BOOK_ID</td>

<td>DATE IN</td>
<td>DATE OUT</td>

<td>RETURNED</td>
<td>RETURN</td>


</tr>
<?php 
if(isset($_POST['submit'])){
	$search = $_POST['search'];
	$_SESSION["usn"]=$search;
	//$usn  =	$_SESSION["usn"];
$sql="select * from  Returnedbooks where usn='$search'";

$res=mysqli_query($conn3,$sql);

if(!($res)){
	die("Query Failed! res" . mysqli_connect_errno());
}
else{
while($row=mysqli_fetch_assoc($res)){
?>
<tr>

<td><?php echo $row['usn'];?></td>



<td>
<?php echo $row['cardno'];?>
</td>



<td><?php echo $row['book_id'];?></td>

<td>
<?php echo $row['Date'];?>
</td>



<td>
<?php echo $row['DateOut'];?>
</td>
<td>
<?php echo $row['Returned'];?>
</td>
<td><a href="Returnedbooks.php?did=<?php echo $row['cardno'];?>">returned</a></td>
</tr>
<?php


}
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


