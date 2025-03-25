<?php
class Areas
{
    private $db;

    public function __construct()
    {
        $this->db = new BaseConexion;
    }

    public function obtenerAreas()
    {
        // Preparar la consulta de selección
        $this->db->query('SELECT * FROM area');

        try {
            // Ejecutar la consulta y obtener los resultados
            return $this->db->registros();
        } catch (Exception $e) {
            // Manejo de errores: Registrar el error y devolver un array vacío
            error_log("Error al obtener las Areas: " . $e->getMessage());
            return [];
        }
    }

    public function agregarAreas($datos)
    {
        try {
            // Preparar la consulta SQL
            $this->db->query("INSERT INTO area (id_area, nombre, id_usuraio_lider) VALUES (:id_area, :nombre, :id_usuraio_lider)");

            // Vincular los valores a los parámetros
            $this->db->bind(':id_area', $datos['id_area']);
            $this->db->bind(':nombre', $datos['nombre']);
            $this->db->bind(':id_usuraio_lider', $datos['id_usuraio_lider']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Registrar el error y devolver false
            error_log("Error al agregar area: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerAreaID($id)
    {
        try {
            // Preparar la consulta SQL para obtener una ficha específica por su ID
            $this->db->query("SELECT * FROM area WHERE id_area = :id");
            $this->db->bind(':id', $id);

            // Ejecutar la consulta y obtener un solo registro
            return $this->db->registro();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver null
            error_log("Error al obtener la bodega por ID: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarArea($datos)
    {
        try {
            // Preparar la consulta SQL para actualizar una ficha
            $this->db->query("UPDATE area SET id_area = :id_area, nombre = :nombre, id_usuraio_lider = :id_usuraio_lider,  = :,  = : WHERE id_area = :id");

            // Vincular los valores a los parámetros
            $this->db->bind(':id_area', $datos['id_area']);
            $this->db->bind(':nombre', $datos['nombre']);
            $this->db->bind(':id_usuraio_lider', $datos['id_usuraio_lider']);
            $this->db->bind(':', $datos['']);
            $this->db->bind(':', $datos['']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al actualizar el area: " . $e->getMessage());
            return false;
        }
    }

    public function borrarBodega($datos)
    {
        try {
            $this->db->query("DELETE FROM area WHERE id_area = :id");
            $this->db->bind(':id', $datos['id_area']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al borrar el area: " . $e->getMessage());
            return false;
        }
    }
}