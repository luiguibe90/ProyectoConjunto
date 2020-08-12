<?php

class Connection {
    function getConnection() {
        $conex = mysqli_connect("sschoodb.mysql.database.azure.com", "adminschoolar@sschoodb", "Admin+123", "schoolardb");
        if (!$conex) {
            echo "<p>Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno();
            echo "error de depuración: " . mysqli_connect_error();
            echo "<p/>";
            exit;
        }
        return $conex;
    }
}
?>