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
<h2>Connexion à la base de donnée </h2>
<form method="post">
    <div style="display: flex; flex-direction: column;">
    <label for="db_address" style="color: white;">Adresse de la BDD: </label>
    <input type="text" name="db_address" id="db_address" placeholder="Ex: localhost" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="db_port" style="color: white;">Port de la BDD: </label>
        <input type="text" name="db_port" id="db_port" placeholder="Ex: 3306" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="db_login" style="color: white;">Login du compte: </label>
        <input type="text" name="db_login" id="db_login"  placeholder="Ex: root" required><br>
    </div>
    <div style="display: flex; flex-direction: column;">
        <label for="db_password" style="color: white;">Mot de passe du compte: </label>
        <input type="password" name="db_password" id="db_password"  placeholder="Ex: root" required><br>
    </div>
    <input type="submit" name="submit" value="Enregister les informations">
</form>


</body>
</html>

<?php
error_reporting(0);
$setup = "setup2.php";
if (isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $db_address = $_POST['db_address'];
    $db_login = $_POST['db_login'];
    $db_password = $_POST['db_password'];
    $db_port = $_POST['db_port'];
    $db_name = "blog";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    // Tentative de connexion à la base de données
    $mysqli = new mysqli($db_address, $db_login, $db_password,null,$db_port);

    // Vérification de la connexion
    if ($mysqli->connect_errno) {
        echo " <p style='color: red;'> La connexion à la base de données a échoué </p>";
    } else {
        echo "<p style='color: green;'> La connexion à la base de données a réussi ! Vous allez etre redirigé vers la page des options dans 5s </p>";
        // Enregistrement des données dans un fichier
        $filename = ".env";
        $file = fopen($filename, "w");
        fwrite($file, "DATABASE_URL=mysql://". $db_login .".". $db_password ."@" . $db_address ."/". $db_name ."?serverVersion=5.7\n");
        fwrite($file, "DB_USERNAME=".$db_login."\n");
        fwrite($file, "DB_PASSWORD=".$db_password."\n");
        fwrite($file, "DB_HOST=".$db_address."\n");
        fwrite($file, "DB_PORT=".$db_port."\n");
        fwrite($file, "DB_DATABASE=$db_name\n");
        fclose($file);
        $pdo = new PDO("mysql:host=$db_address", $db_login, $db_password, $options);
        $sql = file_get_contents('installation.sql');
        $pdo->exec($sql);
        header('Location: '.$setup);
    }
}
?>