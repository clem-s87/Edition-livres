<!-- Pré requis  -->

Projet basé sur symfony-docker de Dunglas : https://github.com/dunglas/symfony-docker
Conteneurs démarrés avec : docker compose up -d

<!-- Installation des bundles  -->

Maker bundle : docker compose exec php composer require symfony/maker-bundle --dev
Doctrine : docker compose exec php composer require symfony/orm-pack
Doctrine migration : docker compose exec php composer require doctrine/migrations
API plateform : docker compose exec php composer require api

<!-- Commandes utiles pour la BDD  -->

Créer la base : docker compose exec php bin/console doctrine:database:create
Créer une migration : docker compose exec php bin/console make:migration
Appliquer une migration : docker compose exec php bin/console doctrine:migrations:migrate
