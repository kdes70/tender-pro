I have taken as a basis "CODES-CMS on Yii 2"
================================
I have taken as a basis
Source code of SEO-service.

[Read more](http://www.elisdn.ru/blog/60/seo-service-on-yii2-installing-of-application).

Installation
------

Create a project:

clone the repository for `pull` command availability:

~~~
git clone https://github.com/kdes70/tender-pro.git project
cd project
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer install
~~~

Init an environment:

~~~
php init
~~~

Fill your DB connection information in `config/common-local.php` and execute migrations:

~~~
php yii migrate
~~~

Sign up on site or create your first user manually:

~~~
php yii user/users/create
~~~