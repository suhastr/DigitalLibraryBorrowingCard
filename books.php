 <?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname1="book";
$dbname2="studentdb";

$conn1 = mysqli_connect($host,$dbuser,$pass,$dbname1);
$conn2 = mysqli_connect($host,$dbuser,$pass,$dbname2);
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
window.onload = function () {
    var eSelect = document.getElementById('yourSelectID');

    eSelect.onchange = function () {
        var strUser = eSelect.options[eSelect.selectedIndex].value;
        window.location.replace("booking.php?sid=" + strUser);
    }
}
</script>
<style>
* {box-sizing: border-box;}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
}

.topnav {
  overflow: hidden;
  background-color: #e9e9e9;
}

.topnav a {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #2196F3;
  color: white;
}
.topnav select {
  float: left;
  display: block;
  color: black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav select:hover {
  background-color: #ddd;
  color: black;
}

.topnav select.active {
  background-color: #2196F3;
  color: white;
}

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

<div class="topnav">
  <a class="active" href="studentdashboard.php">Home</a>
  <a href="#about">About</a>
  <select id="yourSelectID" >
    <option value="">BRANCH</option>
    <option value="101">ise</option>
    <option value="102">ec</option>
    <option value="012014">test4</option>
</select>
 <a href="books.php">books</a>
  <div class="search-container">
    <form action="studentsearch.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>

<div style="padding-left:16px">
  
</div>



<table align="center" width="500px" cellpadding="5" cellspacing="5" border="1px" rules="all">
<tr>
<td>BOOK_ID</td>
<td>CARDNO</td>
<td>TITLE</td>
<td>authorname</td>

<td>Dateout</td>


</tr>
<?php 
$usn = $_SESSION["usn"];
$sql="select * from bookborrowed where usn='$usn'";

$res=mysqli_query($conn2,$sql);

if(!($res)){
	die("Query Failed! res" . mysqli_connect_errno());
}
else{
while($row=mysqli_fetch_assoc($res)){
?>
<tr>

<td><?php echo $row['id'];?></td>

<td>
<?php echo $row['cardno'];?>
</td>



<td>
<?php echo $row['title'];?>
</td>



<td><?php echo $row['authorname'];?></td>





<td>
<?php echo $row['Dateout'];?>
</td>

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















