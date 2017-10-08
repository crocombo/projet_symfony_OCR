choisir branch:
==============
git branch -a


install depend:
===============
composer install


modifif parameters:
===================
app/config/parameters.yml


fix acl:
========
HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)

sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var


Créez la base de données:
=========================
php bin/console doctrine:database:create


Créez les tables correspondantes au schéma Doctrine:
====================================================
php bin/console doctrine:schema:update --dump-sql
php bin/console doctrine:schema:update --force


Eventuellement, ajoutez les fixtures:
=====================================
php bin/console doctrine:fixtures:load


Publiez les assets (Publiez les assets dans le répertoire web):
===============================================================
php bin/console assets:install web




****************************************************************


