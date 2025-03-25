<?php

class Movimientos
{

    private $connect;

    private $table = 'sede';

    public $idSede;
    public $nombreBodega;
    public $fkCentro;
    public $activo;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getSede()
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

    public function eliminarSede($idSede)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE idSede =:idSede";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':idSede, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function actualizarSede()
    {

        $query = "UPDATE" . $this->table . " SET nombreBodega = :nombreBodega, fkCentro = :fkCentro,activo = :activo WHERE idSede = :idSede "; 

       
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idSede',$idSede, PDO::PARAM_INT);
        $stmt->bindParam(':nombreBodega',$nombreBodega, PDO::PARAM_INT);
        $stmt->bindParam(':fkCentro',$fkCentro, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$activo, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return $stmt;
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function crearSede()
    {

        $query = "INSERT INTO " . $this->table . " (nombreBodega,fkCentro,activo) VALUES (:nombreBodega,:fkCentro,:activo) "; 

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idSede',$idSede, PDO::PARAM_INT);
        $stmt->bindParam(':nombreBodega',$nombreBodega, PDO::PARAM_INT);
        $stmt->bindParam(':fkCentro',$fkCentro, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$activo, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt; 
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
