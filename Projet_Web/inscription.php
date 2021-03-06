<?php
session_start();
@$nom = $_POST["nom"];
@$prenom = $_POST["prenom"];
@$login = $_POST["login"];
@$pass = $_POST["pass"];
@$repass = $_POST["repass"];
@$valider = $_POST["valider"];
$erreur = "";
if (isset($valider)) {

   if ($pass != $repass) $erreur = "Mots de passe non identiques!";
   else {
      include("connexion.php");
      $sel = $pdo->prepare("select id from enseignant where login=? limit 1");
      $sel->execute(array($login));
      $tab = $sel->fetchAll();
      if (count($tab) > 0)
         $erreur = "Login existe déjà!";
      else {
         $ins = $pdo->prepare("insert into enseignant(nom,prenom,login,pass) values(?,?,?,?)");
         if ($ins->execute(array($nom, $prenom, $login, md5($pass))))
            header("location:login.php");
      }
   }
}
?>
<!doctype html>

<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Hugo 0.88.1">
   <title>SCO-ENICAR Inscription Enseignant</title>

   <!-- Bootstrap core CSS -->
   <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="./assets/dist/css/signin.css" rel="stylesheet">
   <style>
      .erreur {
         color: #CC0000;
         margin-bottom: 10px;
      }
   </style>
</head>

<body class="text-center">

   <form class="form-signin" method="post" action="">
      <img class="mb-4" src="./assets/brand/user-login.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Veuillez créer votre compte</h1>

      <input type="text" class="form-control" name="nom" placeholder="Nom" required autofocus /><br />
      <input type="text" class="form-control" name="prenom" placeholder="Prénom" required /><br />
      <input type="text" class="form-control" name="login" placeholder="Login" required /><br />
      <input type="password" class="form-control" name="pass" placeholder="Mot de passe" required /><br />
      <input type="password" class="form-control" name="repass" placeholder="Confirmer Mot de passe" required /><br />
      <input class="btn btn-lg btn-primary btn-block" type="submit" name="valider" value="S'inscrire" />
      <div class="erreur"><?php echo $erreur ?></div>
      <p class="mt-5 mb-3 text-muted">&copy; SOC-Enicar 2021-2022</p>

   </form>

</body>

</html>