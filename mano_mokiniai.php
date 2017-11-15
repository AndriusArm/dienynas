<?php
include("include/session.php");
if ($session->logged_in) {
    ?>
    <html>
	<style>
	table {
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
	</style>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Mano mokiniai</title>
            <link href="include/styles2.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center"><tr><td>
                        <img src="pictures/top.jpg"/>
                    </td></tr><tr><td> 
                        <?php
                        include("include/meniu.php");
						if (isset ($_POST['pazymys'])){
							$pid = $_POST['id'];
							$paz = $_POST['paz'];
							$koment = $_POST['komentaras'];
							$pamok = $_POST['pamok'];
							$data = date("Y-m-d");
							if($koment != '' & $paz != 0){
	
							$query4="INSERT INTO `irasas` (data, pazymys, fk_Pamoka, fk_Mokinys, komentaras) VALUES 
							('$data', '$paz', '$pamok', '$pid', '$koment')";
							//var_dump($query4);exit;
						$database->query($query4);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Neįvesta informacija
								</div>
								<?php
								}
						}
                        ?>                           
                        <br> 
                        <div style="text-align: center;color:green">                   
                            <h1>Mano mokiniai</h1>
                            <form action="" method="post">
						<fieldset>
							<legend>Mokinių sąrašas</legend>
							<?php
							echo'Pasirinkite pamoką ';
							$k = $session->userinfo["id_Vartotojas"];
							$query = "SELECT * from pamoka WHERE fk_Mokytojas=$k";

							echo'<select name="pam">';
							echo'<option value="0">Pasirinkite...</option>';
							$mok = $database->query($query);
							while ( $row=mysqli_fetch_assoc($mok)) {
								echo "<option value='".$row['id_Pamoka']."'>".$row['pavadinimas']."</option>";
								}
							echo"</select>";
							if (isset ($_POST['submit'])){
							$pam = $_POST['pam'];
							if($pam != 0){
	
							$query2="SELECT * FROM `users`, `mokinys_pamoka` WHERE `mokinys_pamoka`.fk_Pamoka=$pam && `users`.id_Vartotojas=`mokinys_pamoka`.fk_Mokinys";
							
							$result = $database->query($query2);
							$query3="SELECT pavadinimas FROM `pamoka` WHERE id_Pamoka=$pam";
							$p = $database->query($query3);
							$row=mysqli_fetch_assoc($p);
							
							echo "<h2>Pamoka: " .$row['pavadinimas']. "</h2>";
							echo '<table>';
							echo'<th>'.'Nr.'."</th>";
							echo'<th>'.'Mokinys'."</th>";
							$i=1;
							echo'<td></td>';
							echo'<td></td>';
							echo'<td></td>';
							while ($row = mysqli_fetch_array($result))
						{
							echo'<tbody>';
							?>
							<form action="" method="post">
							<?php
							$pamok=$pam;
							echo'<input type=\'hidden\' name=\'pamok\' value=\''.$pamok.'\' />';
							echo'<td>'. $i."</td>";
							echo'<th>'. $row['username']."</th>";
							echo'<input type=\'hidden\' name=\'id\' value=\''.$row['id_Vartotojas'].'\' />';
							echo'<td>'. '
							<select name="paz">
							<option value="0">Pasirinkite pažymį</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
							<option value="7">7</option>
							<option value="8">8</option>
							<option value="9">9</option>
							<option value="10">10</option>
							</select>
							' . "</td>";
							?>
							<td><p><label class="field" for="komentaras"></label><input type="text" id="komentaras" name="komentaras" class="textbox-100" value="<?php echo isset($fields['komentaras']) ? $fields['komentaras'] : ''; ?>" /></p></td>
							<?php							
							echo"<td><input name='pazymys' type='submit' value='Pridėti įrašą'</td>";
							?>
							</form>
							<?php
							$i=$i+1;
							echo'</tbody>';
						}
						echo '</table>'; 
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
						</fieldset>
						<p><input type="submit" class="submit" name="submit" value="Rodyti sąrašą"></p>
						</form>               
                        </div> 
                        <br>                
                <tr><td>
                        <?php
                        include("include/footer.php");
                        ?>
                    </td></tr>      
            </table>
        </body>
    </html>
    <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>