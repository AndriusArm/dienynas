<?php
include("../include/session.php");

//Iš pradžių aprašomos funkcijos, po to jos naudojamos.

/**
 * displayUsers - Displays the users database table in
 * a nicely formatted html table.
 */
function displayUsers() {
    global $database;
    $q = "SELECT prisijungimoVardas, lygis, vardas, pavarde "
            . "FROM " . TBL_USERS . " ORDER BY lygis DESC,prisijungimoVardas";
    $result = $database->query($q);
    /* Error occurred, return given name by default */
    $num_rows = mysqli_num_rows($result);
    if (!$result || ($num_rows < 0)) {
        echo "Error displaying info";
        return;
    }
    if ($num_rows == 0) {
        echo "Lentelė tuščia.";
        return;
    }
    /* Display table contents */
    echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
    echo "<tr><td><b>Vartotojo vardas</b></td><td><b>Lygis</b></td><td><b>Vardas</b></td><td><b>Pavardė</b></td><td><b>Veiksmai</b></td></tr>\n";
    for ($i = 0; $i < $num_rows; $i++) {
        $uid =
        $uname = mysqli_result($result, $i, "prisijungimoVardas");
        $ulevel = mysqli_result($result, $i, "lygis");
        $ulevelname = '';
        switch ($ulevel)
        {
            case ADMIN_LEVEL:
                $ulevelname = ADMIN_NAME;
                break;
            case MANAGER_LEVEL:
                $ulevelname = MANAGER_NAME;
                break;
            case USER_LEVEL:
                $ulevelname = USER_NAME;
                break;
            default :
                $ulevelname = 'Neegzistuojantis tipas';
        }
        
        $vardas = mysqli_result($result, $i, "vardas");
        $pavarde = mysqli_result($result, $i, "pavarde");
        $ulevelchange = '<form action="adminprocess.php" method="POST">
                        
                                <input type="hidden" name="upduser" value="'.$uname.'">
                                <input type="hidden" name="subupdlevel" value="1">
                                <select name="updlevel" onChange="alert(\'Pakeistas vartotojo lygis!\');submit();">
                                    <option value="'.USER_LEVEL.'" '.($ulevel == USER_LEVEL? 'selected':'').'>'.USER_NAME.'</option>
                                    <option value="'.MANAGER_LEVEL.'" '.($ulevel == MANAGER_LEVEL? 'selected':'').'>'.MANAGER_NAME.'</option>
                                    <option value="'.ADMIN_LEVEL.'" '.($ulevel == ADMIN_LEVEL? 'selected':'').'>'.ADMIN_NAME.'</option>
                                </select>
                                

                    </form>';
        echo "<tr><td>$uname</td><td>$ulevelchange</td><td>$vardas</td><td>$pavarde</td><td><a href='AdminProcess.php?b=1&banuser=$uname' onclick='return confirm(\"Ar tikrai norite blokuoti?\");'>Blokuoti</a> | <a href='AdminProcess.php?d=1&deluser=$uname' onclick='return confirm(\"Ar tikrai norite trinti?\");'>Trinti</a></td></tr>\n";
    }
    echo "</table><br>\n";
}

function mysqli_result($res, $row, $field=0) { 
    $res->data_seek($row); 
    $datarow = $res->fetch_array(); 
    return $datarow[$field]; 
} 
/**
 * displayBannedUsers - Displays the banned users
 * database table in a nicely formatted html table.
 */
function displayBannedUsers() {
    global $database;
    $q = "SELECT prisijungimoVardas, busena "
            . "FROM " . TBL_USERS . " WHERE busena = 'blokuotas' ORDER BY prisijungimoVardas";
    $result = $database->query($q);
    /* Error occurred, return given name by default */
    $num_rows = mysqli_num_rows($result);
    if (!$result || ($num_rows < 0)) {
        echo "Error displaying info";
        return;
    }
    if ($num_rows == 0) {
        echo "Lentelė tuščia.";
        return;
    }
    /* Display table contents */
    echo "<table align=\"left\" border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
    echo "<tr><td><b>Vartotojo vardas</b></td><td><b>Būsena</b></td><td><b>Veiksmai</b></td></tr>\n";
    for ($i = 0; $i < $num_rows; $i++) {
        $uname = mysqli_result($result, $i, "prisijungimoVardas");
        $busena = mysqli_result($result, $i, "busena");
        echo "<tr><td>$uname</td><td>$busena</td><td><a href='AdminProcess.php?db=1&delbanuser=$uname' onclick='return confirm(\"Ar tikrai norite atblokuoti?\");'>Atblokuoti</a></td></tr>\n";
    }
    echo "</table><br>\n";
}

/*function ViewActiveUsers() {
    global $database;
    if (!defined('TBL_ACTIVE_USERS')) {
        die("");
    }
    $q = "SELECT username FROM " . TBL_ACTIVE_USERS
            . " ORDER BY timestamp DESC,username";
    $result = $database->query($q);

    $num_rows = mysqli_num_rows($result);
    if (!$result || ($num_rows < 0)) {
        echo "Error displaying info";
    } else if ($num_rows > 0) {
       
        echo "<br><table border=\"1\" cellspacing=\"0\" cellpadding=\"3\">\n";
        echo "<tr><td><b>Vartotojų vardai</b></td></tr>";
        echo "<tr><td><font size=\"2\">\n";
        for ($i = 0; $i < $num_rows; $i++) {
            $uname = mysqli_result($result, $i, "username");
            if ($i > 0)
                echo ", ";
            echo "<a href=\"../profilis.php?user=$uname\">$uname</a>";
        }
        echo ".";
        echo "</font></td></tr></table>";
    }
}*/

if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Administratoriaus sąsaja</title>
            <link href="../include/styles2.css" rel="stylesheet" type="text/css" />
        </head>  
        <body>
            <table class="center"><tr><td>
                        <img src="../pictures/top.jpg"/>
                    </td></tr><tr><td> 
                        <?php
                        $_SESSION['path'] = '../';
                        include("../include/meniu.php");
                        ?>
                        <br> 
                        <?php
                        if ($form->num_errors > 0) {
                            echo "<font size=\"4\" color=\"#ff0000\">"
                            . "!*** Error with request, please fix</font><br><br>";
                        }
						if (isset ($_POST['submit'])){
							$pavad = $_POST['pavadinimas'];
							$m = $_POST['mokyt'];
							if($pavad != '' & $m != 0){
	
							$query="INSERT INTO `pamoka` (pavadinimas, fk_Mokytojas) VALUES 
							('$pavad', '$m')";
							
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
						
							if (isset ($_POST['priskirti'])){
							$pam = $_POST['pam'];
							$mk = $_POST['mokin'];
							if($pam != 0 & $mk!= 0){
	
							$query8="INSERT INTO `mokinys_pamoka` (fk_Mokinys, fk_Pamoka) VALUES 
							('$mk', '$pam')";
							
							$database->query($query8);
						} 	else {
							?>
								<div class="alert">
								<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
								Nepasirinkta pamoka arba mokinys
								</div>
								<?php
								}
						}
                        ?>
						
                        <table style=" text-align:left;" border="0" cellspacing="5" cellpadding="5">
						
						<tr><td> 
                        <h3>Priskirti mokinį pamokai</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pasirinkite mokinį ir pamoką</legend>
							<?php
							echo'Mokinys ';
							$query6 = "SELECT * from users WHERE userlevel=1";
							echo'<select name="mokin">';
							echo'<option value="0">Pasirinkite...</option>';
							$mok = $database->query($query6);
							while ( $row=mysqli_fetch_assoc($mok)) {
								echo "<option value='".$row['id_Vartotojas']."'>".$row['username']."</option>";
								}
							echo"</select>";
							echo"<br><br>";
							echo'Pamoka ';
							$query7 = "SELECT * from pamoka";
							echo'<select name="pam">';
							echo'<option value="0">Pasirinkite...</option>';
							$pamok = $database->query($query7);
							while ( $row=mysqli_fetch_assoc($pamok)) {
								echo "<option value='".$row['id_Pamoka']."'>".$row['pavadinimas']."</option>";
								}
							echo"</select>";
							?>
						</fieldset>
						<p><input type="submit" class="submit" name="priskirti" value="Priskirti"></p>
						</form>
                <tr><td><hr></td></tr>
            </td></tr>
						
						
						<tr><td> 
                        <h3>Kurti naują pamoką:</h3>
                        <form action="" method="post">
						<fieldset>
							<legend>Pamokos informacija</legend>
							<p><label class="field" for="pavadinimas">Pavadinimas </label><input type="text" id="pavadinimas" name="pavadinimas" class="textbox-100" value="<?php echo isset($fields['pavadinimas']) ? $fields['pavadinimas'] : ''; ?>" /></p>
							<?php
							echo'Mokytojas ';
							$query5 = "SELECT * from users WHERE userlevel=5";
							echo'<select name="mokyt">';
							echo'<option value="0">Pasirinkite...</option>';
							$mok = $database->query($query5);
							while ( $row=mysqli_fetch_assoc($mok)) {
								echo "<option value='".$row['id_Vartotojas']."'>".$row['username']."</option>";
								}
							echo"</select>";
							?>
						</fieldset>
						<p><input type="submit" class="submit" name="submit" value="Sukurti"></p>
						</form>
                <tr><td><hr></td></tr>
            </td></tr>
			
                            <tr><td>
                                    <?php
                                    /**
                                     * Display Users Table
                                     */
                                    ?>
                                    <h3>Sistemos vartotojai:</h3>
                                    <?php
                                    displayUsers();
                                    ?>
                                    <br>
                                </td>
                            </tr>
                            <tr><td><hr></td></tr>           
        <tr><td>
                <?php
                /**
                 * Display Banned Users Table
                 */
                ?>
                <h3>Blokuoti vartotojai:</h3>
                <?php
                displayBannedUsers();
                ?>

            </td></tr>
                            <tr><td><hr></td></tr>
                    </td></tr>
                        
                <tr><td> 
            </td></tr>

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