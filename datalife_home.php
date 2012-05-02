<?php
$title="DATAlife - inloggen";
require_once "includes/header.php";
require_once "includes/db_functions.php" ;
$conn=get_db_connection();
$data=array();
// echo count($users);
// print_r($_POST);
if(isset($_POST["submit"]))
{


	if(isset($_POST["date1"]))
	{
		$data["member_id"]=32;
		$data["datum"]=$_POST["date1"];
		if(isset($_POST["werf"]))
		{
			$data["werf_id"]=$_POST["werf"];
			if(isset($_POST["bhour"])){
				if(isset($_POST["bmin"])){
					$data["begin_uur"]=$_POST["bhour"] . ":" . $_POST["bmin"];
					if(isset($_POST["ehour"]))
					{
						if(isset($_POST["emin"]))
						{
							$data["eind_uur"]=$_POST["ehour"] . ":" . $_POST["emin"];
							if(isset($_POST["pauze"]))
							{
								$data["pauze"]=$_POST["pauze"];
								if(isset($_POST["chauffeur"]))
								{
									$data["chauffeur"]=$_POST["chauffeur"];
									
								put_data_in_database($data,$conn);
								}
							}
						}
					}
				}
			}
		}
	}
}

?>

<div class="home_box_background">
<div class="login">
<form action="datalife_home.php" method="post">

<?php
	require_once("calendar.php");
?>
<label><h1>werf:</h1></label>
<select name="werf">
	<?php 
	echo '<option value="' . " " . '">' . " " . '</option>';
	fill_option_werf($conn);
	?>
</select>
<label><h1>begin uur:</h1></label>
<select name="bhour">
<?php
for($i=0;$i<24;++$i)
{
echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
</select>
<select name="bmin">
<?php
for($i=0;$i<60;++$i)
{
echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
</select>

<label><h1>eind uur:</h1></label>
<select name="ehour">
<?php
for($i=0;$i<24;++$i)
{
echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
</select>
<select name="emin">
<?php
for($i=0;$i<60;++$i)
{
echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
</select>

<label><h1>pauze:</h1></label>
<select name="pauze">
<?php
for($i=0;$i<60;++$i)
{
echo '<option value="' . $i . '">' . $i . '</option>';
}
?>
</select>

<label><h1>chauffeur:</h1></label>
<select name="chauffeur">
<?php
	echo '<option value="' . " " . '">' . " " . '</option>';
	fill_option_users($conn);
?>
</select><br />
<input type="submit" name="submit" value="Stuur door"/><br />
</form>
</div>
</div>

<div id="footer_text_register">
<h11>by Jonas Haezebrouck and Pieter D'haese &copy; 2012 Blurr.be All Rights Reserved<h11>        
        </div>
</div>

</div>


</body>
</html>