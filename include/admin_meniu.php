<?php
//Formuojamas admin meniu.
if (isset($session) && $session->logged_in) {
    $path = "";
    if (isset($_SESSION['path'])) {
        $path = $_SESSION['path'];
        unset($_SESSION['path']);
    }
    ?>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #222222;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 5px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50}

</style>
        <body>     

  <legend></legend>
  <h1 style = "text-align: center;color:white;">Administratoriaus sąsaja</h1>
<ul>
  <li><a class = "active" href="vartotojai.php">Vartotojų peržiūra</a></li>
  <li><a href="tvarkarastis.php">Tvarkaraščio redagavimas</a></li>
  <li><a href="pamokos.php">Pamokų redagavimas</a></li>
</ul>


</body>

</html>

    <?php
}//Meniu baigtas
?>

