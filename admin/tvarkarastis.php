<?php
include("../include/session.php");

if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Tvarkaraščio redagavimas</title>
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

						if (isset ($_POST['priskirti'])){
							$klase = $_POST['klase'];
							$pam = $_POST['pam'];
							$vart = $_POST['vart'];
							if($pam != 0 & $klase!= 0 & $vart!= 0){
							$query="INSERT INTO `klasespamoka` (fk_Klase, fk_Pamoka, fk_Mokytojas) VALUES 
							('$klase', '$pam', '$vart')";
							$database->query($query);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta pamoka arba mokinys
								</div>
								<?php
								}
						}
						
						if (isset ($_POST['paskirti'])){
							$klase = $_POST['klase'];
							$kabinetas = $_POST['kabinetas'];
							$laikas = $_POST['laikas'];
							$diena = $_POST['diena'];
							var_dump($klase);
							var_dump($kabinetas);
							var_dump($laikas);
							var_dump($diena);
							if($klase != 0 & $kabinetas != 0 & $laikas != 0 & $diena != 0){
							$query="INSERT INTO `pamokoslaikas` (laikas, kabinetas, savaitesDiena, fk_Klasespamoka) VALUES 
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
                        <h3>Priskirti klasei pamoką</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite klasę, pamoką ir mokytoją</legend>
							<?php
							echo'Klasė ';
							$query1 = "SELECT * from klase";
							echo'<select name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klase = $database->query($query1);
							while ( $row=mysqli_fetch_assoc($klase)) {
								echo "<option value='".$row['id_Klase']."'>".$row['klase']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							echo'Pamoka ';
							$query2 = "SELECT * from pamoka";
							echo'<select name="pam">';
							echo'<option value="0">Pasirinkite...</option>';
							$pam = $database->query($query2);
							while ( $row=mysqli_fetch_assoc($pam)) {
								echo "<option value='".$row['id_Pamoka']."'>".$row['pavadinimas']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							echo'Mokytojas ';
							$query3 = "SELECT * from vartotojas WHERE lygis=5";
							echo'<select name="vart">';
							echo'<option value="0">Pasirinkite...</option>';
							$vart= $database->query($query3);
							while ( $row=mysqli_fetch_assoc($vart)) {
								echo "<option value='".$row['id_Vartotojas']."'>".$row['vardas']." ".$row['pavarde']."</option>";
								}
							echo"</select>";
							?>
						</fieldset>
						<p><input type="submit" class="submit" name="priskirti" value="Priskirti"></p>
						</form>
						</table>
						
						<table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
                        <h3>Paskirti pamokai laiką</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite klasės pamoką, kabinetą, laiką, savaitės dieną</legend>
							<?php
							echo'Pamoka ';
							//$query1 = "SELECT * from klasespamoka, pamoka, klase ";
							$query1 = "SELECT * FROM `klase`, `klasespamoka`, `pamoka`, `vartotojas` 
							WHERE `klasespamoka`.fk_Klase = `klase`.id_Klase 
							&& klasespamoka.fk_Pamoka = pamoka.id_Pamoka 
							&& `vartotojas`.`id_Vartotojas` = `klasespamoka`.`fk_Mokytojas`";
							echo'<select name="klase">';
							echo'<option value="0">Pasirinkite...</option>';
							$klase = $database->query($query1);
							while ( $row=mysqli_fetch_assoc($klase)) {
								echo "<option value='".$row['id_Klasespamoka']."'>".$row['klase']." ".$row['pavadinimas']." ".$row['vardas']." ".$row['pavarde']."</option>";
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
						<p><input type="submit" class="submit" name="paskirti" value="Paskirti"></p>
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