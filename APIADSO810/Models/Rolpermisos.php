<?php

class Movimientos
{

    private $connect;

    private $table = 'rol_permisos';

    public $id_rol_permiso;
    public $fk_id_rol ;
    public $fk_id_permiso;


    public function __construct($db)
    {
        $this->connect = $db;
    }

    public function getRol_Permisos()
    {

        $query = "SELECT * FROM " . $this->table;

        $stmt = $this->connect->prepare($query);

        if ($stmt->execute()) {
            return $stmt; 
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function eliminarRol_Permiso($id_rol_permiso)
    {

        $query = "DELETE * FROM " . $this->table . "WHERE id_rol_permiso =:id_rol_permiso";

        $stmt = $this->connect->prepare($query);

        $stmt->bindParam(':id_rol_permiso, PDO::PARAM_INT');


        if ($stmt->execute()) {
            return $stmt;
        } else {

            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function actualizarRol_Permiso()
    {

        $query = "UPDATE" . $this->table . " SET id_rol_permiso = :id_rol_permiso, fk_id_rol = :fk_id_rol, fk_id_permiso = :fk_id_permiso WHERE id_rol_permiso = :id_rol_permiso "; 

        // Prepara la consulta SQL
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_rol_permiso',$id_rol_permiso, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_rol',$fk_id_rol, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_permiso',$fk_id_permiso, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt; 
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }

    public function crearRol_Permiso()
    {

        $query = "INSERT INTO " . $this->table . " (fk_id_rol,fk_id_permiso) VALUES (:fk_id_rol, :fk_id_permiso) "; 

        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_rol_permiso',$id_rol_permiso, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_rol',$fk_id_rol, PDO::PARAM_INT);
        $stmt->bindParam(':fk_id_permiso',$fk_id_permiso, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt; 
        } else {
            $errors = $stmt->errorInfo();
            die("Error en la consulta SQL: " . $errors[2]);
        }
    }
}
