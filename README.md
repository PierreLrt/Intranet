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

Il vous faudra à présent créer une base de données MySQL nommée *intranet*, puis ouvrir le fichier **.env** dans un IDE et saisir vos identifiants MySQL dans *DB_USERNAME* et *DB_PASSWORD*.

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

### Inscription

Remplissez tous les champs puis cliquez sur le bouton “S’inscrire”.

![Inscription](https://i.ibb.co/vPTd2Mm/inscription-1.png "Inscription")

Une adresse mail @viacesi.fr est obligatoire pour s’inscrire.

![Inscription](https://i.ibb.co/yWKwcJg/inscription-2.png "Inscription")

### Connexion

![Connexion](https://i.ibb.co/YP3gC0S/connexion.png "Connexion")

### Actualités

**Création d'une actualité :**

![CreateActualite](https://i.ibb.co/pb0zFjT/create-actualite.png "CreateActualite")

Ici, il s’agit d’ajouter une actualité. Cette fonctionnalité est accessible uniquement par un administrateur.

**Visualisation des actualités :**

![ActualiteList](https://i.ibb.co/g6q4Nxj/actualite-list.png "ActualiteList")

Il s’agit de la page actualité, elle regroupe toutes les actualités postées au préalable pas les administrateur.
Il est possible d’ajouter des commentaires sur ce poste.
Les administrateurs ont la possibilité de le modifier ou le supprimer.

### Evenements

Seuls les administrateurs peuvent créer un événement.

Insérer tous les champs nécessaire à la création de ce dernier.

![CreateEvenement](https://i.ibb.co/DDpmsHB/create-evenement.png "CreateEvenement")

Les administrateurs ainsi que les utilisateurs peuvent interagir avec les événements ("Participe", "Peut-être", "Ne participe pas").

![ParticipeEvenement](https://i.ibb.co/VMP8cqk/participe-evenement.png "ParticipeEvenement")

Seuls les administrateurs peuvent éditer/supprimer les événements.

![EditEvenement](https://i.ibb.co/BKqTf6N/edit-evenement.png "EditEvenement")

### Fils d'actualités

Le fils d'actualités en la partie réseau social de l'application. Vous pouvez voir ici les publications des personnes que vous suivez.

Il est également possible de mettre une mention "J'aime" sur une publication.

![FilActualite](https://i.ibb.co/CvVxdBf/fil-actualite.png "FilActualite")

### Annuaire

Dans l'annuaire, vous pouvez voir la liste des utilisateurs.
Vous pouvez également rechercher des utilisateurs.

![Annuaire](https://i.ibb.co/5swRNGn/annaire.png "Annuaire")

En cliquant sur le bouton avec l'oeil, vous accederez au détail de l'utilisateur.

Sur cette page, vous avez la possibilité de :
- S'abonner à cet utilisateur
- Voir les abonnements de l'utilisateur
- Voir les abonnées de l'utilisateur
- Voir la liste des publications de l'utilisateur

![ShowAnnuaire](https://i.ibb.co/qpr6rbG/show-annuaire.png "ShowAnnuaire")

### Profil

Sur cette page, vous pouvez voir les informations de votre profil et modifier votre avatar.

 ![Profil](https://i.ibb.co/ykW2mF6/profil.png "Profil")
 
 Vous avez également la possibilité de modifier votre email.
 
 ![ProfilEmail](https://i.ibb.co/V2LXmYy/profil-email.png "ProfilEmail")
 
 Il est également possible de modifier votre mot de passe.
 
 ![ProfilEmail](https://i.ibb.co/Mc7jn4J/profl-password.png "ProfilEmail")

### Déconnexion

En cliquant sur le bouton "Déconnexion", vous serez déconnecté et redirigé vers la page de connexion.

## Licence
[MIT](https://choosealicense.com/licenses/mit/)
