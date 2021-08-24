<?php

/**
 * @author Jose Antonio Campos Urquijo
 * Se obtienen los parámetros de la url para determinar el controlador y el metodo al que se está apuntando, asi como los demás parámetros que puedan venir
 * 
*/

require_once 'Config/Config.php';
require_once 'Help/Helpers.php';
require_once 'Help/Files.php';


$url = isset($_GET['url']) ? $_GET['url'] : 'home/home';

$arrUrl = explode('/', $url);

$controller = $arrUrl[0];
$method = $arrUrl[0];
$params = '';

// Se obienen los métodos
if(!empty($arrUrl[1])){
	if($arrUrl[1] != ''){
		$method = $arrUrl[1];
	}
}

// Se obtienen los parámetros
if(!empty($arrUrl[2])){
	if($arrUrl[2] != ''){
		for($i=2; $i < count($arrUrl); $i++){
			$params .= $arrUrl[$i].',';
		}
		$params = trim($params,',');
	}
}

require_once 'Lib/Core/Autoload.php';
require_once 'Lib/Core/Load.php';


?>