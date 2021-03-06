<?php
$cssPath = "css/index.css";
session_start();
require_once("class.user.php");

$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
$description="";    
require("includes/header.php");
?>
<body>

       <form method="post" id="login-form">
      
        <h2>Log In</h2>
        
        <div id="error">
        <?php
			if(isset($error))
			{
				?>
                   <?php echo $error; ?>
                <?php
			}
		?>
        </div>
        
        <div class="form-group has-default bmd-form-group">
        <input class="form-control" type="text" name="txt_uname_email" placeholder="Username or E-mail" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group has-default bmd-form-group">
        <input class="form-control" type="password" name="txt_password" placeholder="Your Password" />
        </div>
        
        <div>
            <button class="btn btn-info" type="submit" name="btn-login">Log in</button>
        </div>  
      	<br />
            <form>
                <input type="button" class="btn btn-primary" value="Sign up" onclick="window.location.href='sign-up.php'" />
            </form> 
      </form>

</body>
</html>