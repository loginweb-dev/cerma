
# Sobre CERMA v1.0

La herramienta incluye herramienta y paquetes de terceros:

- [Laravel Framework v7](https://laravel.com/)

# Requerimientos en el Servidor de producción
### Step #1
- LEMP (Ubuntu 18.04)
- Let’s Encrypt 
- Php Extenciones
- NodeJs & Npm

> php7.4-mbstring

> php7.4-bcmath

> php7.4-gd

> php7.4-dom

> php7.4-curl

> php7.4-zip

# Instalador 
### Step #1
Clona el repositorio oficial e instala las dependencias
- git clone
- composer install
- npm install
- npm run prod

### Step #2
Configura el erchivo .env (Variales de Entorno) y permisos
-   cp .env.example .env
-   edit .env (nano)   
-   chmod -R 777 (storage, bootstrap y public)

### Step #3
Realizar la instalcion mediante el comando:
- php artisan cerma:install

### Step #4
Ingresa a http://tudominio/admin - Login de super usuario:
-   admin@admin.com 
-   password

# CERMA Sponsors

La empresa detras del Diseño y Creacion del CERMA v2020 es:

- ***[LoginWeb - Empresa de Diseño y Desarrollo de Hardware y Software](https://loginweb.dev/)***

### Contributing

Los desarrolladores del CERMA son los Ingenieros:
- [Ing. Percy Alvarez - 71130523](#)
- [Ing. Raul Montero](#)
- [Ing. Agustin Mejia](#)


### License

CERMA v2020 is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
