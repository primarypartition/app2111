# Project Setup

> https://symfony.com/

> https://symfony.com/doc/current/setup.html

> composer create-project symfony/skeleton app2111

> php -S 127.0.0.1:8000 -t public

> symfony server:start

> composer dump-autoload

> composer create-project symfony/website-skeleton ./ "4.2.*"

``` 
<VirtualHost *:80>   
	ServerName local.app2111
	DocumentRoot "C:\xampp\htdocs\app2111\public" 
</VirtualHost>
```

```
127.0.0.1        local.app2111
```

> https://symfony.com/download

> symfony check:requirements

> composer require symfony/requirements-checker

> http://local.app2111/check.php

> composer remove symfony/requirements-checker

> composer require logger


# Git Repo Setup 

```
git init
git add .
git commit -m "project init"
git remote add origin https://github.com/primarypartition/app2111.git
git push -u origin master
```


# Database 

> composer require doctrine

> composer require orm

> bin/console doctrine:database:create
 
> bin/console make:entity

> bin/console make:migration

> bin/console doctrine:migrations:migrate


# Symfony Flex and Packages

> https://flex.symfony.com/

> composer require symfony/flex

> composer require twig-bundle

> composer require maker

> composer require orm

> composer require symfony/asset


# Commands

> bin/console

> bin/console make:controller WelcomeController

> bin/console doctrine:database:create

> bin/console make:entity

> bin/console make:migration

> bin/console doctrine:migrations:migrate

> bin/console debug:container

> bin/console cache:clear


# .htaccess file in public folder

```
<IfModule mod_rewrite.c>
    Options -MultiViews
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ index.php [QSA,L]
</IfModule>

<IfModule !mod_rewrite.c>
    <IfModule mod_alias.c>
        RedirectMatch 302 ^/$ /index.php/
    </IfModule>
</IfModule>
```

