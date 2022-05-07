<?php
include('connexion.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>SCO-ENICAR Saisir Absence</title>
</head>

<body>
  <?php
  include("entete.html");
  ?>
  <main role="main">
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-4">Signaler l'absence pour tout un groupe</h1>
        <p>Pour signaler, annuler ou justifier une absence, choisissez d'abord le groupe, le module puis l'étudiant concerné!</p>
      </div>
    </div>

    <div class="container">
      <?php

      if ($_SESSION["autoriser"] != "oui") {
        header("location:login.php");
        exit();
      } else {
        if (isset($_POST['ajouter'])) {
          $date = trim($_POST['deb']);
          $classe = trim($_POST['classe']);
          $module = trim($_POST['module']);
          $desc = trim($_POST['desc']);
          $nom = trim($_POST['nom']);
          $sql = "INSERT INTO absence (nom, classe, module, date, description) values (:nom, :classe, :module, :date, :description)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([
            ':date' => $date,
            ':classe' => $classe,
            ':module' => $module,
            ':description' => $desc,
            ':nom' => $nom,
          ]);
          $erreur = "Ajout effectué";
        }
      }
      ?>

      <div class="container">
        <form action="saisieAb.php" method="POST" id="myForm">
        <form>
<div class="form-group">
  <label for="semaine">Mettre la date:</label><br>
            <input type="date" id="deb" name="deb" value="2022-05-01" min="1980-01-01" max="2022-12-31">
          </div>
          <div class="form-group">

          <label for="classe">Choisir un groupe:</label><br>
            <select name="classe" id="classe" class="custom-select custom-select-sm custom-select-lg">
              <?php
              $sql0 = "SELECT * FROM classe";
              $stmt0 = $pdo->prepare($sql0);
              $stmt0->execute();
              while ($cats = $stmt0->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $cats['id_groupe']; ?>">
                  <?php echo $cats['name_classe']; ?>
                </option>
              <?php }
              ?>
            </select>
            <label for="module">Ecrire un module:</label><br>
            <input id="module" name="module" class="custom-select custom-select-sm custom-select-lg" type="text" placeholder="Module">

            <label for="nom">Choisir le nom de l'étudiant:</label><br>
            <select id="nom" name="nom" class="custom-select custom-select-sm custom-select-lg" type="text" placeholder="Nom de l'étudiant">
              <?php
              $sql1 = "SELECT * FROM etudiant";
              $stmt1 = $pdo->prepare($sql1);
              $stmt1->execute();
              while ($cat = $stmt1->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?php echo $cat['nom']; ?>">
                  <?php echo $cat['nom']; ?>
                </option>
              <?php }
              ?>
            </select>


            <label for="desc"> raison de l'absence :</label><br>
            <textarea id="desc" name="desc" rows="10" cols="30" class="form-control" >
     </textarea>         
     </div></br>

          <table rules="cols" frame="box">
  <tr><th>25 étudiants</th>
  
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Lundi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mardi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Mercredi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Jeudi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Vendredi</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">Samedi</th>
</tr><tr><td>&nbsp;</td>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">07/03/2022</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">08/03/2022</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">09/03/2022</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">10/03/2022</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">11/03/2022</th>
<th colspan="2" width="100px" style="padding-left: 5px; padding-right: 5px;">12/03/2022</th>
</tr><tr><td>&nbsp;</td>
<th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th><th>AM</th><th>PM</th>
</tr>
<tr class="row_3"><td><b>M. WALID SAAD</b></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
</tr>
<tr class="row_3"><td><b>M. Atallah Nabil</b></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
<td><input type="checkbox"></td>
</tr>


</table>
<br>
          <button type="submit" name="ajouter" value="ajouter" class="btn btn-primary btn-block">Valider</button>
        </form>
      </div>
    </div>
  </main>
  <?php
  include("footer.html");
  ?>
</body>

</html>