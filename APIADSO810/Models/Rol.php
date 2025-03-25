<?php

class Rol
{

    private $connect;

    private $table = 'rol';

    public $idRol ;
    public $fkPersona ;
    public $fkTipoRol ;
    public $email  ;
    public $password ;
    public $activo ;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getRol()
    {

        $query = "SELECT * FROM " . $this->table; // Se agregó un espacio después de "FROM" para evitar errores

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);

        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function EliminarRol($idRol)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE idRol =:idRol";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':idRol, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function ActualizarRol()
    {

        $query = "UPDATE" . $this->table . " SET fkPersona = :fkPersona, fkTipoRol = :fkTipoRol, email=:email, password =password, activo=:activo WHERE idRol = :idRol "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idRol',$idRol, PDO::PARAM_INT);
        $stmt->bindParam(':fkPersona',$fkPersona, PDO::PARAM_INT);
        $stmt->bindParam(':fkTipoRol',$fkTipoRol, PDO::PARAM_INT);
        $stmt->bindParam(':email',$email, PDO::PARAM_INT);
        $stmt->bindParam(':password',$password, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$email, PDO::PARAM_INT);


        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function CrearRol()
    {

        $query = "INSERT INTO " . $this->table . " (fkPersona,fkTipoRol,email,password,activo) VALUES (:fkPersona, :fkTipoRol, :email, :password, :activo) "; 

        // Prepara la consulta SQL

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idRol',$idRol, PDO::PARAM_INT);
        $stmt->bindParam(':fkPersona',$fkPersona, PDO::PARAM_INT);
        $stmt->bindParam(':fkTipoRol',$fkTipoRol, PDO::PARAM_INT);
        $stmt->bindParam(':email',$email, PDO::PARAM_INT);
        $stmt->bindParam(':password',$password, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$email, PDO::PARAM_INT);

        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
