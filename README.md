# Gestion d'Animaux avec MVCR

Ce projet est un site web simple réalisé en PHP permettant de gérer une base de données d'animaux. Il a été développé dans le cadre d'un projet universitaire en respectant l'architecture **MVCR** (Modèle, Vue, Contrôleur, Routeur) pour garantir modularité, maintenance et évolutivité.

## Fonctionnalités
- Ajouter, modifier et supprimer des animaux.
- Enregistrer et afficher les informations d’un animal (nom, âge, espèce, et chemin de l'image).
- Upload sécurisé d’images pour chaque animal.
- Validation des fichiers uploadés (extensions acceptées : PNG, JPEG, etc.).
- Protection contre les scripts malveillants (injections, CSRF, etc.).
- Gestion de la base de données MySQL pour stocker les données.

## Prérequis
Avant de commencer, assurez-vous d'avoir :
- Un serveur web fonctionnel (par exemple : Apache ou Nginx).
- PHP version 7.4 ou plus récente.
- MySQL pour la base de données.

## Installation
1. **Clonez ce dépôt** sur votre machine locale :
   ```bash
   git clone https://github.com/elouarddine/Gestion-Animaux-MVCR.git
   ```

2. **Accédez au répertoire du projet** :
   ```bash
   cd Gestion-Animaux-MVCR
   ```

3. **Configurez les informations de connexion MySQL** :
   - Ouvrez le fichier `mysql_config.php` et remplacez les valeurs par vos informations :
     ```php
     <?php
     define('MYSQL_HOST', 'mysql:host=your_mysql_host;'); 
     define('MYSQL_PORT', 'port=your_port;'); 
     define('MYSQL_DB', 'dbname=your_db'); 
     define('MYSQL_USER', 'your_username');  
     define('MYSQL_PASSWORD', 'your_password'); 
     ?>
     ```

4. **Créez une table dans votre base de données** :
   - Avant de lancer le projet, créez une table compatible pour éviter les problèmes.
   - Voici la structure SQL recommandée :
     ```sql
     CREATE TABLE animaux (
         id INT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         species VARCHAR(255) NOT NULL,
         age INT NOT NULL,
         imagePath VARCHAR(255) NOT NULL
     );
     ```

5. **Importez la base de données si nécessaire** :
   - Si un fichier `database.sql` est fourni, utilisez-le pour configurer la base.

6. **Lancez le projet** :
   - Déployez le projet sur votre serveur local ou une plateforme d’hébergement (ex. : XAMPP, WAMP).

## Sécurité
Le projet inclut des mesures pour garantir une sécurité optimale :
- Validation des extensions et tailles des fichiers uploadés.
- Filtrage des données d'entrée pour prévenir les injections SQL et XSS.
- Protection CSRF.

## Notes
- Pour modifier les routes ou configurer d'autres paramètres, reportez-vous au fichier `router.php`.
- Toute modification du modèle doit être synchronisée avec la base de données et le fichier `Model`.

