<?php 

// Ubicación de la aplicación
const APPURL = 'http://localhost/Tienda/'; // url de la aplicacion
const PROTOCOL = 'http'; // protocolo a usar
const APPPATH = 'C:/Apache24/htdocs/Tienda/'; // path donde se encuentra ubicado el proyecto

// Url donde se visualizan las imagenes
const URLIMG = 'http://localhost/Tienda/Assets/Img/Uploads/'; // url de descarga de imagenes

// Constantes de base de datos
const DBHOST = 'localhost'; // servidor de base de datos
const DBNAME = 'tienda'; // nombre de la base de datos
const DBUSER = 'root'; // usuario
const DBPW = '1q2w3e4r'; // password
const DBCHARSET = 'latin1'; // set de caracteres

// Separadores para la funcion formatMoney()
const SPD = ','; // separadores de decimales
const SPM = '.'; // separadore de miles
const SMONEY = '$'; // simbolo de moneda

// Establecimiento de zona horaria
date_default_timezone_set("America/Bogota");

// Modo de encriptacion de los valores pasados en el carrito de compras
const KEY = 'ike'; // clave para encriptar info
const METHOD = 'AES-128-ECB'; // metodo de encriptacion

?>