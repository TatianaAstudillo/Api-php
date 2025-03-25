<?php
class Centros
{
    private $db;

    public function __construct()
    {
        $this->db = new BaseConexion;
    }

    public function obtenerCentros()
    {
        // Preparar la consulta de selección
        $this->db->query('SELECT * FROM centro');

        try {
            // Ejecutar la consulta y obtener los resultados
            return $this->db->registros();
        } catch (Exception $e) {
            // Manejo de errores: Registrar el error y devolver un array vacío
            error_log("Error al obtener centros: " . $e->getMessage());
            return [];
        }
    }

    public function agregarCentros($datos)
    {
        try {
            // Preparar la consulta SQL
            $this->db->query("INSERT INTO centro (nombre_centro, direccion, cantidad_sedes, fk_id_municipio, activo) VALUES (:nombre_centro, :direccion, :cantidad_sedes, :fk_id_municipio, :activo)");

            // Vincular los valores a los parámetros
            $this->db->bind(':nombre_centro', $datos['nombre_centro']);
            $this->db->bind(':direccion', $datos['direccion']);
            $this->db->bind(':cantidad_sedes', $datos['cantidad_sedes']);
            $this->db->bind(':fk_id_municipio', $datos['fk_id_municipio']);
            $this->db->bind(':activo', $datos['activo']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Registrar el error y devolver false
            error_log("Error al agregar centro: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerCentroId($id)
    {
        try {
            // Preparar la consulta SQL para obtener una ficha específica por su ID
            $this->db->query("SELECT * FROM centro WHERE id_centro = :id");
            $this->db->bind(':id', $id);

            // Ejecutar la consulta y obtener un solo registro
            return $this->db->registro();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver null
            error_log("Error al obtener centro por ID: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarCentro($datos)
    {
        try {
            // Preparar la consulta SQL para actualizar una ficha
            $this->db->query("UPDATE centro SET nombre_centro = :nombre_centro, direccion = :direccion, cantidad_sedes = :cantidad_sedes, fk_id_municipio = :fk_id_municipio, activo = :activo WHERE id_centro = :id");

            // Vincular los valores a los parámetros
            $this->db->bind(':id', $datos['id_centro']);
            $this->db->bind(':nombre_centro', $datos['nombre_centro']);
            $this->db->bind(':direccion', $datos['direccion']);
            $this->db->bind(':cantidad_sedes', $datos['cantidad_sedes']);
            $this->db->bind(':fk_id_municipio', $datos['fk_id_municipio']);
            $this->db->bind(':activo', $datos['activo']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al actualizar el centro: " . $e->getMessage());
            return false;
        }
    }

    public function borrarCentro($datos)
    {
        try {
            $this->db->query("DELETE FROM centro WHERE id_centro = :id");
            $this->db->bind(':id', $datos['id_centro']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al borrar el centro: " . $e->getMessage());
            return false;
        }
    }
}