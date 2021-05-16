<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Projeto

* Para desenvolvimento do projeto foi utilizado **PHP7.4**
* O servidor HTTP utilizado foi o **NGINX**
* O banco de dados utilizado foi o **MySQL**
* Ubuntu versão **18.04**

## Pré Requisitos

* MySQL
* PHP 7.4
* Nginx (opcional)
* Composer

## Configuração Linux

Após baixar este repositório você deverá entrar na pasta do projeto e executar o comando **composer install**. Já com o
MySQL configurado e funcional deverá criar um database e ajustar as configurações de banco de dados do projeto, que
ficam localizadas no arquivo **.env**, deverá alterar as seguintes linhas

- DB_DATABASE=**database**
- DB_USERNAME=**root**
- DB_PASSWORD=**pass**

Onde em DB_DATABASE deverá informar o nome do banco de dados, DB_USERNAME o nome do usuário do banco e DB_PASSWORD a
senha.

Feito isso será necessário rodar as migrations para criação das tabelas do banco com o seguinte comando:

**php artisan migrate**

Após isso deverá rodar os seguintes comandos

- npm install
- npm run dev

Feito isso será necessário apenas configurar o ambiente.

## Configuração de ambiente

Caso utilize o NGINX basta adicionar o seguinte trecho na configuração default do NGINX ou no arquivo simbólico criado
para configuração.

```server {
    listen 80;
    server_name dev.alhambrait.com;
    root /var/www/html/fausto/alhambrait/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}

```
Onde terá que alterar apenas em
```
server_name dev.alhambrait.com;
root /path_to_project/public;
fastcgi_pass unix:/run/php/php7.4-fpm.sock;
```
**server_name** deve ser preenchido com o host que quer utilizar, **root** a localização do arquivo index.php que está na pasta public do projeto e **fastcgi_pass** para a versão do PHP que está utilizando.

Caso queira utilizar o servidor web "embutido" basta utilizar o seguinte comando dentro da pasta do projeto:

- php artisan serve

## Contato

* Email: faustogmjr@gmail.com
* Ligação/Whatsapp: (24) 99930-9321
