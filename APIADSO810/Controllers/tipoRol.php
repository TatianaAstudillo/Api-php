<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Tiporol
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/TipoRol.php'); // Archivo donde se define la clase Tiporol


class tiporolController
{

    private $db;
    private $Tiporol;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->Tiporol = new Tiporol($this->db);
    }


    public function getTiporol()
    {

        $stmt = $this->Tiporol->getAll();
        $Tiporol = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'tiporol' => $Tiporol
        ]);
    }



    public function CrearTiporol($data)
    {
        $idTipoRol = $data['idTipoRol'] ?? null;
        $nombreRol = $data['nombreRol'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($idTipoRol && $nombreRol && $activo) {
            $result = $this->Tiporol->CrearTiporol($idTipoRol, $nombreRol, $activo);
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function ActualizarTiporol($idTipoRol, $data)
    {
        $idTipoRol = $data['idTipoRol'] ?? null;
        $nombreRol = $data['nombreRol'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($idTipoRol && $nombreRol && $activo) {
            $result = $this->Tiporol->ActualizarTiporol($idTipoRol, $nombreRol, $activo);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function EliminarTiporol($idTipoRol)
    {
        $result = $this->Tiporol->EliminarTiporol($idTipoRol);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}