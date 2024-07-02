<?php
class UserModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function registroUsuario()
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $tipo = $_POST["tipo"];
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $dni = $_POST["dni"];
            $numero = $_POST["numero"];
            if($tipo == 1)
            {
               $edad = $_POST["edad"];
               $sql = "INSERT INTO Usuarios (nombre,tipo, email, password, dni, numero,edad) values 
                        ('$nombre', '$tipo', '$email', '$password', '$dni', '$numero', '$edad')";
            }
            if($tipo == 2){
                $direccion = $_POST["direccion"];
                $sql = "INSERT INTO Usuarios (nombre,tipo, email, password, direccion, numero) values 
                        ('$nombre', '$tipo', '$email', '$password', '$direccion','$numero')";
            }
            $this->database->execute($sql);
        }
    }

    public function loginUsuario()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = "SELECT * from Usuarios WHERE password = '$password' AND Email = '$email'";
            $resultado = $this->database->query($sql);
            if ($resultado == null) {
                return "Error Credenciales No validas";
            }
            return $resultado;
        }
    }
}