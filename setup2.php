<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de site web</title>
</head>
<body style="text-align: center; display: flex; flex-direction: column; align-items: center;">
<h1>Création du site web</h1>
<h2>Choix des options du site </h2>
<h3 style="color: green">La connexion à la base de donnée a réussi ainsi que la création de la base blog</h3>
<form method="post" enctype="multipart/form-data">
    <div style="display: flex; flex-direction: column;">
        <label for="title">Titre du site: </label>
        <input type="text" name="title" id="title" placeholder="Ex: Mon super forum" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="slogan">Slogan: </label>
        <input type="text" name="slogan" id="slogan" placeholder="Ex: Le meilleur forum" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Prenom et Nom: </label>
        <input type="text" name="fullname" id="fullname"  placeholder="Ex: Eric Gigondan" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="color_primary">Couleur primaire: </label>
        <input type="color" id="color_primary" name="color_primary" value="#e66465" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="color_secondary">Couleur secondaire: </label>
        <input type="color" id="color_secondary" name="color_secondary" value="#e6df65" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="cv">Votre cv au format PDF: </label>
        <input type="file" id="cv" name="cv" accept="application/pdf"><br>
    </div>
    <input type="submit" name="submit" value="Enregister les informations">
</form>

<?php
require_once "vendor/autoload.php";
use Symfony\Component\Dotenv\Dotenv;
//error_reporting(0);

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
$setup = "setup2.php";

if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $primary_color = $_POST['color_primary'];
    $secondary_color = $_POST['color_secondary'];
    $cv_tmp = $_FILES['cv']['tmp_name'];
    $cv_content = file_get_contents($cv_tmp);
    $pdo = new PDO("mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",$_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
    $sql = "INSERT INTO `configuration` (`title`, `fullname`, `slogan`, `color_primary`, `color_secondary`, `cv`) VALUES (:title, :fullname, :slogan, :color1, :color2, :cv)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":title", $_POST['title']);
    $stmt->bindParam(":fullname", $_POST['fullname']);
    $stmt->bindParam(":slogan", $_POST['slogan']);
    $stmt->bindParam(":color1", $primary_color);
    $stmt->bindParam(":color2", $secondary_color);
    $stmt->bindParam(":cv", $cv_content, PDO::PARAM_LOB);
    $stmt->execute();
    unlink($setup);
    unlink('setup.php');
    header('Location: index.php');
}

?>
</body>
</html>