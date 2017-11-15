<?php
include("include/session.php");
if ($session->logged_in && ($session->isModeratorius() || $session->isMokytojas())) {
?>
<html>
<style>
input[type=text], select {
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea{
    width: 50%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 10%;
    background-color: black;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}


</style>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/>
        <title>Skelbti naujieną</title>
        <link href="include/styles2.css" rel="stylesheet" type="text/css" />
    </head>
    <body>             
        <table class="center" ><tr><td>
            <center><img src="pictures/top.jpg"/></center>
        </td></tr><tr><td>  
            <?php
			global $database;
			//var_dump($_POST);
            //Jei vartotojas prisijungęs
            if ($session->logged_in) {
                include("include/meniu.php");
                ?>
				<?php
				global $database;
				if(isset($_POST['ok']))
				{
					$pavad = $_POST['pavadinimas'];
					$tekst = $_POST['tekstas'];
					$vartot = $session->userinfo["username"];
					$data = date("Y-m-d h:i:sa");
					$query2 = "INSERT INTO `naujiena` (pavadinimas, tekstas, vartotojas, data) VALUES ('$pavad', '$tekst', '$vartot', '$data')";
					$result = $database->query($query2);
					header('Location: naujienos.php');
				}
				?>
                <div style="text-align: left;color:black">
                    <br><br>
                    <h1>Skelbti naujieną</h1>
                </div><br>
				<meta charset="UTF-8">
				<div class="container">
				<form action="" method='post'>
				<div class="form-group col-lg-10">
				<label for="pavadinimas" class="control-label"><b>Pavadinimas:</b></label><br>
				<input name='pavadinimas' id='pavadinimas' type='text' class="form-control input-sm" required="true">
				</div>
				<div class="form-group col-lg-10">
				<label for="tekstas" class="control-label"><b>Tekstas:</b></label><br>
				<textarea name='tekstas' class="form-control input-sm" required="true"></textarea>
				</div>
				<div class="form-group col-lg-12">
				<input type='submit' name='ok' value='Siųsti' onclick="window.location.href=naujienos.php" class="btn btn-default">
				</div>
				</form>
				</div>
                <?php
                //Jei vartotojas neprisijungęs, rodoma prisijungimo forma
                //Jei atsiranda klaidų, rodomi pranešimai.
            } else {
                echo "<div align=\"center\">";
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
<?php
} else {
    header("Location: index.php");
}
?>