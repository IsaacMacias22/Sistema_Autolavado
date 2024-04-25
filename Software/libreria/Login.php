<?php
    class Login
    {
        public static function GetDatos($usuario,$password)
        {
            $con = new mysqli(s,u,p,bd);
            $con->set_charset("utf8");
            $query = $con->stmt_init();
            $query->prepare("CALL P_Mostrarusuarios(?,?)");
            $query->bind_param('ss', $usuario ,$password);
            $query->execute();
            $query->bind_result($usuario,$rol);
            $query->fetch();
            $query->close();
            
            return array($usuario,$rol);
        }

        function Validar($usuario,$password)
        {
            if (($usuario && $password) == NULL) 
            {
                
            }
            else 
            {
                
            }
        }
    }
?>