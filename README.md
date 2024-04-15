<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Ejecucion 🚀

- Hacemos un git clone de la carpeta:

```
git clone https://github.com/PauloFragaDev/TwitterFake
```
- Iniciamos el proyecto con el siguiente comando:
```
sail up -d
```
- Hacemos un migrate para generar las tablas:
```
sail artisan migrate
```
- Iniciamos el gestor de paquetes:
```
sail npm run dev
```

#### En caso que no tengamos npm dentro del sail hay que realizar lo siguiente:
- Actualizamos el composer
```
sail composer update
```
- Instalamos el npm
```
sail npm install
```

## Caracteristicas ⚙️

- **Visualizar Imagen:**
Al darle click a una imagen puedes visualizarla en grande (realizado con un modal).

- **Profile & Banner:**
Los usuarios pueden cambiar la foto de perfil y el banner para sentirse unicos de los demas.
(Para esto he tenido que crear dos archivos de dropzone adicionales).

- **Reciclaje de imagenes:**
Con un usuario Admin en el navbar puedes hacer limpieza de imagenes que no se esten utilizando tanto en los **posts, banners e imagenes de perfil.**

- **Search Profile:**
Hay un buscador el cual hemos de poner el **username** del usuario para entrar en su perfil.

## Construido con 🛠️

* [Laravel 9](https://laravel.com/) - El framework web usado
* [Tailwind](https://tailwindcss.com/) - CSS Framework
* [Jquery](https://jquery.com/) - Libreria JavaScript

## Autor ✒️

* **Paulo Fraga** - [paulo.f.dev](https://paulofragadev.github.io/)

## Expresiones de Gratitud 🎁

* Gracias por ver :D
