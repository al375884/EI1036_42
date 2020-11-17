<?php

function upload_imagen()
{
    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["foto_url"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Comprobar si existe
    if(file_exists($target_file)){
        echo "La imagen ya existe";
        $uploadOk = 0;
    }

    //Comprobar el tamaño
    if($_FILES["foto_url"]["size"] > 500000){
        echo "Imagen demasido grande";
        $uploadOk = 0;
    }

    //Comprobar el formato
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && imageFileType != "gif"){
        echo "No cumple el formato (PNG, JPG, JPEG, GIF)";
        $uploadOk = 0;
    }

    //Upload imagen
    if($uploadOk == 0){
        echo "La imagen no se ha podido subir";
    }
    else{
        if(move_uploaded_file($_FILES["foto_url"]["tmp_name"], $target_file)){
            echo "La imagen se ha subido";
        }
        else{
            echo "Error al subir la imagen";
        }
    }
}