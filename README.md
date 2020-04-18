# Acorta.dor
_Este proyecto es un acortador de URLs creado en media hora más o menos. El mecanismo es muy simple, agregas una URL, y te devuelva una URL acortada que redirige a la URL que le has indicado._

## Empecemos...
Voy a intentar explicar de manera sencilla el funcionamiento del proyecto para que podáis trasladarlo a un servidor propio.

### Instalación 🔧
Bien, suponiendo que vayáis a instalarlo desde Windows en un servidor local como podría ser XAMPP, tendréis que copiar todos los archivos a una carpeta dentro de vuestro directorio raíz como podría ser: 
```
C:\xampp\htdocs\acortador\aqui_los_ficheros_del_proyecto
```

## Base de datos ⚙️
La creación de base de datos la podéis hacer desde *phpMyAdmin*, por sentencia *SQL* o como deseéis. Su contenido consiste en una simple tabla llamada **URL**. La **sentencia SQL** para su creación sería la siguiente: 
```sql
CREATE database acortador; 
USE acortador; 
CREATE TABLE `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `url` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `tourl` varchar(10) COLLATE utf8_spanish_ci NOT NULL
);
```
## Algunos ajustes más 🛠️
Como he dicho, no he tardado demasiado en crearlo ya que fue una idea que me vino al vuelo, y por lo tanto hay cosas que habría que mejorar, pero de momento hay que cambiar un par de cosas. La primera, son los datos de conexión, que están en el fichero **class/Conexion.php**. 
```php
$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
$dsn = "mysql:host=localhost;dbname=acortador";
$usuario = 'root';
$contrasena = '';
````
Las líneas indicadas arriba son las que debes modificar, cambiándo sus valores por los que tú necesites: 
* **host** = *URL de tu servidor*
* **dbname** = *Nombre de tu base de datos*
* **usuario** = *Usuario de acceso a la base de datos*
* **contrasena** = *Contraseña del usuario de la base de datos*

Por último, dentro del fichero **js/functions.js**, existe una línea que contiene la URL del servidor escrita literalmente, en concreto, la **linea 29**
```javascript
 $("input[name=recibida]").val("http://localhost/acortador/"+data.short);
```
Tendrás que cambiar esa URL literal, por la que sea en tu caso, como podría ser
```javascript
 $("input[name=recibida]").val("http://localhost/miacortador/"+data.short);
```
o si es en un servidor de pago: 
```javascript
 $("input[name=recibida]").val("http://sitio.com/"+data.short);
```

Encuentra más proyectos desarrollados por mi en [Rasnerdev](https://github.com/rasnerdev) 😊
