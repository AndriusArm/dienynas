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
						
						if (isset ($_POST['redaguoti'])){
							$pavad = $_POST['pavadinimas'];
							$pam = $_POST['pam'];
							if($pavad != '' & $pam != 0){
							$query="UPDATE pamoka SET pavadinimas = '$pavad' WHERE id_Pamoka = '$pam'";
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
						
							if (isset ($_POST['keisti'])){
							$klase = $_POST['klase'];
							$kabinetas = $_POST['kabinetas'];
							$laikas = $_POST['laikas'];
							$diena = $_POST['diena'];
							var_dump($klase);
							var_dump($kabinetas);
							var_dump($laikas);
							var_dump($diena);
							if($klase != 0 & $kabinetas != "0" & $laikas != "0" & $diena != "0"){
							$query="INSERT INTO `pamokoslaikas` (laikas, kabinetas, savaitesDiena, fk_KlasesPamoka) VALUES 
							('$laikas', '$kabinetas', '$diena', '$klase')";
							$database->query($query);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta pamoka, laikas, kabinetas arba savaitės diena
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
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Redaguoti pamoką</h3>
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
							echo"<br>";
							?>
							<p><label class="field" for="pavadinimas">Naujas pavadinimas </label><input type="text" id="pavadinimas" name="pavadinimas" class="textbox-100" value="<?php echo isset($fields['pavadinimas']) ? $fields['pavadinimas'] : ''; ?>" /></p>
						</fieldset>
						<p><input type="submit" class="submit" name="redaguoti" value="Redaguoti"></p>
						</form>
						</table>
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Redaguoti klasės pamokos informaciją</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite klasės pamoką, kabinetą, laiką, savaitės dieną</legend>
							<br>
							<?php
							echo'Pamoka ';
							$query1 = "SELECT * FROM `klase`, `klasespamoka`, `pamoka`, `vartotojas` 
							WHERE `klasespamoka`.fk_Klase = `klase`.id_Klase 
							&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka 
							&& `vartotojas`.`id_Vartotojas` = `klasespamoka`.`fk_Mokytojas`";
							echo'<select name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klase = $database->query($query1);
							while ( $row=mysqli_fetch_assoc($klase)) {
								echo "<option value='".$row['id_Klasespamoka']."'>".$row['klase'].", ".$row['pavadinimas'].", ".$row['vardas']." ".$row['pavarde']."</option>";
								}
							echo"</select>";
							echo"<br>";
							?>
							<p><label class="field" for="kabinetas">Kabinetas </label><input type="text" id="kabinetas" name="kabinetas" class="textbox-100" value="<?php echo isset($fields['kabinetas']) ? $fields['kabinetas'] : ''; ?>" /></p>
							<?php
							echo'Laikas ';
							?>
							<select name="laikas">';
							<option value="0">Pasirinkite...</option>';
							<option value="08:00:00">08:00</option>
							<option value="09:00:00">09:00</option>
							<option value="10:00:00">10:00</option>
							<option value="11:00:00">11:00</option>
							<option value="12:00:00">12:00</option>
							<option value="13:00:00">13:00</option>
							<option value="14:00:00">14:00</option>
							<option value="15:00:00">15:00</option>
							<option value="16:00:00">16:00</option>
							</select>
							<br><br>
							<?php
							echo'Savaitės diena ';
							?>
							<select name="diena">';
							<option value="0">Pasirinkite...</option>';
							<option value="Pirmadienis">Pirmadienis</option>
							<option value="Antradienis">Antradienis</option>
							<option value="Trečiadienis">Trečiadienis</option>
							<option value="Ketvirtadienis">Ketvirtadienis</option>
							<option value="Penktadienis">Penktadienis</option>
							</select>
							<br><br>
						</fieldset>
						<p><input type="submit" class="submit" name="Keisti" value="Redaguoti"></p>
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