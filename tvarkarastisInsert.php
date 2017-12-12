<?php
include("include/session.php");
include("include/functions.php");
$pamokosTema = "";
$klasesDarbas = "";
$namuDarbas = "";

if ($session->logged_in ) {
    if(isset($_GET['id'])){
        if(preg_match('/[0-9]/', $_GET['id'])){
            $id = $_GET['id']; 
        }  
    }  
    if(isset($_GET['date'])){
        if(preg_match('/\d{4}-\d{2}-\d{2}/', $_GET['date']) == 1){
            $data = $_GET['date'];
        }    
    }

    if(empty($id) || empty($data))
        header("Location: index.php");
    
    $homework = getHomeWorkByDateFK($data, $id);

    if(isset($_POST['submit'])){
        if(isset($_POST['namuDarbas'])) {
            $namuDarbas = mysqli_real_escape_string($database->connection, $_POST['namuDarbas']);
        }
        if (isset($_POST['klasesDarbas'])){
            $klasesDarbas = mysqli_real_escape_string($database->connection, $_POST['klasesDarbas']);
        } 
        if (isset($_POST['pamokosTema'])){
            $pamokosTema = mysqli_real_escape_string($database->connection, $_POST['pamokosTema']);
        } 
        if($homework){
            $EntryID = $homework['id_Irasas'];
            $query = "UPDATE `irasas` "
                    . "SET `pamokosTema`='$pamokosTema',"
                    . "`klasesDarbas`='$klasesDarbas',"
                    . "`namuDarbai`='$namuDarbas' "
                    . "WHERE `id_Irasas`='$EntryID'";
        }else{
            $query = "INSERT INTO `irasas`(`data`, `pamokosTema`, `klasesDarbas`, `namuDarbai`, `fk_KlasesPamoka`) "
                . "VALUES ('$data','$pamokosTema','$klasesDarbas','$namuDarbas','$id')";
        } 

        $database->query($query);
    }
   
    ?>
	<style>
table {
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}
h3{
   text-align: left;
   color:black;
}
.left{
    text-align: left;
}
	</style>
        <head>  
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Mano dienynas</title>
            <link href="include/styles2.css" rel="stylesheet" type="text/css" />
        </head>
        <body>
            <table class="center">
                <tr><td>
                    <img src="pictures/top.jpg"/>
                </td></tr>
                <tr><td> 
                    <?php
                    include("include/meniu.php");
                    ?>                           
                    <br> 
                    <div style="text-align: center;color:green">                   
                        <?php
                            echo "<h1>".$homework['pamokosTema']."</h1>";
                        ?>
                    </div></br>
                    <form action="" method="POST">
                        <div>
                        <h3>Pamokos tema</h3>
                            <div class="left">
                                <textarea align="left" rows="4" cols="80" name="pamokosTema"><?php echo isset($homework['pamokosTema']) ? $homework['pamokosTema'] : $pamokosTema; ?></textarea>
                            </div>
                    </div></br>
                    <div>
                        <h3>Klasės darbas</h3>
                            <div class="left">
                                <textarea align="left" rows="4" cols="80" name="klasesDarbas"><?php echo isset($homework['klasesDarbas']) ? $homework['klasesDarbas'] : $klasesDarbas; ?></textarea>
                            </div>
                    </div></br>
                    <div>
                        <h3>Namų darbai</h3>
                            <div class="left">
                                <textarea class="left" rows="4" cols="80" name="namuDarbas"><?php echo isset($homework['namuDarbai']) ? $homework['namuDarbai'] : $namuDarbas; ?></textarea>
                            </div>
                    </div>
                    <input type="submit" value="Išsaugoti" name="submit"> 
                    </form>
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