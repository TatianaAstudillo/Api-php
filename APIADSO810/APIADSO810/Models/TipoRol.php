<?php

class Movimientos
{

    private $connect;

    private $table = 'tiporol';

    public $idTipoRol;
    public $nombreRol;
    public $activo;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getTipoRol()
    {

        $query = "SELECT * FROM " . $this->table; 

        $stmt = $this->connect->prepare($query);

        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function eliminarTipoRol($idTipoRol)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE idTipoRol =:idTipoRol";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':idTipoRol, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function actualizarTipoRol()
    {

        $query = "UPDATE" . $this->table . " SET nombreRol = :nombreRol, activo = :activo WHERE idTipoRol = :idTipoRol "; 

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idTipoRol',$idTipoRol, PDO::PARAM_INT);
        $stmt->bindParam(':nombreRol',$nombreRol, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$activo, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return $stmt; 
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function crearTipoROl()
    {

        $query = "INSERT INTO " . $this->table . " (nombreRol,activo) VALUES (:nombreRol, :activo) "; 

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idTipoRol',$idTipoRol, PDO::PARAM_INT);
        $stmt->bindParam(':nombreRol',$nombreRol, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$activo, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
