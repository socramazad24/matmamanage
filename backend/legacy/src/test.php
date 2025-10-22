<?php
// user_registration.php

class UserRegistration
{
    private $conex;

    public function __construct($conex)
    {
        $this->conex = $conex;
    }

    public function registerUser($idEmployee, $firstName, $lastName, $username, $password, $email, $phone, $role)
    {
        $datereg = date("y/m/d");

        // Validar campos
        if (
            strlen($idEmployee) >= 1 &&
            strlen($firstName) >= 1 &&
            strlen($lastName) >= 1 &&
            strlen($username) >= 1 &&
            strlen($password) >= 1 &&
            strlen($email) >= 1 &&
            strlen($phone) >= 1 &&
            strlen($role) >= 1
        ) {
            // Consultar si el usuario ya existe
            $consultaUser = "SELECT * FROM users WHERE username = '$username'";
            $resultadoUser = mysqli_query($this->conex, $consultaUser);

            if (mysqli_num_rows($resultadoUser) > 0) {
                return "El usuario ya existe. Por favor, elige otro nombre de usuario.";
            } else {
                // Insertar nuevo usuario
                $consulta = "INSERT INTO users(idEmployee,firstName, lastName, username, password, email, phone, role, date_reg) 
                            VALUES ('$idEmployee','$firstName','$lastName','$username','$password','$email','$phone','$role','$datereg')";
                $resultado = mysqli_query($this->conex, $consulta);
                if ($resultado) {
                    return "te has registrado exitosamente";
                } else {
                    return "algo ha salido mal";
                }
            }
        } else {
            return "llene todos los campos";
        }
    }
}

?>
