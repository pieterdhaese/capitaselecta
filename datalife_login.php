<?php
ob_start();
$title="DATAlife - inloggen";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
require_once "includes/startsesion.php";
$conn=get_db_connection();
$users=get_values(get_users($conn));
// print_r($users);
if(isset($_POST["submit"]))
{
	if (isset($_POST["email"]))
	{
		$login=$_POST["email"];
		
		if (isset($_POST["wachtwoord"]))
		{
			
			$pass=$_POST["wachtwoord"];
	
			foreach($users as $user){
				if($user["username"]==$login)
				{
					if($user["password"]==md5($pass))
					{
						echo "Ingelogd : Connecté";
						 header("Location: http://www.blurr.be/test/datalife_home.php");
					}else
					{
						echo "Wachtwoord verkeerd / Faux mot de passe";
					}
				}
			}
		}
	}
}
ob_flush();
?>


        <div class="box">
        <div class="login_box_background">
        <div class="login">
        <h2>RS-Electro</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
				<pre>
<h1>e-mailadres:</h1><input name="email" type="text" size="25" />
<h1>wachtwoord:</h1><input name="wachtwoord" type="password" size="15" />
					<input type="hidden" name="verzonden" value"1" />
                	<input type="hidden" name="datum" value="<?php echo date ("YmdHis"); ?> " />
                </pre>
					<input type="submit" name="submit" value="Inloggen" />
					<input type="reset" name="Wissen" value="Reset" />
                    
    </form>
        </div>
        </div>
		</div>
        <div id="footer_text_login">
<h11>by Jonas Haezebrouck and Pieter D'haese &copy; 2012 Blurr.be All Rights Reserved<h11>        
        </div>
        </div>  
        </div>    
</body>
</html>
