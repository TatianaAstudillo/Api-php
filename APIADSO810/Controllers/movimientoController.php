<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Movimientos.php'); // Archivo donde se define la clase Movimiento

// Definición del controlador de movimiento
class MovimientoController
{
    // Propiedades privadas para la conexión a la base de datos y la instancia de Movimiento
    private $db;
    private $movimiento;

    // Constructor de la clase
    public function __construct()
    {
        // Se crea una instancia de la clase Database para establecer la conexión a la base de datos
        $database = new Database();
        $this->db = $database->getConnection();
        
        // Se crea una instancia de la clase Movimiento y se le pasa la conexión establecida
        $this->movimiento = new Movimiento($this->db);
    }

    // Método para obtener la lista de movimientos
    public function getMovimientos()
    {
        // Llama al método getAll() del modelo Movimiento, que devuelve todos los movimientos
        $stmt = $this->movimiento->getAll();
        $movimientos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retorna la respuesta en formato JSON
        echo json_encode([
            'Estatus' => 'Code 200',
            'movimientos' => $movimientos
        ]);
    }


    // Crear un nuevo movimiento
    public function CrearMovimiento($data)
    {
        $idMovimiento = $data['idMovimiento'] ?? null;
        $fecha = $data['fecha'] ?? null;
        $fkPersona = $data['fkPersona'] ?? null;
        $tipoMovimiento = $data['tipoMovimiento'] ?? null;

        if ($idMovimiento && $fecha && $fkPersona && $tipoMovimiento) {
            $result = $this->movimiento->CrearMovimiento($idMovimiento, $fecha, $fkPersona, $tipoMovimiento);
            echo json_encode(["message" => $result ? "Movimiento creado" : "Error al crear movimiento"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Actualizar un movimiento
    public function ActualizarMovimiento($idMovimiento, $data)
    {
        $idMovimiento = $data['idMovimiento'] ?? null;
        $fecha = $data['fecha'] ?? null;
        $fkPersona = $data['fkPersona'] ?? null;
        $tipoMovimiento = $data['tipoMovimiento'] ?? null;

        if ($idMovimiento && $fecha && $fkPersona && $tipoMovimiento) {
            $result = $this->movimiento->ActualizarMovimiento($idMovimiento, $fecha, $fkPersona, $tipoMovimiento);
            echo json_encode(["message" => $result ? "Movimiento actualizado" : "Error al actualizar movimiento"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    // Eliminar un movimiento
    public function EliminarMovimiento($idMovimiento)
    {
        $result = $this->movimiento->EliminarMovimiento($idMovimiento);
        echo json_encode(["message" => $result ? "Movimiento eliminado" : "Error al eliminar movimiento"]);
    }
}