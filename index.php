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
					<input type="hidden" name="verzonden" value"1" />
                	<input type="hidden" name="datum" value="<?php echo date ("YmdHis"); ?> " />
                </pre>
					<input type="submit" name="submit" value="Inloggen" />
					<input type="reset" name="Wissen" value="Reset" />
                    
    </form>
</body>
</html>