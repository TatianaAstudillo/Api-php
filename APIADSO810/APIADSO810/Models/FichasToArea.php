<?php

class Movimientos
{

    private $connect;

    private $table = 'fichatoarea';

    public $idFichaToArea;
    public $fkArea;
    public $fkFicha;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getFichastoarea()
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

    public function eliminarfichatoarea($idFichaToArea)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE idFichaToArea =:idFichaToArea";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':idFichaToArea, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function actualizarfichatoarea()
    {

        $query = "UPDATE" . $this->table . " SET fkArea = :fkArea, fkFicha = :fkFicha WHERE idFichaToArea = :idFichaToArea "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idFichaToArea',$idFichaToArea, PDO::PARAM_INT);
        $stmt->bindParam(':fkArea',$fkArea, PDO::PARAM_INT);
        $stmt->bindParam(':fkFicha',$fkFicha, PDO::PARAM_INT);


        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function crearfichatoarea()
    {

        $query = "INSERT INTO " . $this->table . " (fkArea,fkFicha) VALUES (:fkArea, :fkFicha) "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idFichaToArea',$idFichaToArea, PDO::PARAM_INT);
        $stmt->bindParam(':fkArea',$fkArea, PDO::PARAM_INT);
        $stmt->bindParam(':fkFicha',$fkFicha, PDO::PARAM_INT);

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
