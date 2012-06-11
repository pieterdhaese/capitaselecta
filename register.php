<?php
$title="registreer";
require_once "includes/header.php";
require_once "includes/db_functions.php";
$conn=get_db_connection();

$user=array();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
if(isset($_POST["voornaam"]) && $_POST["voornaam"] !='')
{
	$user['voornaam']=$_POST["voornaam"];
	if(isset($_POST["achternaam"]) && $_POST["achternaam"] !='')
	{
		$user['achternaam']=$_POST["achternaam"];
		$user['username']=$_POST["voornaam"].".".$_POST["achternaam"];
		if(isset($_POST["password"]) && $_POST["password"] !='')
		{
			$user['password']=md5($_POST["password"]);
			if(isset($_POST["email"]) && $_POST["email"] !='')
			{
				$user['email']=$_POST["email"];
				$user['login']=$_POST["voornaam"].".".$_POST["achternaam"];
				echo "De gebruiker werd succesvol toegevoegd";
			}else
			{
			echo "vul emailadres in";
			}
		}else
		{
			echo "vul wachtwoord in";
		}
	}else
	{
		echo "vul achternaam in";
	}
}else
{
	echo "vul voornaam in";
}





// print_r($user);
put_user_in_database($user,$conn);
}

?>
<div id="content">

<h2>Gebruiker toevoegen</h2>
<form action="register.php" method="post">
<label><h3>voornaam:</h3></label>
<input type="text" name="voornaam"/><br />
<label><h3>achternaam:</h3></label>
<input type="text" name="achternaam"/><br />
<label><h3>wachtwoord:</h3></label>
<input type="password" name="password"/><br/>
<label><h3>emailadres:</h3></label>
<input type="text" name="email"/><br />
<input type="submit" value=" Registreren "/><br />
</form>

</div>

<?php
require_once "includes/footer.php";
?>
