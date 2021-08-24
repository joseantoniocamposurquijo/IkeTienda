<?php 

// Ubicación de la aplicación
const APPURL = 'http://localhost/Tienda/';
const PROTOCOL = 'http';
const APPPATH = 'C:/Apache24/htdocs/Tienda/';

// Url donde se visualizan las imagenes
const URLIMG = 'http://localhost/Tienda/Assets/Img/Uploads/';

// Constantes de base de datos
const DBHOST = 'localhost';
const DBNAME = 'tienda';
const DBUSER = 'root';
const DBPW = '1q2w3e4r';
const DBCHARSET = 'latin1';

// Separadores para la funcion formatMoney()
const SPD = ',';
const SPM = '.';
const SMONEY = '$';

// Establecimiento de zona horaria
date_default_timezone_set("America/Bogota");

// Modo de encriptacion de los valores pasados en el carrito de compras
const KEY = 'ike';
const METHOD = 'AES-128-ECB';

?>