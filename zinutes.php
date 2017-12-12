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


</style>
<script>

	function openMessages(evt, messName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(messName).style.display = "block";
    evt.currentTarget.className += " active";
}

function getId(val) {
  $.ajax({
    type: "POST",
    url: "getdata.php",
    data: "id="+val,
    success: function(data){
      $("#recipient").html(data);
    }
  })
}
</script>
        </head>
        <body>     
         <table class="center"><tr><td>
            <center><img src="pictures/top.jpg"/></center>
        </td></tr><tr><td>  
        <?php

                include("include/meniu.php");
                if (isset ($_POST['submit'])){   
                			$userID = $session->userinfo["id_Vartotojas"];                         
                            $title = $_POST['title'];
                            if(isset($_POST['recipient'])) {
                            $recipient = $_POST['recipient'];
                          } else {
                            $recipient = '';
                          }
                            $body = $_POST['body'];
                            $date = date("Y-m-d");
                            if($body != '' && $title != '' && $recipient != ''){

                            $query4="INSERT INTO zinute(tema, tekstas, data, fk_Siuntejas, fk_Gavejas) VALUES 
                            ('$title', '$body', '$date', '$userID', '$recipient')";
                            //var_dump($query4);exit;
                            $result=$database->query($query4);
                            if($result){
                                ?>
                                 <div class="alert success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                Žinutė išsiųsta.
                                </div><?php
                              }
                            }else{
                            	
                                if ($title == ''){
                            		?>
                            		  <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                Nenurodėte žinutės temos!
                                </div>
                                <?php
                              }
                                if ($recipient == ''){
                            		?>
                            		  <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                Nenurodėte gavėjo!
                                </div>
                                <?php
                            }    
                            if ($body == ''){
                                ?>
                                  <div class="alert">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                Nenurodėte žinutės teksto!
                                </div>
                                <?php
                                }
                   }
               }
                
               if(isset($_GET['recid'])) {
                ?>
                <script>
                document.getElementById("new").click();
                </script>
                <?php
                $query5="DELETE FROM zinute WHERE id_Zinute = '".$_GET['recid']."'";
                
                $success=$database->query($query5);
                if ($success){
                  ?>
                  <div class="alert success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                Žinutė pašalinta.
                                </div>
                                <?php
                }
                
                }
                if(isset($_GET['sentid'])) {
                ?>
                <script>
                document.getElementById("sent").click();
                </script>
                <?php
                $query5="DELETE FROM zinute WHERE id_Zinute = '".$_GET['sentid']."'";
                
                $success=$database->query($query5);
                if ($success){
                  ?>
                  <div class="alert success">
                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                Žinutė pašalinta.
                                </div>
                                <?php
                }
                
                }
                ?>
               
  <legend></legend>
 
  <h1 style = "color:white;">Žinučių valdymas</h1>
            <div class="tab">
			 <button class="tablinks" onclick="openMessages(event, 'newMessage')" id="new">Nauja žinutė</button>
			 <button class="tablinks" onclick="openMessages(event, 'receivedMessages')"
        id="received">Gautos žinutės</button>
			 <button class="tablinks" onclick="openMessages(event, 'sentMessages')" id="sent" >Išsiųstos žinutės</button>
			</div>
      
			<div id="newMessage" class="tabcontent">   
            <div id="content" style="text-align:left">
            	<form action="" method="POST">
            		<fieldset>
            			<label class="field" for="title">Tema</label>
            			<input name="title" type="text" placeholder="Nurodykite žinutės temą">
            			<br>
            			<label class="field" for="recipientgroup">Gavėjų grupė</label>
            			<select id="recipientgroup" name="recipientgroup" onchange="getId(this.value);">
            				<option value="">Pasirinkite gavėjų grupę</option>
            				<option value="9">Administratorius</option>
            				<option value="5">Mokytojai</option>
            				<option value="1">Mokiniai</option>
            			</select>
            			<br>
            			<label class="field" for="rec">Gavėjas</label>
            			<select id="recipient" name="recipient">
						      </select> 
						<div></div>
						<label class="field" for="body">Žinutės tekstas</label>
						<textarea id="body" name="body" rows="20" cols="50"></textarea>
						<div></div>
						<input type="submit" value="Siųsti žinutę" name="submit"</input>
       					 </fieldset>
       					</form>
       				</div>
       			 </div>
            <script>
                document.getElementById("new").click();
                </script>

       			 <div id="receivedMessages" class="tabcontent">  
       			 	<table class="beta">
       			 		<tr>
       			 			<th>Tema</th>
       			 			<th>Tekstas</th>
       			 			<th>Data</th>
       			 			<th>Siuntėjas</th>
       			 		</tr>
       			 		<?php
       			 		$userID = $session->userinfo["id_Vartotojas"];
       			 		$query2="SELECT zinute.id_Zinute, zinute.tekstas, zinute.tema, zinute.data, vartotojas.vardas, vartotojas.pavarde FROM zinute, vartotojas WHERE zinute.fk_Siuntejas=vartotojas.id_Vartotojas AND zinute.fk_Gavejas=$userID";
				        $result2=$database->query($query2);
						while ($row2 = mysqli_fetch_array($result2)) {
							echo "<tr>";
							echo "<td>" . $row2['tema'] . "</td>";
              echo "<td style='width: 100px'>" . $row2['tekstas'] . "</td>";
							echo "<td>" . $row2['data'] . "</td>";
							echo "<td>" . $row2['vardas'] . " " .$row2['pavarde']. "</td>";
              echo "<td><a href='zinutes.php?recid=".$row2['id_Zinute']."'>Šalinti</a></td>";
              echo "<td><a href='./zinutesPerziura.php?id=".$row2['id_Zinute']."'>Peržiūrėti</a></td>";
							echo "</tr>";
							
						}
						?>
					</tr>
       			 	</table>
             </div>

       			 <div id="sentMessages" class="tabcontent">  
       			 	<table class="beta">
       			 		<tr>
       			 			<th>Tema</th>
       			 			<th>Tekstas</th>
       			 			<th>Data</th>
       			 			<th>Gavėjas</th>
       			 		</tr>
       			 		<?php
       			 		$userID = $session->userinfo["id_Vartotojas"];
       			 		$query3="SELECT zinute.id_Zinute, zinute.tekstas, zinute.tema, zinute.data, vartotojas.vardas, vartotojas.pavarde FROM zinute, vartotojas WHERE zinute.fk_Gavejas=vartotojas.id_Vartotojas AND zinute.fk_Siuntejas=$userID";
				        $result3=$database->query($query3);
						while ($row3 = mysqli_fetch_array($result3)) {
							echo "<tr>";
							echo "<td>" . $row3['tema'] . "</td>";
							echo "<td style='width: 100px'>" . $row3['tekstas'] . "</td>";
							echo "<td>" . $row3['data'] . "</td>";
							echo "<td>" . $row3['vardas'] . " " .$row3['pavarde']. "</td>";
							echo "<td><a href='zinutes.php?sentid=".$row3['id_Zinute']."'>Šalinti</a></td>";
               echo "<td><a href='./zinutesPerziura.php?sid=".$row3['id_Zinute']."'>Peržiūrėti</a></td>";
							echo "</tr>";
							
						}
						?>
					</tr>
       			 	</table>
       			 </div>
             <?php
               if(isset($_GET['recid'])) {
                ?>
                <script>
                document.getElementById("received").click();
                </script><?php
              }
              if(isset($_GET['sentid'])) {
                ?>
                <script>
                document.getElementById("sent").click();
                </script> <?php
              }  
                        include("include/footer.php");
                        ?>	
                       </div></td></tr></table>
                               </body>
    </html>      
  <?php
    //Jei vartotojas neprisijungęs, užkraunamas pradinis puslapis  
} else {
    header("Location: index.php");
}
?>