<?php
session_start();
if ($_SESSION["autoriser"] != "oui") {
  header("location:login.php");
  exit();
}
if (date("H") < 18)
  $bienvenue = "Bonjour, Mr " .
    $_SESSION["prenomNom"];
else
  $bienvenue = "Bonsoir, Mr " .
    $_SESSION["prenomNom"];
?>
<!doctype html>
<html lang="en">

<head>
  <title>SCO-ENICAR</title>
</head>

<body>
  <?php
      include("entete.html");
      ?>

  <main role="main">

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3"> <?php echo $bienvenue ?></h1>
        <p>Bienvenue dans votre espace personnel d'enseignement.</p>
        <p>Vous pouvez gérer vos classes .</p> 
        <p><a class="btn btn-primary btn-lg" href="#section" role="button">Mes Groupes &raquo;</a></p>
      </div>
    </div>
</br>
</br>

    <div class="container" align="center">
      <!-- Example row of columns -->
      <div class="row" id="section">
        <div class="col-md-4">
          <h2 style="color:red;">INFO1</h2>
          <p>Cliquez ici pour gérer la classe INFO 1</p>
          <p><a class="btn btn-secondary" href="ajouterGroupe.php" role="button"> les Groupes &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2 style="color:red;">INFO2</h2>
          <p>Cliquez ici pour gérer la classe INFO 2</p>
          <p><a class="btn btn-secondary" href="ajouterGroupe.php" role="button"> les Groupes &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2 style="color:red;">INFO3</h2>
          <p>Cliquez ici pour gérer la classe INFO 3</p>
          <p><a class="btn btn-secondary" href="ajouterGroupe.php" role="button"> les Groupes &raquo;</a></p>
        </div>
        
      </div>
      <div class="container" align="center">
        <!-- Example row of columns -->
        <div class="row">
          <div class="col-md-4">
            <h2 style="color:blue;">Master1</h2>
            <p>Cliquez ici pour gérer la classe Master 1</p>
            <p><a class="btn btn-secondary" href="ajouterGroupe.php" role="button"> les Groupes &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2 style="color:blue;">Master2</h2>
            <p>Cliquez ici pour gérer la classe Master 2</p>
            <p><a class="btn btn-secondary" href="ajouterGroupe.php" role="button"> les Groupes &raquo;</a></p>
          </div>
          <div class="col-md-4">
            <h2 style="color:blue;">Doctorat</h2>
            <p>Cliquez ici pour gérer la classe Doctorat</p>
            <p><a class="btn btn-secondary" href="ajouterGroupe.php" role="button"> les Groupes &raquo;</a></p>
          </div>
          

        </div> <!-- /container -->

  </main>


  <?php include('footer.html'); ?>




</body>

</html>