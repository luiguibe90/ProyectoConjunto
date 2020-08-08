<?php
include '../../intranet/service/loginService.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $loginService = new LoginService();
    $row = $loginService->login($_POST['username'], $_POST['password']);
    if (isset($row)) {
        if ($row['ROL'] == 'ADMINISTRADOR') {
            session_start();
            $_SESSION["USU"] = $row;
            header('Location: ../users/Administrator/index.php');
        } else if ($row['ROL'] == 'ALUMNO') {
            session_start();
            $_SESSION["USU"] = $row;
            header('Location: ../users/Student/index.php');
        } else if ($row['ROL'] == 'DOCENTE') {
            session_start();
            $_SESSION["USU"] = $row;
            header('Location: ../users/Teacher/index.php');
        } else if ($row['ROL'] == 'REPRESENTANTE') {
            session_start();
            $_SESSION["USU"] = $row;
            header('Location: ../users/Representative/index.php');
        } 
    }else{
        echo "<script>
                alert('Error contraseña o Nombre de Usuario');
                window.location= '../../../Seed/login.html.php'
        </script>";
        //$msg = "Error contraseña o Nombre de Usuario";
        header("location: ../../../Seed/login.html");

    }
}

?>