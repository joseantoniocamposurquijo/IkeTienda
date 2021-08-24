<?php

function CargarArchivo (){

		$nameInputFile = 'File_PrImagen';
		$unit = "Kb";

        if(empty($_FILES[$nameInputFile]["name"])){
            return utf8_decode('Error, no se encontro archivo');
        }

        // Variables de archivo
        $fileName = $_FILES[$nameInputFile]["name"];
        $tmpFile = $_FILES[$nameInputFile]["tmp_name"];
        $typeFile = $_FILES[$nameInputFile]["type"];
        $errorFile = $_FILES[$nameInputFile]["error"];
        $pathLoadFile = APPPATH.'/Assets/Img/Uploads/'; // Path
        $fileUploaded = $pathLoadFile.$fileName;

        
        if(!empty($errorFile)){
            return utf8_decode($errorFile);
        }

        if($typeFile != 'image/jpeg'){
            return utf8_decode('El archivo no es una imagen');
        }
            
        // Renombramiento del archivo
        if (move_uploaded_file($tmpFile, $fileUploaded)){

            // Establece que el archivo no sea cero bytes
            $sizeFileUploaded = filesize($fileUploaded);
            if($sizeFileUploaded === 0){
                return utf8_decode('El archivo quedo 0 bytes');
            }

            return 'OK';

        }else{
            return utf8_decode('Error, el archivo no pudo ser cargado');
        }

    }

?>