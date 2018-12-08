<?php
$host="localhost";
$dbuser="root";
$pass="";
$dbname="authentication";
$conn = mysqli_connect($host,$dbuser,$pass,$dbname);
if(mysqli_connect_errno()){
	die("connection Failed!" . mysqli_connect_errno());
}
else{
	echo "";
}
?>

<?php
session_start();
?>
<?php
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    // request 30 minates ago
    session_destroy();
    session_unset();
}
$_SESSION['LAST_ACTIVITY'] = time(); 

?>

<?php
/**
* Split $_SESSION by browser Tab emulator.
* methods exemples are used whith :
* $session = new SessionSplit();
* as SessionSplit may reload the page, it has to be used on top of the code.
* 
*/
class SessionSplit{
    public $id;
    private $gprefix="session_slice_";
    private $prefix="";
    private $witness="";
    function SessionSplit($witness='witness'){
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
        $this->witness=$witness;
        if($this->get_id()){
            $this->prefix=$this->gprefix.$this->id;
            //set a witness to 'register' the session id
            $this->set($this->witness,'true');
        }else{
            // force the session id in the url to not interfere with form validation
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $new_link = $actual_link.(strpos($actual_link,'?')===false?'?':'&').
                'session_id='.$this->id;
            header('Location: '.$new_link); 
        }
    }
    private function get_id(){
        if(isset($_GET['session_id'])){
            $this->id=$_GET['session_id'];
            return true;
        }else{
            $this->new_id();
            return false;
        }
    }
    private function new_id(){
        $id=0;
        while(isset($_SESSION[$this->gprefix.$id.'.'.$this->witness])){$id++;}
        $this->id=$id;
    }
    // ----------- publics
    public function clearAll(){
        foreach($_SESSION as $key=>$value){
            if(strpos($key,$this->prefix.'.')===0){
                unset($_SESSION[$key]);
            }
        }
    }
    /**
    * $is_user=$session->has('user');
    * equivalent to
    * $is_user=isset($_SESSION['user']);
    * @param {string} $local_id 
    * @return {boolean}
    */
    public function has($local_id){
        return isset($_SESSION[$this->prefix.'.'.$local_id]);
    }
    /**
    * 
    * $session->clear('user');
    * equivalent to
    * unset($_SESSION['user']);
    * @param {string} $local_id 
    */
    public function clear($local_id){
        unset($_SESSION[$this->prefix.'.'.$local_id]);
    }
    /**
    * $user=$session->get('user');
    * equivalent to
    * $user=$_SESSION['user'];
    * @param {string} $local_id 
    * @return {mixed}
    */
    public function get($local_id){
        if (isset($_SESSION[$this->prefix.'.'.$local_id])) {
            return $_SESSION[$this->prefix.'.'.$local_id];
        }else return null;
    }
    /**
    * $session->set('user',$user);
    * equivalent to
    * $_SESSION['user']=$user;
    * @param {string} $local_id 
    * @param {mixed} $value
    */
    public function set($local_id,$value){
        $_SESSION[$this->prefix.'.'.$local_id]=$value;
    }
};
?>





<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
</head>
<body background="H:\5th sem photos/library.jpg">
<?php



if(isset($_POST['submit'])){
	$usn=$_POST['uname'];
	$pass=$_POST['psw'];
	
	
	$_SESSION["usn"] = $usn;
$_SESSION["pass"] = $pass;
	
	
     if($usn>1){
		 $sql="call Foo()";
		//$sql="SELECT * FROM student WHERE usn='" . $_POST["uname"] . "' and pass = '". $_POST["psw"]."'";
		$result = mysqli_query($conn,$sql);
		
		while ($row = mysqli_fetch_assoc($result)){
			if(($usn==$row['usn'])&&($pass==$row['pass'])){
			 header( "Location: studentdashboard.php" ); die;
			}
		}
		
	}
		
	else {
	$sql1="SELECT * FROM admin WHERE usrname='" . $_POST["uname"] . "' and pass = '". $_POST["psw"]."'";
		$result1 = mysqli_query($conn,$sql1);
		
		
		$count1  = mysqli_num_rows($result1);
	if($count1==0) {
		$message = "Invalid Username or Password!";
	} else {
		 header( "Location: librarydashboard.php" ); die;
	}	
		
	}
	
}
?>


<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;" style="height:auto;">student</button>
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;" style="height:auto;">admin</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="vvce_library.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" name="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
  </div>
  
  
  <div id="id02" class="modal">
  
   <form class="modal-content animate" action="vvce_library.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <button type="submit" name="submit">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
  </form>
  
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');
var modal1 = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
 if (event.target == modal1) {
        modal.style.display = "none";
    }   
   if (event.target == modal) {
        modal.style.display = "none";
    }

}
</script>

</body>
</html>
