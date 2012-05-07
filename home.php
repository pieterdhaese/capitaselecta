<?php
$title="Home";
require_once "includes/header.php";
session_start();
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();
if(!isset($_SESSION['username']))
{
header('Location: index.php');

}

?>

<div id="content">
<ul>
<li><a href="bestelinv.php">bestelling invoeren</a></li>
<li><a href="bestelafh.php">bestelling afhandelen</a></li>
<li><a href="bestelbet.php">bestelling betalen</a></li>
<?php
if (isset($_SESSION['admin']) && $_SESSION['admin']==1)
{
	echo "<li><a href='admin.php'>admin opties</a></li>";
}
?>
</ul>
</div>

<?php
require_once "includes/footer.php";
?>