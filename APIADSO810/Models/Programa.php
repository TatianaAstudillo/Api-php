<?php

class Programa
{

    private $connect;

    private $table = 'programa';

    public $idPrograma ;
    public $nombrePrograma;
    public $activo;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getProgramas()
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

    public function EliminarProgramas($idPrograma )
    {

        $query = "DELETE * FROM " . $this->table . "WHERE idPrograma  =:idPrograma ";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':idPrograma , PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function ActualizarProgramas()
    {

        $query = "UPDATE" . $this->table . " SET nombrePrograma = :nombrePrograma, activo = :activo WHERE idPrograma  = :idPrograma  "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idPrograma ',$idPrograma , PDO::PARAM_INT);
        $stmt->bindParam(':nombrePrograma',$nombrePrograma, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$activo, PDO::PARAM_INT);


        // Ejecuta la consulta y maneja posibles errores
        if ($stmt->execute()) {
            return $stmt; // Retorna el resultado si la consulta es exitosa
        } else {
            // Captura los errores en la consulta SQL y los muestra
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function CrearProgramas()
    {

        $query = "INSERT INTO " . $this->table . " (nombrePrograma,activo) VALUES (:nombrePrograma, :activo) "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':idPrograma ',$idPrograma , PDO::PARAM_INT);
        $stmt->bindParam(':nombrePrograma',$nombrePrograma, PDO::PARAM_INT);
        $stmt->bindParam(':activo',$activo, PDO::PARAM_INT);

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
