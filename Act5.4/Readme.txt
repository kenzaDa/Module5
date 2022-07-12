les commandes qu'il faut lancer pour tester le projet
1- composer install
2-php bin/console server:run


afin de tester une méthode bien définie voici la commande
phpunit --filter methodName path/to/file.php
exemple : methode deleteFile posséde 2 fonctions test pour tester les deux eventualité : fichier existant et fichier inexistant 
vendor/bin/phpunit --filter testdeleteFile  tests/Service/FileSystemImprovedTest.php (doit retourner test ok si le fichier existe)
vendor/bin/phpunit --filter testdeleteFileInexistant tests/Service/FileSystemImprovedTest.php (doit retourner test failed si le fichier n'existe pas)
