<?php
// $title="Afhandelen";
// require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
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


<?php
require_once "includes/footer.php";
?>