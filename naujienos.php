<?php
include("include/session.php");
?>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Naujienos</title>
        <link href="include/styles2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>             
        <table class="center" ><tr><td>
            <center><img src="pictures/top.jpg"/></center>
        </td></tr><tr><td>  
            <?php
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/meniu.php");
                ?>
                <div style="text-align: center;color:white">
                    <h1>NAUJIENOS</h1>
                </div><br>
				<?php
				$query = "SELECT * FROM naujiena";
				$result = $database->query($query);
				while ($row = mysqli_fetch_array($result))
				{
				echo'<hr>';
				echo'<blockquote>';
                echo'<h2>'. $row['pavadinimas']."</h2>";
				echo $row['tekstas'];
				echo'<h4>'. $row['vartotojas']."</h4>";
                echo'<h4>'. $row['data'].'</h4>';
				echo'</blockquote>';
				}
				?>
				<?php
				if ($session->logged_in && ($session->isAdministratorius() || $session->isMokytojas()))
				{
				?>
				<div align="left">
                <a href="rasyti_naujiena.php">
				<button>Rašyti pranešimą</button>
				</a>
				</div>
				<?php
				}
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai. <a href="index.php">Rašyti pranešimą</a>
            } else {
                echo "<div align=\"center\">";
                if ($form->num_errors > 0) {
                    echo "<font size=\"3\" color=\"#ff0000\">Klaidų: " . $form->num_errors . "</font>";
                }
                echo "<table class=\"center\"><tr><td>";
                include("include/loginForm.php");
                echo "</td></tr></table></div><br></td></tr>";
            }
            echo "<tr><td>";
            include("include/footer.php");
            echo "</td></tr>";
            ?>
        </td></tr>
</table>
</body>
</html>