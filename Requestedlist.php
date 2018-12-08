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
<html>
<head>

<title>source</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <script>
window.onload = function () {
    var eSelect = document.getElementById('yourSelectID');

    eSelect.onchange = function () {
        var strUser = eSelect.options[eSelect.selectedIndex].value;
        window.location.replace("Returnedbooks.php?sid=" + strUser);
    }
}
</script>
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
}
</style>
</head>
<body>



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
<?php
if(isset($_POST['submit'])){?>
	
	<?php
	$search=$_POST['search'];
	?>
	
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Dropdown link
      </a>
      <div class="dropdown-menu">
       <select id="yourSelectID" >
    <option value="">DROPDOWN</option>
    <option value="$search">Returnedbooks</option>
    <option value="102">ec</option>
    <option value="012014">test4</option>
</select>
      </div>
    </li>
  </ul>
</nav>

<?php
}
?>



<!-- Add Student Detail Form  -->
</body>
</html>
<?php 
mysqli_close($conn2);
?>	


