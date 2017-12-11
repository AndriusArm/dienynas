<?php
//Formuojamas meniu.
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>
    <table width=100% border="0" cellspacing="1" cellpadding="5" class="meniu">
        <?php
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>$session->username</b> <br>";
        echo "</td></tr><tr><td>";
        echo "[<a href=\"" . $path . "index.php\">Pagrindinis</a>] &nbsp;&nbsp;"
		. "[<a href=\"" . $path . "naujienos.php\">Naujienos</a>] &nbsp;&nbsp;"
        . "[<a href=\"" . $path . "paskyra.php\">Paskyra</a>] &nbsp;&nbsp;";
		//Mokinio dienynas ir tvarkaraštis rodomas tik mokiniui
		if ($session->isMokinys()) {
			echo "[<a href=\"" . $path . "mano_dienynas.php\">Mano dienynas</a>] &nbsp;&nbsp;";
			echo "[<a href=\"" . $path . "mokinio_tvarkarastis.php\">Mano tvarkaraštis</a>] &nbsp;&nbsp;";
		}
		//Mokytojo sąsaja ir tvarkaraštis rodoma tik mokytojui
		if ($session->isMokytojas()) {
			echo "[<a href=\"" . $path . "mano_mokiniai.php\">Mano dienynas</a>] &nbsp;&nbsp;";
			echo "[<a href=\"" . $path . "mokytojo_tvarkarastis.php\">Mano tvarkaraštis</a>] &nbsp;&nbsp;";
		}
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($session->isAdministratorius()) {
            echo "[<a href=\"" . $path . "admin/vartotojai.php\">Administratoriaus sąsaja</a>] &nbsp;&nbsp;";
            echo "[<a href=\"" . $path . "admin/students.php\">Mokiniai</a>] &nbsp;&nbsp;";
        }
        echo "[<a href=\"" . $path . "process.php\">Atsijungti</a>]";
        echo "</td></tr>";
        ?>
    </table>
    <?php
}//Meniu baigtas
?>

