# Project Setup

> https://symfony.com/

> https://symfony.com/doc/current/setup.html

> composer create-project symfony/skeleton app2111

> php -S 127.0.0.1:8000 -t public

> symfony server:start

> composer dump-autoload

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


# Git Repo Setup 

```
git init
git add README.md
git commit -m "first commit"
git branch -M main
git remote add origin https://github.com/primarypartition/app2111.git
git push -u origin main
```

