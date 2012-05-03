<?php
require_once("includes/db_functions.php");
session_start();
?>
<html>
<head>
</head>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
				<pre>
<h1>e-mailadres:</h1><input name="email" type="text" size="25" />
<h1>wachtwoord:</h1><input name="wachtwoord" type="password" size="15" />
                </pre>
					<input type="submit" name="submit" value="Inloggen" />
					<a href="register.php">registreer</a>
                    
    </form>
</body>
</html>