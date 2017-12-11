<?php
include("../include/session.php");

if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Pamokų redagavimas</title>
            <link href="../include/styles2.css" rel="stylesheet" type="text/css" />
        </head>  
        <body>
            <table class="center"><tr><td>
                        <img src="../pictures/top.jpg"/>
                    </td></tr><tr><td> 
                        <?php
                        $_SESSION['path'] = '../';
                        include("../include/meniu.php");
						include("../include/admin_meniu.php");
						
                        /*if ($form->num_errors > 0) {
                            echo "<font size=\"4\" color=\"#ff0000\">"
                            . "!*** Error with request, please fix</font><br><br>";
                        }*/
						
						if (isset ($_POST['kurti'])){
							$pavad = $_POST['pavadinimas'];
							if($pavad != ''){
							$query="INSERT INTO `pamoka` (pavadinimas) VALUES 
							('$pavad')";
							$database->query($query);
							
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Neįvesta informacija
								</div>
								<?php
								}
						}
						
						if (isset ($_POST['trinti'])){
							$pam = $_POST['pam'];
							if($pam != 0){
							$query8="DELETE FROM `pamoka` WHERE id_Pamoka='$pam'";
							$database->query($query8);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta pamoka
								</div>
								<?php
								}
						}
                        ?>
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Kurti naują pamoką</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pamokos informacija</legend>
							<p><label class="field" for="pavadinimas">Pavadinimas </label><input type="text" id="pavadinimas" name="pavadinimas" class="textbox-100" value="<?php echo isset($fields['pavadinimas']) ? $fields['pavadinimas'] : ''; ?>" /></p>
						</fieldset>
						<p><input type="submit" class="submit" name="kurti" value="Sukurti"></p>
						</form>
						</table>
			
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Ištrinti pamoką</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite pamoką</legend>
							<br>
							<?php
							echo'Pamoka ';
							$query6 = "SELECT * from pamoka";
							echo'<select name="pam">';
							echo'<option value="0">Pasirinkite...</option>';
							$pam = $database->query($query6);
							while ( $row=mysqli_fetch_assoc($pam)) {
								echo "<option value='".$row['id_Pamoka']."'>".$row['pavadinimas']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							?>
							</fieldset>
						<p><input type="submit" class="submit" name="trinti" value="Ištrinti"></p>
						</form>
						</table>

    <?php
    echo "<tr><td>";
    include("../include/footer.php");
    echo "</td></tr>";
    ?>
    </table>       
    </body>
    </html>
    <?php
}
?>