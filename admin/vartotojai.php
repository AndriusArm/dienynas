<?php
include("../include/session.php");

if (!$session->isAdministratorius()) {
    header("Location: ../index.php");
} else { //Jei administratorius
    ?>
    <html>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Vartotojų valdymas</title>
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
    echo "<table align=\"left\" border=\"1\" cellspacing=\"3\" cellpadding=\"4\">\n";
    echo "<tr><td><b>Vartotojo vardas</b></td><td><b>Lygis</b></td><td><b>Vardas</b></td><td><b>Pavardė</b></td><td><b>Veiksmai</b></td></tr>\n";
    for ($i = 0; $i < $num_rows; $i++) {
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
    $q = "SELECT prisijungimoVardas, lygis, vardas, pavarde, busena "
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
    echo "<table align=\"left\" border=\"1\" cellspacing=\"3\" cellpadding=\"4\">\n";
    echo "<tr><td><b>Vartotojo vardas</b></td><td><b>Būsena</b></td><td><b>Vardas</b></td><td><b>Pavardė</b></td><td><b>Veiksmai</b></td></tr>\n";
    for ($i = 0; $i < $num_rows; $i++) {
        $uname = mysqli_result($result, $i, "prisijungimoVardas");
        $busena = mysqli_result($result, $i, "busena");
        $ulevel = mysqli_result($result, $i, "lygis");
		$vardas = mysqli_result($result, $i, "vardas");
        $pavarde = mysqli_result($result, $i, "pavarde");
        $ulevelname = '';
        echo "<tr><td>$uname</td><td>$busena</td><td>$vardas</td><td>$pavarde</td><td><a href='AdminProcess.php?db=1&delbanuser=$uname' onclick='return confirm(\"Ar tikrai norite atblokuoti?\");'>Atblokuoti</a> | <a href='AdminProcess.php?d=1&deluser=$uname' onclick='return confirm(\"Ar tikrai norite trinti?\");'>Trinti</a></td></tr>\n";
    }
    echo "</table><br>\n";
}
?>

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
                            <tr><td><br></td></tr>           
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