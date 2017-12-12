<?php
//Formuojamas meniu.
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>

    <style>

</style>

<meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Administratoriaus sàsaja</title>
<link href="../include/styles2.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <table width=110% border="0" cellspacing="0" cellpadding="0" >       
        <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
        <?php
        echo "<li><a href=\"" . $path . "index.php\">Pagrindinis</a></li> &nbsp;&nbsp;"
        . "<li><a href=\"" . $path . "naujienos.php\">Naujienos</a></li> &nbsp;&nbsp;"
        . "<li><a href=\"" . $path . "paskyra.php\">Paskyra</a></li> &nbsp;&nbsp;"
        . "<li><a href=\"" . $path . "zinutes.php\">Žinutės</a></li> &nbsp;&nbsp;";    
        
        //Mokinio dienynas ir tvarkaraðtis rodomas tik mokiniui
        if ($session->isMokinys()) {
        
            echo "<li><a href=\"" . $path . "mano_dienynas.php\">Mano dienynas</a></li> &nbsp;&nbsp;";
            echo "<li><a href=\"" . $path . "mokinio_tvarkarastis.php\">Mano tvarkaraštis</a></li> &nbsp;&nbsp;";
        
        }
        //Mokytojo sàsaja ir tvarkaraðtis rodoma tik mokytojui
        if ($session->isMokytojas()) {
    
            echo "<a href=\"" . $path . "mano_mokiniai.php\">Mano mokiniai</a> &nbsp;&nbsp;";
            echo "<a href=\"" . $path . "mokytojo_tvarkarastis.php\">Mano tvarkaraštis</a> &nbsp;&nbsp;";
        
        }
        //Administratoriaus sàsaja rodoma tik administratoriui
        if ($session->isAdministratorius()) {
        
            echo "<li><a href=\"" . $path . "admin/vartotojai.php\">Administratoriaus sąsaja</a></li> &nbsp;&nbsp;";
            echo "<li><a href=\"" . $path . "admin/students.php\">Mokiniai</a></li>;";
        }
        ?>
        <ul class="nav navbar-nav navbar-right">
        <li><a href="process.php"><span class="glyphicon glyphicon-user"></span> Atsijungti</a></li>
        </ul>

        <ul></ul>
        <ul></ul>
        </ul>
        </nav>

        </td></tr>

    </table>
    <?php
}//Meniu baigtas
?>

