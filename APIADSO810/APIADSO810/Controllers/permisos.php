<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Permisos.php'); // Archivo donde se define la clase Movimiento


class PermisosController
{

    private $db;
    private $Permisos;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->Permisos = new Permisos($this->db);
    }


    public function getPermisos()
    {

        $stmt = $this->Permisos->getAll();
        $Permisos = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'permisos' => $Permisos
        ]);
    }



    public function CrearPermisos($data)
    {
        $id_permiso = $data['id_permiso'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $descripcion = $data['descripcion'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($id_permiso && $nombre && $descripcion &&  $activo) {
            $result = $this->Permisos->CrearPermisos($id_permiso, $nombre, $descripcion, $activo);
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function ActualizarPermisos($id_permiso, $data)
    {
        $id_permiso = $data['id_permiso'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $descripcion = $data['descripcion'] ?? null;
        $activo = $data['activo'] ?? null;

        if ($id_permiso && $nombre && $descripcion &&  $activo) {
            $result = $this->Permisos->ActualizarPermisos($id_permiso, $nombre, $descripcion, $activo);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function EliminarPermisos($id_permiso)
    {
        $result = $this->Permisos->EliminarPermisosa($id_permiso);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}