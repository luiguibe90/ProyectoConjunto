<?php
include 'mainService.php';

class LoginService extends MainService {

    function login($userName, $password) {
        $password_c = sha1($password);
        $result = $this->conex->query("SELECT
        u.NOMBRE_USUARIO as USERNAME,
        u.CLAVE as PASS,
        R.NOMBRE as ROL,
        P.NOMBRE as PNAME,
        P.APELLIDO as P2NAME
        FROM USUARIO U, ROL_USUARIO RU, PERSONA P, ROL R
        WHERE U.COD_USUARIO=RU.COD_USUARIO
        AND R.COD_ROL=RU.COD_ROL
        AND U.COD_PERSONA=P.COD_PERSONA
        AND U.NOMBRE_USUARIO= '$userName'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['PASS'] == $password_c) {
                return $row;
            }
        }
        return null;
    }
}


?>