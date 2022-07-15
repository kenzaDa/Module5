les commandes qu'il faut lancer pour tester le projet
1- composer install
2- php bin/console doctrine:database:create
3- php bin/console doctrine:migrations:migrate
4- composer require server
5-php bin/console server:run


les commandes sql à exécuter present dans le fichier newdb.sql
INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(10, 'lina@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$eU80MGZmN0J0WTdBL0w5OQ$KMQG2NuwVQow1fKGAIX9UFTxJLzngJj0qTvwO3S8Ilk'),
(11, 'senda@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$NlRqTWFvUFplbndENEJtZQ$b9a9GQT0zaMMH5Cxnq/ZxymB9uF2shnw8HHmY6xffzQ'),
(12, 'amani@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$SkxEQXBPTllTNFl3N29nZQ$77A0TCdsNe/I2K58Nrh8pS238NSAWRT1e63Evxx3eb0'),
(13, 'olfa@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$U3l4SXpFTEZkZzl3MGFxag$OhlMK/GwKZYzUJhwFUxP+bgwM9Tn7m69hX4+AvEkiPw'),
(15, 'kenzaadmin@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$M25FaVdzV1RicEFIRzNnNA$kl/pEI4+4lQcC1WxLWNrtppV+UqCuloYe309Q6+7Qcw');





des utilisateurs déja inscrit que vous pouvez utiliser pour tester
ADMIN EMAIL: kenzaadmin@gmail.com   PASSWORD : admin123456
USER  EMAIL: olfa@gmail.com   PASSWORD :111111


page d'inscription       /register
page d'authentification        /login
un bonton logout s'ajoute à la navbar si l'utlisiteur est logged in (en cas de log out redirection vers la page accessible en anonymous /views2)
page d'acces apres authentification (affichage selon le role)             /profile/views
accessible seulement si le role est admin                /admin/views1