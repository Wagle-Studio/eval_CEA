# Brief d'évaluation pour le CEA

Ce brief a était pensé et réalisé pour l'évaluation d'un membre du CEA.

## Installation du projet

Veuillez suivre les instructions suivantes pour clôner puis démarrer le projet sur votre environnement local.

**1. Clôner le projet** :

```shell
git@github.com:Wagle-Studio/eval_CEA.git
```

**2. Accédez au projet** :

```shell
cd eval_CEA
```

**3. Créez un fichier d'environnement** ;

Pensez bien à renseigner la variable `DATABASE_URL`.

```shell
cp .env .env.local
```

**4. Installer les dépendances** ;

```shell
composer install
```


**5. Initialiser la base de données** ;

```shell
php bin/console doctrine:database:create --if-not-exists
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load -n
```


**6. Démarrer le serveur de développement et le compilateur CSS** ;

```shell
symfony serve
```