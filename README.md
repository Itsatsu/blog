README - Installation du Blog
[![Codacy Badge](https://app.codacy.com/project/badge/Grade/bd2ecf206a354e9eb2d5a1f64eb74e23)](https://app.codacy.com/gh/Itsatsu/blog/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

Prérequis
Avant de commencer l'installation du blog, assurez-vous d'avoir les éléments suivants correctement configurés sur votre système :

LARAGON : Assurez-vous d'avoir installé Laragon sur votre machine et d'avoir l'optioncréation des hote virtuelle automatique coché.

COMPOSER: 

BASE DE DONNEE MySQL : Laragon inclut MySQL par défaut, mais veuillez vous assurer qu'aucune base de données portant le nom "blog" n'existe déjà dans votre instance MySQL.

SERVICE MAIL : Je recommande l'utilisation de Mailtrap pour simuler l'envoi de courriers électroniques. Vous pouvez vous inscrire sur Mailtrap pour obtenir vos informations de configuration.

Installation
Suivez ces étapes pour installer le blog sur votre système :

Étape 1 : Installer laragon
Télécharger à cette adresse: https://laragon.org/download/index.html
Installer et suivez les étapes de l'installateur.
Activer la création automatique d'hote virtuelle.

Étape 2 : Télécharger et Décompresser,Renommer
Téléchargez la dernière version du blog.
Une fois le téléchargement terminé,
Dans le répertoire www de Laragon décompressez le fichier ZIP a l'intérieur.
Renommer le dossier en "blog".

Étape 3 :Assurez-vous que Composer est installé.
Avant tout, assurez-vous que Composer est installé sur votre système.
Si ce n'est pas le cas, vous pouvez le télécharger depuis https://getcomposer.org .
Installer Composer.

Étape 4 : Cmd laragon
Ouvrer le Terminal depuis laragon et entrer la commande suivante:
cd blog

Puis cette commande:
composer install

Étape 5 : Relancer laragon

Étape 6 : Configuration de la Base de Données
Ouvrez Laragon et assurez-vous que le serveur MySQL est en cours d'exécution.
Connectez-vous à votre serveur MySQL à l'aide d'un client de base de données tel que phpMyAdmin, qui est intégré à Laragon. Assurez-vous qu'aucune base de données portant le nom "blog" n'existe déjà. Si c'est le cas, renommez-la ou supprimez-la.

Étape 7 : Configuration des préférence du site
Ouvrez votre navigateur et enter le nom du dossier que vous avez mis dans www sous cette forme (http://blog.test)
suivez les différentes étapes de paramétrage du site.
