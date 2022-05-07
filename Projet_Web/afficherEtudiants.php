<?php
require_once("connexion.php");
session_start();
if ($_SESSION["autoriser"] != "oui") {
  header("location:login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>


</head>

<body onload="refresh()">
  <?php include("entete.html"); ?>

  <main role="main">
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Liste des étudiants</h1>
        <p>Cliquer sur le bouton afin d'actualiser la liste!</p>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <!--Ligne Entete-->

            <tr>
              <th>
                CIN
              </th>
              <th>
                Nom
              </th>
              <th>
                Prénom
              </th>
              <th>
                Email
              </th>
              <th>
                Classe
              </th>
            </tr>
            <!--1er Etudiant-->
            <?php



            $sql = "SELECT * from etudiant";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($etudiants = $stmt->fetch(PDO::FETCH_ASSOC)) {
              $cin = $etudiants['cin'];
              $nom = $etudiants['nom'];
              $prenom = $etudiants['prenom'];
              $email = $etudiants['email'];
              $classe = $etudiants['Classe'];
            ?>
              <tr>
                <td>
                  <?php echo $cin ?>
                </td>
                <td>
                  <?php echo $nom ?>
                </td>
                <td>
                  <?php echo $prenom ?>
                </td>
                <td>
                  <?php echo $email ?>
                </td>
                <td>
                  <?php echo $classe ?>
                </td>
              </tr>

            <?php
            }
            ?>
          </table>
          <br>
        </div>
        <button type="submit" onclick="refresh()" class="btn btn-primary btn-block active">Actualiser</button>
      </div>
    </div>

  </main>
  
  <script>
    function refresh() {
        var xmlhttp = new XMLHttpRequest();
        var url = "http://localhost/Projet_Web/afficher.php";

    //Envoie de la requete
	xmlhttp.open("GET",url,true);
	xmlhttp.send();


     //Traiter la reponse
     xmlhttp.onreadystatechange=function()
            {  // alert(this.readyState+" "+this.status);
                if(this.readyState==4 && this.status==200){
                
                    myFunction(this.responseText);
                    alert(this.responseText);
                    console.log(this.responseText);
                    //console.log(this.responseText);
                }
            }


    //Parse la reponse JSON
	function myFunction(response){
		var obj=JSON.parse(response);
        //alert(obj.success);

        if (obj.success==1)
        {
		var arr=obj.etudiants;
		var i;
		var out="<table  border=1 >";
		for ( i = 0; i < arr.length; i++) {
			out+="<tr><td>"+
			arr[i].cin +
			"</td><td>"+
			arr[i].nom+
			"</td><td>"+
			arr[i].prenom+
			"</td><td>"+
			arr[i].adresse+
			"</td><td>"+
			arr[i].email+
			"</td></tr>" ;
		}
		out +="</table>";
		document.getElementById("demo").innerHTML=out;
       }
       else document.getElementById("demo").innerHTML="Aucune Inscriptions!";

    }
}
</script>


  <?php
  include("footer.html");
  ?>
</body>

</html>