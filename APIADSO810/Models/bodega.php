<?php
class Bodegas
{
    private $db;

    public function __construct()
    {
        $this->db = new BaseConexion;
    }

    public function obtenerBodegas()
    {
        // Preparar la consulta de selección
        $this->db->query('SELECT * FROM bodega');

        try {
            // Ejecutar la consulta y obtener los resultados
            return $this->db->registros();
        } catch (Exception $e) {
            // Manejo de errores: Registrar el error y devolver un array vacío
            error_log("Error al obtener las bodegas: " . $e->getMessage());
            return [];
        }
    }

    public function agregarBodegas($datos)
    {
        try {
            // Preparar la consulta SQL
            $this->db->query("INSERT INTO bodega (id_bodega, numero_bodega, id_sede) VALUES (:id_bodega, :numero_bodega, :id_sede)");

            // Vincular los valores a los parámetros
            $this->db->bind(':id_bodega', $datos['id_bodega']);
            $this->db->bind(':numero_bodega', $datos['numero_bodega']);
            $this->db->bind(':id_sede', $datos['id_sede']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Registrar el error y devolver false
            error_log("Error al agregar bodega: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerBodegaID($id)
    {
        try {
            // Preparar la consulta SQL para obtener una ficha específica por su ID
            $this->db->query("SELECT * FROM bodega WHERE id_bodega = :id");
            $this->db->bind(':id', $id);

            // Ejecutar la consulta y obtener un solo registro
            return $this->db->registro();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver null
            error_log("Error al obtener la bodega por ID: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarBodega($datos)
    {
        try {
            // Preparar la consulta SQL para actualizar una ficha
            $this->db->query("UPDATE bodega SET id_bodega = :id_bodega, numero_bodega = :numero_bodega, id_sede = :id_sede,  = :,  = : WHERE id_bodega = :id");

            // Vincular los valores a los parámetros
            $this->db->bind(':id_bodega', $datos['id_bodega']);
            $this->db->bind(':numero_bodega', $datos['numero_bodega']);
            $this->db->bind(':id_sede', $datos['id_sede']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al actualizar la bodega: " . $e->getMessage());
            return false;
        }
    }

    public function borrarBodega($datos)
    {
        try {
            $this->db->query("DELETE FROM bodega WHERE id_bodega = :id");
            $this->db->bind(':id', $datos['id_bodega']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al borrar la bodega: " . $e->getMessage());
            return false;
        }
    }
}