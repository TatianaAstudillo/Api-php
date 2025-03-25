<?php

class Permisos
{

    private $connect;

    private $table = 'permisos';

    public $id_permiso;
    public $nombre;
    public $descripcion;
    public $activo;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getPermisos()
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

    public function EliminarPermisos($id_permiso)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE id_permiso =:id_permiso";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':id_permiso, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function ActualizarPermisos()
    {

        $query = "UPDATE" . $this->table . " SET nombre = :nombre, descripcion = :descripcion, :activo WHERE id_permiso = :id_permiso "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_permiso',$id_permiso, PDO::PARAM_INT);
        $stmt->bindParam(':nombre',$nombre, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion',$descripcion, PDO::PARAM_INT);
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

    public function CrearPermisos()
    {

        $query = "INSERT INTO " . $this->table . " (nombre,descripcion,activo) VALUES (:nombre, :descripcion, :activo) "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_permiso',$id_permiso, PDO::PARAM_INT);
        $stmt->bindParam(':nombre',$nombre, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion',$descripcion, PDO::PARAM_INT);
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
