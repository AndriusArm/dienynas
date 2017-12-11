<?php
include("include/session.php");
include("getdata.php");

if ($session->logged_in) {
    ?>
    <html>
        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8"/> 
            <title>Žinutės</title>
            <link href="include/styles2.css" rel="stylesheet" type="text/css" />
            <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <style> 

input[type=text] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
}
textarea {
    width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;
}
select {
    width: 100%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
}
input[type=button], input[type=submit], input[type=reset] {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 16px 32px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
    width: 100%;
}
.beta table {
    border-collapse: collapse;
    width: 100%;
}

.beta th, td {
    text-align: center;
    padding: 8px;
}

.beta tr {background-color: #f2f2f2}

.beta th {
    background-color: #4CAF50;
    color: white;
}

button {
	background-color: #e7e7e7; 
	color: black;
    border: none;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}

</style>
        </head>
        <body>     
         <table class="center"><tr><td>
            <center><img src="pictures/top.jpg"/></center>
        </td></tr><tr><td>  
        <?php

                include("include/meniu.php");?>
                <h2>Žinutė</h2>
               <div class="col-md-12 well" style="text-align:left">
               	
  			<fieldset><?php
                if(isset($_GET['id'])){
                	$id=$_GET['id'];
               		 $query="SELECT tema, tekstas, data, vardas, pavarde FROM zinute, vartotojas WHERE vartotojas.Id_Vartotojas=zinute.fk_Siuntejas and id_Zinute=$id";
                	$result=$database->query($query);
                	$row= mysqli_fetch_assoc($result);
                
                	echo "<h3>Tema: <small>" .$row['tema']. "</small></h3>";
                	echo "<h3>Data: <small>" .$row['data']. "</small></h3>";
                	echo "<h3>Siuntėjas: <small>" .$row['vardas']. " " .$row['pavarde']. "</small></h3>";
                	echo "<h3>Tekstas: <small>" .$row['tekstas']. "</h3>";
					}
					if(isset($_GET['sid'])){
						$id=$_GET['sid'];
               		 	$query="SELECT tema, tekstas, data, vardas, pavarde FROM zinute, vartotojas WHERE vartotojas.Id_Vartotojas=zinute.fk_Gavejas and id_Zinute=$id";
                		$result=$database->query($query);
                		$row= mysqli_fetch_assoc($result);
                
                		echo "<h3>Tema: <small>" .$row['tema']. "</small></h3>";
                		echo "<h3>Data: <small>" .$row['data']. "</small></h3>";
                		echo "<h3>Gavėjas: <small>" .$row['vardas']. " " .$row['pavarde']. "</small></h3>";
                		echo "<h3>Tekstas: <small>" .$row['tekstas']. "</h3>";
					}
					?>
                 </fieldset></div>
                 <div style="text-align:left">
                 <button onclick="history.go(-1);">Grįžti </button>
             </div>
                 <?php
                        include("include/footer.php");
                        ?>	
                      </td></tr></table>
                               </body>

    </html>      
  <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>