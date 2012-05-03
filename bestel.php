<?php
// $title="Bestellen";
// require_once "includes/header.php";
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);
if(isset($_POST["submit"]))
{


?>

<div id="content">
<ul>
<li><a href="bestel.php">bestelling invoeren</a></li>
<li><a href="bestel.php">bestelling afhandelen</a></li>
</ul>
</div>


<div id="footer_text_register">
<h11>by Pieter D'haese &copy; 2012 All Rights Reserved<h11>        
        </div>
</div>

</div>


</body>
</html>