<?php
# Versión del sistema
const VERSION = "prod";
const SO_UNIX = false;

# Credenciales para la conexión con la base de datos MySQL
/*const DB_HOST = 'localhost';
const DB_USER = 'usu_prod';
const DB_PASS = 'Dandoran$86';
const DB_NAME = 'bunker.prod';*/
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'gregordb';


# Algoritmos utilizados para la encriptación de credenciales
# para el registro y acceso de usuarios del sistema
const ALGORITMO_USER = 'crc32';
const ALGORITMO_PASS = 'sha512';
const ALGORITMO_FINAL = 'md5';


# Direcciones a recursos estáticos de interfaz gráfica
if (SO_UNIX == true) {
	define('URL_APP', "");
	define('URL_STATIC', "/static/template/");
} else {
	define('URL_APP', "/bunker");
	define('URL_STATIC', "/bunker/static/template/");
}

const TEMPLATE = "static/template.html";

# Configuración estática del sistema
const APP_TITTLE = "Bunker";
const APP_VERSION = "v1.0";
const APP_ABREV = "bunker";
const LOGIN_URI = "/usuario/login";
const DEFAULT_MODULE = "usuario";
const DEFAULT_ACTION = "panel";
//const URL_APPFILES = "/var/www/html/safi/private/archivos/";
const URL_APPIMAGES = "C:/xampp/htdocs/bunker/static/images/";
//MUESTRA LAS IMÁGENES
const URL_IMAGES = "/bunker/static/images/";

# Directorio private del sistema
$url_private = "C:/appfiles/";
define('URL_PRIVATE', $url_private);
ini_set("include_path", URL_PRIVATE);

define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
ini_set('include_path', DOCUMENT_ROOT);

session_start();
$session_vars = array('login'=>false);
foreach($session_vars as $var=>$value) {
    if(!isset($_SESSION[$var])) $_SESSION[$var] = $value;
}
?>