# Social CESI

**Social CESI** est un intranet, développé avec Laravel, sous forme de réseau social qui est à la destination des étudiants de **C**entre des **E**tudes **S**upérieures **I**ndustrielles du Mans.

## Installation

Il vous faudra au préalable avoir installer [Composer](https://getcomposer.org).

Dans votre invite de commande, placez-vous dans le répertoire de votre choix, puis exécutez la commande suivante afin de cloner le projet.


```
git clone https://github.com/PierreLrt/Intranet.git
```

Placez-vous dans le dossier nommé *intranet*, puis exécutez la commande suivante afin d'installer les dépendances.

```
composer install
```

Il vous faudra à présent créer une base de données MySQL nommée *intranet*, puis ouvrir le fichier **.ent** dans un IDE et saisir vos identifiants MySQL dans *DB_USERNAME* et *DB_PASSWORD*.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intranet
DB_USERNAME=root
DB_PASSWORD=root
```

A nouveau dans l'invite de commande, exécutez les migrations à l'aide de la commande suivante.

```
php artisan migrate
```

Vous pouvez maintenant lancer le serveur et vous rendre sur l'adresse [http://localhost:8000](http://localhost:8000).


```
php artisan serve
```

## Présentation

A venir...


## Utilisation

A venir...

## Licence
[MIT](https://choosealicense.com/licenses/mit/)
