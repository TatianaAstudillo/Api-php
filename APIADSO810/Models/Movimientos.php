<?php

class Movimientos
{

    private $connect;

    private $table = 'movimientos';

    public $idMovimiento;
    public $fecha;
    public $fkPersona;
    public $tipoMovimiento;

    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getAll()
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

    public function eliminarMovimiento($idMovimiento)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE idMovimiento =:idMovimiento";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':idMovimiento, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function actualizarMovimiento()
    {

        $query = "UPDATE" . $this->table . " SET fecha = :fecha, fkPersona = :fkPersona, tipoMovimiento = :tipoMovimiento WHERE idMovimiento = :idMovimiento "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idMovimiento',$idMovimiento, PDO::PARAM_INT);
        $stmt->bindParam(':fecha',$fecha, PDO::PARAM_DATE);
        $stmt->bindParam(':fkPersona',$fkPersona, PDO::PARAM_INT);
        $stmt->bindParam(':tipoMovimiento',$tipoMovimiento);

        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function crearMovimiento()
    {

        $query = "INSERT INTO " . $this->table . " (fecha,fkPersona,tipoMovimiento) VALUES (:fecha, :fkPersona, :tipoMovimiento) "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idMovimiento',$idMovimiento, PDO::PARAM_INT);
        $stmt->bindParam(':fecha',$fecha, PDO::PARAM_DATE);
        $stmt->bindParam(':fkPersona',$fkPersona, PDO::PARAM_INT);
        $stmt->bindParam(':tipoMovimiento',$tipoMovimiento);

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
