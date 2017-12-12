<?php
include("include/session.php");
include("include/functions.php");

if ($session->logged_in) {
    $id = $_GET['id'];
    $homework = getHomeWork($id);
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
                            echo "<h1>".$homework['pamokosTema']."</h1>"
                        ?>
                    </div></br>
                    <div>
                        <h3>Klasės Darbas</h3>
                        <?php
                        echo "<p class=\"left\">".$homework['klasesDarbas']."</p>";
                        ?>
                    </div></br>
                    <div>
                        <h3>Namų darbas</h3>
                        <?php
                            echo "<p class=\"left\">".$homework['namuDarbai']."</p>";
                        ?>
                    </div>
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