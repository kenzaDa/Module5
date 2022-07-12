la commande qu'il faut lancer pour tester le projet
- composer install

afin de tester le service au complet (toutes les méthodes) voici la commande : 
vendor/bin/phpunit

afin de tester les methodes une par une une  voici la commande:

phpunit --filter methodName path/to/file.php

-commande pour tester la methode state
vendor/bin/phpunit --filter teststate  tests/Service/FileSystemImprovedTest.php

-commande pour tester  la methode  createFile 
vendor/bin/phpunit --filter testcreateFile tests/Service/FileSystemImprovedTest.php



-methode deleteFile posséde 2 fonctions test pour tester les deux eventualité : fichier existant et fichier inexistant 

vendor/bin/phpunit --filter testdeleteFile  tests/Service/FileSystemImprovedTest.php 
vendor/bin/phpunit --filter testdeleteFileInexistant tests/Service/FileSystemImprovedTest.php 

-commande pour tester  la methode  WriteInFile
vendor/bin/phpunit --filter testWriteInFile  tests/Service/FileSystemImprovedTest.php
vendor/bin/phpunit --filter testWriteInInexistantFile  tests/Service/FileSystemImprovedTest.php

-commande pour tester  la methode  ReadFile 
vendor/bin/phpunit --filter testReadFile  tests/Service/FileSystemImprovedTest.php
 vendor/bin/phpunit --filter testReadFileInexistant  tests/Service/FileSystemImprovedTest.php
