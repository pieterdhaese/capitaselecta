<?php
// $title="registreer";
// require_once "includes/header.php";
require_once "includes/db_functions.php";
$conn=get_db_connection();

$user=array();
if($_SERVER["REQUEST_METHOD"] == "POST")
{
// username and password sent from Form
if(isset($_POST["voornaam"]))
{
	$user["voornaam"]=$_POST["voornaam"];
	if(isset($_POST["achternaam"]))
	{
		$username=strtolower($_POST["voornaam"]."_".$_POST["achternaam"]);
		$user["login"]=$username;
		
		$user["achternaam"]=$_POST["achternaam"];
		if(isset($_POST["password"]))
		{
			$user["password"]=md5($_POST["password"]); 
			if(isset($_POST["email"]))
			{
				$user["email"]=$_POST["email"];
				echo "de gegevens zijn ingevoerd !" ;
			}else
			{
				echo "geen email ingevuld";
			}
		}else
		{
			echo "geen password ingevuld";
		}
  	}
}else{
		echo "<h2>vul username in<h2>";
	}





// print_r($user);
put_user_in_database($user,$conn);

//$result=mysql_query($sql);
echo "Registratie Succesvol!";
}

?>


<h2>Gebruiker toevoegen</h2>
<form action="register.php" method="post">
<label><h1>voornaam:</h1></label>
<input type="text" name="voornaam"/><br />
<label><h1>achternaam:</h1></label>
<input type="text" name="achternaam"/><br />
<label><h1>wachtwoord:</h1></label>
<input type="password" name="password"/><br/>
<label><h1>emailadres:</h1></label>
<input type="text" name="email"/><br />
<input type="submit" value=" Registreren "/><br />
</form>


<div id="footer_text_register">
<h11>by  Pieter D'haese &copy; 2012 All Rights Reserved<h11>        
        </div>
</div>

</div>


</body>
</html>