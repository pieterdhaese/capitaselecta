<?php
$title="login";
require_once "includes/header.php";
require_once("includes/db_functions.php");
session_start();
$conn=get_db_connection();
$users=get_all_users($conn);
$data=array();
if (isset($_POST["submit"]))
{
	if(isset($_POST["username"]) && $_POST["username"] !='')
	{
		$data['username']=$_POST["username"];
		if(isset($_POST["wachtwoord"]) && $_POST["wachtwoord"] !='')
		{
			$data['wachtwoord']=md5($_POST["wachtwoord"]);
			foreach($users as $user)
			{
				if ($user['username']==$data['username'])
				{
					if ($user['password']==$data['wachtwoord'])
					{
						$_SESSION['username']=$data['username'];
						$_SESSION['admin']=$user['admin'];
						$message= 'succesvol ingelogd';
						header('Location: home.php');
					}else
					{
						$message= "fout wachtwoord" ;
					}			
				}else
				{
					$message= "username bestaat niet";
				}
			}
		}else
		{
			echo "vul uw wachtwoord in";
		}
	}else
	{
		echo 'vul username in';
	}
	echo $message;
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
				<pre>
<h1>username:</h1><input name="username" type="text" size="25" />
<h1>wachtwoord:</h1><input name="wachtwoord" type="password" size="15" />
                </pre>
					<input type="submit" name="submit" value="Log in" />
					<a href="register.php">register</a>
                    
    </form>

<?php
require_once "includes/footer.php";
?>