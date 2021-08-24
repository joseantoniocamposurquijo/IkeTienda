<?php 

function baseUrl(){
	return APPURL;
}


// Retorna un array en forma debug
function debug($array, $killProcess=false){
    echo "<pre><hr>";
    print_r($array);
    echo "<hr></pre>";
    if($killProcess){
    	die();
    }
}


// Retorna la ip del cliente
function getIP(){

    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;

}



// Retorna el browser usado por el cliente
function getBrowser( $useragent ){
    if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Internet Explorer';
    } elseif (preg_match( '|Trident/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Internet Explorer';
    } elseif (strpos($useragent, 'Edg')) {
        $browser_version='';
        $browser = 'Microsoft Edge';
    } elseif (strpos($useragent, 'Opera') || strpos($useragent, 'OPR')){
            $browser_version='';
            $browser = 'Opera';
    } elseif (preg_match( '|Opera Mini/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Opera Mini';
    } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Mozilla Firefox';
    } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Google Chrome';
    } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Safari';
    } else {
        // browser not recognized!
        $browser_version = 0;
        $browser= 'Desconocido';
    }
    return $browser." - ".$browser_version;

}


// Limpia un string para evitar inyección SQL, quitar espacios en blanco, evitar javascript
function CleanString ($startString) {

    $stringClean = preg_replace(['/\s+/','/^\s|\s$/'], [' ', ''], $startString);
    $stringClean = trim($stringClean);
    $stringClean = EscSlashes($stringClean);
    $stringClean = htmlspecialchars($stringClean);
    $stringClean = str_ireplace("<script>", "", $stringClean);
    $stringClean = str_ireplace("</script>", "", $stringClean);
    $stringClean = str_ireplace("<script src>", "", $stringClean);
    $stringClean = str_ireplace("</script type=>", "", $stringClean);
    $stringClean = str_ireplace("SELECT * FROM", "", $stringClean);
    $stringClean = str_ireplace("DELETE FROM", "", $stringClean);
    $stringClean = str_ireplace("INSERT INTO", "", $stringClean);
    $stringClean = str_ireplace("SELECT COUNT(*) FROM", "", $stringClean);
    $stringClean = str_ireplace("DROP TABLE", "", $stringClean);
    $stringClean = str_ireplace("DROP DATABASE", "", $stringClean);
    $stringClean = str_ireplace("OR '1'='1'", "", $stringClean);
    $stringClean = str_ireplace("OR 1=1", "", $stringClean);
    $stringClean = str_ireplace("OR 1 = 1", "", $stringClean);
    $stringClean = str_ireplace('OR "1"="1"', "", $stringClean);
    $stringClean = str_ireplace('OR ´1´=´1´', "", $stringClean);
    $stringClean = str_ireplace("is NULL; --", "", $stringClean);
    $stringClean = str_ireplace("IS NULL; --", "", $stringClean);
    $stringClean = str_ireplace("LIKE '", "", $stringClean);
    $stringClean = str_ireplace('LIKE "', "", $stringClean);
    $stringClean = str_ireplace("LIKE ´", "", $stringClean);
    $stringClean = str_ireplace("OR 'a'='a'", "", $stringClean);
    $stringClean = str_ireplace('OR "a"="a"', "", $stringClean);
    $stringClean = str_ireplace('OR ´a´=´a´', "", $stringClean);
    $stringClean = str_ireplace("OR ´a´=´a´", "", $stringClean);
    $stringClean = str_ireplace("--", "", $stringClean);
    $stringClean = str_ireplace("^", "", $stringClean);
    $stringClean = str_ireplace("[", "", $stringClean);
    $stringClean = str_ireplace("]", "", $stringClean);
    $stringClean = str_ireplace("==", "", $stringClean);

    return $stringClean;

} // End method Clean


function EscSlashes($string, $mode=''){
    
    $chars = ['\\\\', "\\'", '\\', "'"];
    $scapeChars = ['\\', "'", '\\\\', "\\'"];
    $mode = trim(strtolower($mode));
    if ($mode == 'like') {
        array_push($chars, '%');
        array_push($scapeChars, '\\%');
        array_push($chars, '_');
        array_push($scapeChars, '\\_');
    }
    return str_replace($chars, $scapeChars, $string);

} // End method EscSlashes



function formatMoney($value){
    $value = number_format($value, 2, SPD, SPM);
    return SMONEY.$value;
}


function Encrypt($String){
    return hash("sha512", KEY . $String);
}



function VarPOST($VarName) {
    
    global $_POST;
    if (isset($_POST[$VarName])) {
        $VarName = Url($_POST[$VarName]);
    }else{
        $VarName = null;
    }
    return $VarName;

}


function Url($string) {

    $chars = ['%'  ,'^'  ,'$'  , '/' ,':'  ,'?'  ,'@'  , '=' , '}' , '{' , '&' ,   '<',   '>',  '"',  '\'',  '#',   ' '];
    $urlCodes = ['%25','%5E','%24','%2F','%3A','%3F','%40','%3D','%7D','%7B','%26', '%3C', '%3E', '%22', '%27','%23', '%20'];
    $string = str_replace($urlCodes, $chars, $string);
    return $string;

}


?>