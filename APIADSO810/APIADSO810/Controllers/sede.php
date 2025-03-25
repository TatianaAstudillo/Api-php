<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Sedes.php'); // Archivo donde se define la clase Movimiento


class SedeController
{

    private $db;
    private $sede;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->sede = new Sede($this->db);
    }


    public function getsede()
    {

        $stmt = $this->sede->getAll();
        $sede = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'sede' => $sede
        ]);
    }



    public function Crearsede($data)
    {
        $idSede = $data['idSede'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $fkCentro = $data['fkCentro'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($idSede && $nombre && $fkCentro && $activo) {
            $result = $this->sede->Crearsede($idSede, $nombre, $fkCentro, $activo);
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function Actualizarsede($idSede, $data)
    {
        $idSede = $data['idSede'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $fkCentro = $data['fkCentro'] ?? null;
        $activo = $data['activo'] ?? null;
        if ($idSede && $nombre && $fkCentro && $activo) {
            $result = $this->sede->Actualizarsede($idSede, $nombre, $fkCentro, $activo);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function Eliminarsede($idSede)
    {
        $result = $this->sede->Eliminarsede($idSede);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}