<?php
    class Login
    {
        public static function GetDatos($usuario)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("select usuario, contrasena, rol from usuarios where usuario = ?");
            $query->bind_param('s', $usuario);
            $query->execute();
            $query->bind_result($usuario,$contrasena,$rol);
            $query->fetch();
            $query->close();
            return array($usuario,$contrasena,$rol);
        }
    }
?>