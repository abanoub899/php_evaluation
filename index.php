<?php
session_start();
// header.php
include ('header.php');
?>


<?php
include("config.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
   // username and password sent from form 
   if(!empty($_POST['username']) && !empty($_POST['password'])) {  

    $myusername = mysqli_real_escape_string($db,$_POST['username']);
    $mypassword =md5(mysqli_real_escape_string($db,$_POST['password'])) ; 
    
    $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($db,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $active = $row['active'];
    
    $count = mysqli_num_rows($result);
    
    // If result matched $myusername and $mypassword, table row must be 1 row
  
    if($count == 1) {

      	// if remember me clicked . Values will be stored 
			if(!empty($_POST["remember"])) {
      //  $_SESSION['login_user'] = $myusername;
      //COOKIES for username
// setcookie ("user_login",$_POST["username"],time()+ (10 * 365 * 24 * 60 * 60));
//COOKIES for password
setcookie ("userpassword",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
         }
       header("location: welcome.php");
    }
    else {
       $error = "Your Login Name or Password is invalid";
    }
    
}
}

?>

<section id="login-form">
<div class="container">
  <h2>login page</h2>
  <form action = "" method = "post">
    <div class="form-group">
      <label for="username">UserName:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter UserName" name="username"required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php if(isset($_COOKIE["userpassword"])) { echo $_COOKIE["userpassword"]; } ?>"required>
    </div>
    <div class="form-group form-check">
      <label class="form-check-label">
        <input class="form-check-input" type="checkbox" name="remember"> Remember password
      </label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</section>

<?php
// footer.php
include ('footer.php');
?>