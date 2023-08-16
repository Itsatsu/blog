<?php
require_once "vendor/autoload.php";

use Entity\Configuration;
use Repository\ConfigurationRepository;
use Repository\RoleRepository;
use Repository\UserRepository;
use Symfony\Component\Dotenv\Dotenv;
use Entity\User;
use Core\Database;
//error_reporting(1);

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');
$setup = "setup2.php";

if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $pdo = new PDO("mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",$_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

    $admin = new User($_POST['email'], $_POST['password'], $_POST['pseudo'], $_POST['country']);
    $database = new Database();
    $sql = "INSERT INTO `role` (`name`) VALUES ('admin')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = "INSERT INTO `role` (`name`) VALUES ('user')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $userRepository = new UserRepository();
    $userRepository->create($admin);
    $userRepository->update($admin);

    $roleRepository = new RoleRepository();
    $roleAdmin = $roleRepository->findIdByName('admin');
    $role = $roleRepository->findById($roleAdmin);
    $userRepository->updateRole($admin, $role);

    $primary_color = $_POST['color_primary'];
    $secondary_color = $_POST['color_secondary'];
    $cv = $_FILES['cv'];
    $profil = $_FILES['profil'];
    move_uploaded_file($cv['tmp_name'], "public/assets/uploads/" . "cv.pdf");
    $fileName = $cv['name'];
    $path = "public/assets/uploads/cv.pdf";
    move_uploaded_file($profil['tmp_name'], "public/assets/uploads/" . "profil.png");

    $configRepository = new ConfigurationRepository();
    $configuration = new Configuration($_POST['fullname'],$_POST['title'],$_POST['slogan'],$primary_color,$secondary_color,$_POST['github'],$_POST['linkedin'],$_POST['x'],$fileName,$path);
    $configRepository->create($configuration);

    $env = ".env";
    $file = fopen($env, "a");
    fwrite($file, "MAILER_DSN=smtp:".$_POST['smtpLogin'].":".$_POST['smtpPassword']."@".$_POST['smtpUrl'].":".$_POST['smtpPort']."\n");
    fwrite($file, "MAILER_LOGIN=".$_POST['smtpLogin']."\n");
    fwrite($file, "MAILER_PASSWORD=".$_POST['smtpPassword']."\n");
    fwrite($file, "MAILER_URL=".$_POST['smtpUrl']."\n");
    fwrite($file, "MAILER_PORT=".$_POST['smtpPort']."\n");
    fwrite($file, "MAILER_FROM=".$_POST['smtpAdresseMail']."\n");
    fclose($file);

    //unlink($setup);
    //unlink('setup.php');
    //unlink('installation.sql');
    header('Location:/');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"  href="/public/assets/style/style.php" >
    <title>Création de site web</title>
</head>
<body style="text-align: center; display: flex; flex-direction: column; align-items: center;">
<h1>Création du site web</h1>
<h2>Choix des options du site </h2>
<h3 style="color: green">La connexion à la base de données a réussi ainsi que la création de la base blog</h3>
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
        <label for="github">Lien github: </label>
        <input type="text" name="github" id="github"  placeholder="Ex: https://github" ><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Lien linkedin</label>
        <input type="text" name="linkedin" id="linkedin"  placeholder="Ex: https://linkedin"><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Lien X: </label>
        <input type="text" name="x" id="x"  placeholder="Ex: https://x" ><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Prenom et Nom: </label>
        <input type="text" name="fullname" id="fullname"  placeholder="Ex: Eric Gigondan" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Email compte admin: </label>
        <input type="text" name="email" id="email"  placeholder="test@test.fr" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Pseudo compte admin: </label>
        <input type="text" name="pseudo" id="pseudo"  placeholder="Ex: Itsatsu" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Mot de passe compte admin: </label>
        <input type="password" name="password" id="password"  placeholder="*******" required><br>
    </div>

    <div style="display: flex; flex-direction: column;">
        <label for="fullname">Pays du compte admin: </label>
        <input type="text" name="country" id="country"  placeholder="France" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="color_primary">Couleur primaire: </label>
        <input type="color" id="color_primary" name="color_primary" value="#e66465" ><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="color_secondary">Couleur secondaire: </label>
        <input type="color" id="color_secondary" name="color_secondary" value="#e6df65" ><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="cv">Votre cv au format PDF: </label>
        <input type="file" id="cv" name="cv" accept="application/pdf" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="cv">Votre logo au format png: </label>
        <input type="file" id="profil" name="profil" accept=" image/png" required>
    </div>

    <h3>SMTP</h3>
    <div style="display: flex; flex-direction: column;">
        <label for="smtpLogin">login smtp:</label>
        <input type="text" id="smtpLogin" name="smtpLogin" required placeholder="usermail"><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="smtpPassword">Mot de passe smtp:</label>
        <input type="password" id="smtpPassword" name="smtpPassword" required placeholder="******"><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="smtpUrl">Adresse du serveur smtp:</label>
        <input type="text" id="smtpUrl" name="smtpUrl" required placeholder="smtp.test.fr"><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="smtpPort">port du serveur smtp:</label>
        <input type="number" id="smtpPort" name="smtpPort" required placeholder="465"><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="smtpAdresseMail">Adresse mail d'envoie:</label>
        <input type="email" id="smtpAdresseMail" name="smtpAdresseMail" placeholder="noreply@blog.fr" required><br>
    </div>
    <input type="submit" name="submit" value="Enregister les informations">
</form>


</body>
</html>

