<?php
class Programas
{
    private $db;

    public function __construct()
    {
        $this->db = new BaseConexion;
    }

    public function obtenerProgramas()
    {
        // Preparar la consulta de selección
        $this->db->query('SELECT * FROM programa');

        try {
            // Ejecutar la consulta y obtener los resultados
            return $this->db->registros();
        } catch (Exception $e) {
            // Manejo de errores: Registrar el error y devolver un array vacío
            error_log("Error al obtener las Programas: " . $e->getMessage());
            return [];
        }
    }

    public function agregarProgramas($datos)
    {
        try {
            // Preparar la consulta SQL
            $this->db->query("INSERT INTO programa (id_programa, nombre, id_area) VALUES (:id_programa, :nombre, :id_area)");

            // Vincular los valores a los parámetros
            $this->db->bind(':id_programa', $datos['id_programa']);
            $this->db->bind(':nombre', $datos['nombre']);
            $this->db->bind(':id_area', $datos['id_area']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Registrar el error y devolver false
            error_log("Error al agregar el programa: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerProgramaID($id)
    {
        try {
            // Preparar la consulta SQL para obtener una ficha específica por su ID
            $this->db->query("SELECT * FROM programa WHERE id_programa = :id");
            $this->db->bind(':id', $id);

            // Ejecutar la consulta y obtener un solo registro
            return $this->db->registro();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver null
            error_log("Error al obtener el programa por ID: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarPrograma($datos)
    {
        try {
            // Preparar la consulta SQL para actualizar una ficha
            $this->db->query("UPDATE programa SET id_programa = :id_programa, nombre = :nombre, id_area = :id_area,  = :,  = : WHERE id_programa = :id");

            // Vincular los valores a los parámetros
            $this->db->bind(':id_programa', $datos['id_programa']);
            $this->db->bind(':nombre', $datos['nombre']);
            $this->db->bind(':id_area', $datos['id_area']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al actualizar el programa: " . $e->getMessage());
            return false;
        }
    }

    public function borrarPrograma($datos)
    {
        try {
            $this->db->query("DELETE FROM programa WHERE id_programa = :id");
            $this->db->bind(':id', $datos['id_programa']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al borrar el programa: " . $e->getMessage());
            return false;
        }
    }
}