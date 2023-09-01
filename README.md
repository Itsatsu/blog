
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/a491ef126ba445f9ba3e4c131542399d)](https://app.codacy.com/gh/Itsatsu/blog?utm_source=github.com&utm_medium=referral&utm_content=Itsatsu/blog&utm_campaign=Badge_Grade)

README - Installation du Blog
Prérequis
Avant de commencer l'installation du blog, assurez-vous d'avoir les éléments suivants correctement configurés sur votre système :

Laragon : Assurez-vous d'avoir installé Laragon sur votre machine et d'avoir l'optioncréation des hote virtuelle automatique coché.

Base de données MySQL : Laragon inclut MySQL par défaut, mais veuillez vous assurer qu'aucune base de données portant le nom "blog" n'existe déjà dans votre instance MySQL.

Service Mail : Je recommande l'utilisation de Mailtrap pour simuler l'envoi de courriers électroniques. Vous pouvez vous inscrire sur Mailtrap pour obtenir vos informations de configuration.

Installation
Suivez ces étapes pour installer le blog sur votre système :

Étape 1 : Télécharger et Décompresser
Téléchargez la dernière version du blog.
Une fois le téléchargement terminé,
Créer un dossier que vous nommé blog dans le répertoire www de Laragon et décompressez le fichier ZIP a l'intérieur.

Étape 2 : Configuration de la Base de Données
Ouvrez Laragon et assurez-vous que le serveur MySQL est en cours d'exécution.
Connectez-vous à votre serveur MySQL à l'aide d'un client de base de données tel que phpMyAdmin, qui est intégré à Laragon. Assurez-vous qu'aucune base de données portant le nom "blog" n'existe déjà. Si c'est le cas, renommez-la ou supprimez-la.

Étape 3 : Configuration des préférence du site
Ouvrez votre navigateur et enter le nom du dossier que vous avez mis dans www sous cette forme (http://blog.test)
suivez les différentes étapes de paramétrage du site.