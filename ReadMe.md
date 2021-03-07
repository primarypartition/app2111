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

> bin/console list doctrine

> bin/console doctrine:schema:drop -n -q --force --full-database

```
bin/console doctrine:schema:drop -n -q --force --full-database &&
rm migrations/*.php &&
bin/console make:migration &&
bin/console doctrine:migrations:migrate -n -q 
```

> bin/console doctrine:fixtures:load -n -q

> bin/console make:entity Video

> php bin/console make:migration

> php bin/console doctrine:migrations:migrate

> bin/console make:entity Address

> php bin/console make:migration

> php bin/console doctrine:migrations:migrate

> php bin/console doctrine:fixtures:load

> bin/console debug:autowiring


# Symfony Packages

> https://flex.symfony.com/

> composer require symfony/flex

> composer require twig-bundle

> composer require maker

> composer require orm

> composer require symfony/asset

> composer require symfony/security-bundle

> composer require orm-fixtures --dev

> composer require sensio/framework-extra-bundle

> composer require web-profiler-bundle

> composer require symfony/debug-bundle

> composer require symfony/proxy-manager-bridge

> composer require symfony/cache

> composer require symfony/event-dispatcher

> composer require symfony/form


# Commands

> bin/console

> bin/console make:controller WelcomeController

> bin/console doctrine:database:create

> bin/console make:entity

> bin/console make:migration

> bin/console doctrine:migrations:migrate

> bin/console debug:container

> bin/console cache:clear

> bin/console list doctrine

> bin/console doctrine:fixtures:load -n -q

> bin/console debug:router

> bin/console debug:autowiring

> bin/console help make:migration

> bin/console about

> bin/console debug:event-dispatcher

> bin/console debug:event-dispatcher kernel.request

> bin/console make:subscriber

> bin/console make:form VideoFormType


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


# Webpack Encore

> npm init

> npm install @symfony/webpack-encore --save-dev

> npm install --save jquery

> touch webpack.config.js

```
var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .addEntry('js/custom', './build/js/custom.js')
    .addStyleEntry('css/custom', ['./build/css/custom.css'])
    // .autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
```

> ./node_modules/.bin/encore production

> ./node_modules/.bin/encore dev --watch
