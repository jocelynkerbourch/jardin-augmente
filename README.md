# Jardin augmenté 🌱🔌

Jardin augmenté est un projet simple qui permet de suivre le contrôler et de suivre l’activité d’un jardin via des microcontrollers type arduino. Ce system a été dévoloppé en 'Quick Win' pour être le plus adapté au mieux à l'environement technique et physique déjà en mise place. Par exemple la partie app web est gére en PHP sans framework et avec une securité un htacess.

Voici pour le moment la liste des fonctionnalités :

– Connaitre la réserve l’eau d’un puits


## publication et test 

Environement :
- php/mysql est requis
- bower est requis
- la version de php est la 5.6 ou supérieur
- le serveur doit pointer dans le dossier app/www/


Installer les composants front
```
	bower install
```

Initalisation de la BDD
```
	mysql -uroot -ppassword -hlocalhost jardin_connecte app/bdd/jardin_connect.sql
```

Créer un fichier parameters.php grace au modele parameters.dist.php
```
	#app/config/parameters.php

	<?php
		CONST PDO_DRIVER= "mysql";
		CONST PDO_HOST = "localhost";
		CONST PDO_PORT = 3306;
		CONST PDO_BASE = "jardin_connecte";
		CONST PDO_USERNAME = "root";
		CONST PDO_PASSWORD = "password";
```

Créer un fichier app/config/.htpasswd (http://www.htaccesstools.com/htpasswd-generator/)
Créer un fichier app/.htaccess
```
...
SetEnvIf Request_URI ^*/api/* protected_method=true

AuthUserFile /absolute/path/to/directory/of/config/.htpasswd
AuthName "This method is pwd protected"
AuthType Basic

Order Deny,Allow
Deny from all
Satisfy any

Require valid-user
Allow from env=!protected_method
...
```

Démarrer le serveur
```
	cd app/www/
	php -S localhost:8000
```

