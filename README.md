
## Подготовка инструментов для локального запуска приложения

- Установите среду разработки PhpStorm или Visual Studio Code, если они ещё не
установлены на вашем компьютере. Можете использовать любой редактор кода,
но в этих двух самый богатый функционал. 
- Установите XAMPP с официального сайта.
- Рекомендуем использовать версию PHP не ниже 7.4
- Так же, рекомендуется использовать консоль **GitBash**

## Установка приложения

- Находясь в консоли GitBash, перейдите в необходимую директорию командой: **cd <локальный адрес начиная с метки локального диска>**
- Необходимая директория находится в корневой папке **xampp --> htdocs** 
- Если у вас есть доступ - клоинруйте данные на ваш локальный репозиторий командой:
- **git clone https://github.com/NikitaSedelnikov/portfolio.git**

## Настройка виртуального сервера

Перейдите в конфигурационный файл по адресу:
 <директория установки XAMPP>\apache\conf\extra\httpd-vhosts.conf
- В итоге, ваш конфигурационный файл должен выглядеть примерно так:
  
<VirtualHost *:80>\
ServerAdmin webmaster@dummy-host.example.com\
DocumentRoot "C:\xampp\htdocs\portfolio\calculator"\
ServerName calculator.local\
ServerAlias www.calculator.local\
ErrorLog "logs/dummy-host.example.com-error.log"\
CustomLog "logs/dummy-host.example.com-access.log" common\
<Directory C:\xampp\htdocs\portfolio\calculator>\
Options +Indexes +Includes +FollowSymLinks +MultiViews\
AllowOverride All\
Require all granted\
\<IfModule mod_rewrite.c>\
Options -MultiViews\
RewriteEngine On\
RewriteCond %{REQUEST_FILENAME} !-f\
RewriteRule ^(.*)$ /index.php [QSA,L]\
\</IfModule> (Без первого слэша)\
\</Directory> (Без первого слэша)\
\</VirtualHost> (Без первого слэша)

**Внимание! DocumentRoot и Directory должны выходить в директорию с файлом index.php**


- В файле xampp\apache\conf\httpd.conf убедитесь, что у строки: `Include conf/extra/httpd-vhosts.conf` отсутствует знак **"#"** в начале


## Запуск виртуального сервера

- Перейдите в клиент браузера и перейдите на стартовую страницу (**http://localhost/**)

## Возможности приложения указаны в памятке на стартовой странице

