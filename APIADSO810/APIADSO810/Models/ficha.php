<?php

class Ficha
{
    private $db;

    public function __construct()
    {
        $this->db = new BaseConexion;
    }

    public function obtenerFichas()
    {
        // Preparar la consulta de selección
        $this->db->query('SELECT * FROM ficha');

        try {
            // Ejecutar la consulta y obtener los resultados
            return $this->db->registros();
        } catch (Exception $e) {
            // Manejo de errores: Registrar el error y devolver un array vacío
            error_log("Error al obtener fichas: " . $e->getMessage());
            return [];
        }
    }

    public function agregarFicha($datos)
    {
        try {
            // Preparar la consulta SQL
            $this->db->query("INSERT INTO ficha (numero_ficha, cantidad_usuarios, id_programa, id_usuario_lider) VALUES (:numero_ficha, :cantidad_usuarios, :id_programa, :id_usuario_lider)");

            // Vincular los valores a los parámetros
            $this->db->bind(':numero_ficha', $datos['numero_ficha']);
            $this->db->bind(':cantidad_usuarios', $datos['cantidad_usuarios']);
            $this->db->bind(':id_programa', $datos['id_programa']);
            $this->db->bind(':id_usuario_lider', $datos['id_usuario_lider']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Registrar el error y devolver false
            error_log("Error al agregar ficha: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerFichaId($id)
    {
        try {
            // Preparar la consulta SQL para obtener una ficha específica por su ID
            $this->db->query("SELECT * FROM ficha WHERE id_ficha = :id");
            $this->db->bind(':id', $id);

            // Ejecutar la consulta y obtener un solo registro
            return $this->db->registro();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver null
            error_log("Error al obtener ficha por ID: " . $e->getMessage());
            return null;
        }
    }

    public function actualizarFicha($datos)
    {
        try {
            // Preparar la consulta SQL para actualizar una ficha
            $this->db->query("UPDATE ficha SET numero_ficha = :numero_ficha, cantidad_usuarios = :cantidad_usuarios, id_programa = :id_programa, id_usuario_lider = :id_usuario_lider WHERE id_ficha = :id");

            // Vincular los valores a los parámetros
            $this->db->bind(':id', $datos['id_ficha']);
            $this->db->bind(':numero_ficha', $datos['numero_ficha']);
            $this->db->bind(':cantidad_usuarios', $datos['cantidad_usuarios']);
            $this->db->bind(':id_programa', $datos['id_programa']);
            $this->db->bind(':id_usuario_lider', $datos['id_usuario_lider']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al actualizar ficha: " . $e->getMessage());
            return false;
        }
    }

    public function borrarFicha($datos)
    {
        try {
            // Preparar la consulta SQL para borrar una ficha
            $this->db->query("DELETE FROM ficha WHERE id_ficha = :id");
            $this->db->bind(':id', $datos['id_ficha']);

            // Ejecutar la consulta
            return $this->db->execute();
        } catch (PDOException $e) {
            // Manejo de errores: Registrar el error y devolver false
            error_log("Error al borrar ficha: " . $e->getMessage());
            return false;
        }
    }
}
