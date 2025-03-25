<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/FichasToArea.php'); // Archivo donde se define la clase Movimiento


class fichasToAreaController
{

    private $db;
    private $fichasToArea;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->fichasToArea = new fichasToAreaController($this->db);
    }


    public function getFichastoarea()
    {

        $stmt = $this->fichasToArea->getAll();
        $fichasToArea = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'fichastoarea' => $fichasToArea
        ]);
    }



    public function Crearfichatoarea($data)
    {
        $idFichaToArea = $data['idFichaToArea'] ?? null;
        $fkArea = $data['fkArea'] ?? null;
        $fkFicha = $data['fkFicha'] ?? null;


        if ($idFichaToArea && $fkArea && $fkFicha) {
            $result = $this->fichasToArea->CrearMovimiento($idFichaToArea, $fkArea, $fkFicha);
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function Actualizarfichatoarea($idFichaToArea, $data)
    {
        $idFichaToArea = $data['idFichaToArea'] ?? null;
        $fkArea = $data['fkArea'] ?? null;
        $fkFicha = $data['fkFicha'] ?? null;

        if ($idFichaToArea && $fkArea && $fkFicha) {
            $result = $this->fichasToArea->Actualizarfichatoarea($idFichaToArea, $fkArea, $fkFicha);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function Eliminarfichatoarea($idFichaToArea)
    {
        $result = $this->fichasToArea->Eliminarfichatoarea($idFichaToArea);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}