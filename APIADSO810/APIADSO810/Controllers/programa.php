<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Programa.php'); // Archivo donde se define la clase Movimiento


class Programas
{

    private $db;
    private $Programas;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->Programas = new Programas($this->db);
    }


    public function getProgramas()
    {

        $stmt = $this->Programas->getAll();
        $Programas = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'programas' => $Programas
        ]);
    }



    public function CrearProgramas($data)
    {
        $idProgama = $data['idProgama'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($idProgama && $nombre && $activo) {
            $result = $this->Programas->CrearProgramas($idProgama, $nombre, $activo);
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function ActualizarProgramas($idProgama, $data)
    {
        $idProgama = $data['idProgama'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $activo = $data['activo'] ?? null;

        if ($idProgama && $nombre && $activo) {
            $result = $this->Programas->ActualizarProgramas($idProgama, $nombre, $activo);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function EliminarProgramas($idProgama)
    {
        $result = $this->Programas->EliminarProgramas($idProgama);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}