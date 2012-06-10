<?php
$title="Bestellen ingeven";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
session_start();
$conn=get_db_connection();
$data=array();

$bestelling=array();

if(isset($_POST["submit"]))
{
	if(isset($_POST["tafel"])&&$_POST["tafel"]!='')
	{
		$bestelling["tafel"]==$_POST["tafel"];
		if(isset($_POST["product"])&&$_POST["product"]!='')
		{
			$bestelling["product"]==$_POST["product"];
			if(isset($_POST["aantal"])&&$_POST["aantal"]!='')
			{
				$bestelling["aantal"]==$_POST["aantal"];
				// echo 'ok';
				// print_r($_POST);
				put_bestelling_in_database($bestelling,$conn);
			}else
			{
				echo 'vul een aantal in';
			}
		}else
		{
			echo 'kies een product';
		}
	}else
	{
		echo 'vul een tafelnummer in.';
	}
}


?>

<div id="content">
<form id="toevoegen" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
tafel : <input name="tafel" type="text"/></br>

product :<select name="product"> <?php 
	echo '<option value="' . "" . '">' . " " . '</option>';
	fill_option_product($conn);
	?></select></br>  
aantal:<input name="aantal" type="text"/></br>
<input type="submit" name="submit" value="toevoegen"/>
</form>
</div>


<?php
require_once "includes/footer.php";
?>