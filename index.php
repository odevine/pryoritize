<?php
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
        
        <div>
        <input type="text" name="txt_uname_email" placeholder="Username or E-mail" required />
        <span id="check-e"></span>
        </div>
        
        <div>
        <input type="password" name="txt_password" placeholder="Your Password" />
        </div>
        
        <div>
            <button type="submit" name="btn-login">Log in</button>
        </div>  
      	<br />
            <label><a href="sign-up.php">Sign up</a></label>
      </form>

</body>
</html>