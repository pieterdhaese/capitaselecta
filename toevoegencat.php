<?php
$title="Categorie toevoegen";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
$conn=get_db_connection();
$cat=array();

// print_r($_POST);
if (isset($_POST["submit"]))
{
	if(isset($_POST['catnaam'])&& $_POST['catnaam'] != '')
	{
		$cat=$_POST['catnaam'];
		// echo $data;
		put_cat_in_database($cat,$conn);
		echo $_POST['catnaam'] . " is toegevoegd";
	}else
	{
		echo "vul een naam in";
	}
}
?>

<div id="content">
<form id="toevoegen" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
naam : <input name="catnaam" type="text"/></br>
<input type="submit" name="submit" value="toevoegen"/>
</form>
</div>

<?php
require_once "includes/footer.php";
?>