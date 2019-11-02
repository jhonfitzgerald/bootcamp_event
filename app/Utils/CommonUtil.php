<?php

namespace App\Utils;

class CommonUtil
{
    public static function statusFalse(){
        $jsonOut['message'] = 'Ocurrio un error al procesar Datos!';
        $jsonOut['status'] = 'false';
        return $jsonOut;
    }

    public static function statusTrue(){
        $jsonOut['message'] = 'Registro Guardado/Actualizado Correctamente!';
        $jsonOut['status'] = 'true';
        return $jsonOut;
    }
}
