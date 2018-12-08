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

<!DOCTYPE html>
<html>
<head>
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

<script>
// Get the elements with class="column"
var elements = document.getElementsByClassName("column");

// Declare a loop variable
var i;

// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "100%";
  }
}

// Grid View
function gridView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
  }
}

/* Optional: Add active class to the current button (highlight it) */
var container = document.getElementById("btnContainer");
var btns = container.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
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
<style>
  * {
    box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
    float: left;
    width: 50%;
    padding: 10px;
}

/* Clear floats after the columns */
.row:after {
    content: "";
    display: table;
    clear: both;
}
/* Style the buttons */
.btn {
    border: none;
    outline: none;
    padding: 12px 16px;
    background-color: #f1f1f1;
    cursor: pointer;
}

.btn:hover {
    background-color: #ddd;
}

.btn.active {
    background-color: #666;
    color: white;
}
  
  
  
  
</style>
</head>
<body>

<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <select id="yourSelectID" >
    <option value="">BRANCH</option>
    <option value="115">ise</option>
    <option value="102">ec</option>
    <option value="31">cv</option>
</select>
 <a href="books.php">books</a>
  <div class="search-container">
    <form action="studentsearch.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
<div id="btnContainer">
<button class="btn" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
<button class="btn active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
</div>
<br>
<?php
$usn = $_SESSION["usn"];
$sql="select title,authorname from bookborrowed where id=1 and usn='$usn'";

$res=mysqli_query($conn2,$sql);
 
if(!($res)){
	
	die("Query Failed! res in studendash" . mysqli_connect_errno());

}

 else{
	while($row=mysqli_fetch_assoc($res))
{
?>
 
<div class="row">

 
  <div class="column" style="background-color:#aaa;">
    <h2>TEXT BOOK1</h2>
    <p><?php echo $row['title'];?></p>
	<p><?php echo $row['authorname'];?></p>
  </div>


  <div class="column" style="background-color:#bbb;">
    <h2>TEXT BOOK2</h2>
   <p><?php echo $row['title'];?></p>
	<p><?php echo $row['authorname'];?></p>
  </div>

</div>

<div class="row">

  <div class="column" style="background-color:#ccc;">
    <h2>TEXT BOOK3</h2>
    <p><?php echo $row['title'];?></p>
	<p><?php echo $row['authorname'];?></p>
  </div>


  <div class="column" style="background-color:#ddd;">
    <h2>TEXT BOOK4</h2>
   <p><?php echo $row['title'];?></p>
	<p><?php echo $row['authorname'];?></p>
  </div>
 
</div>
<?php

}
 }

?>
<div style="padding-left:16px">
  
</div>

</body>
</html>
