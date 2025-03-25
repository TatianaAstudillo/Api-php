<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de rol_permiso
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Rolpermiso.php'); // Archivo donde se define la clase rol_permiso


class RolpermisoController
{

    private $db;
    private $rol_permiso;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->rol_permiso = new rol_permiso($this->db);
    }


    public function getRolPermiso()
    {

        $stmt = $this->rol_permiso->getAll();
        $fichasToArea = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'rol_permiso' => $rol_permiso
        ]);
    }



    public function Crearfichatoarea($data)
    {
        $id_rol_permiso = $data['id_rol_permiso'] ?? null;
        $af_id_rol = $data['af_id_rol'] ?? null;
        $fk_id_permiso = $data['fk_id_permiso'] ?? null;


        if ($id_rol_permiso && $af_id_rol && $fk_id_permiso) {
            $result = $this->rol_permiso->Crearrol_permiso($id_rol_permiso, $af_id_rol, $fk_id_permiso);
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function Actualizarrol_permiso($id_rol_permiso, $data)
    {
        $id_rol_permiso = $data['id_rol_permiso'] ?? null;
        $af_id_rol = $data['af_id_rol'] ?? null;
        $fk_id_permiso = $data['fk_id_permiso'] ?? null;

        if ($id_rol_permiso && $af_id_rol && $fk_id_permiso) {
            $result = $this->rol_permiso->Actualizarrol_permiso($id_rol_permiso, $af_id_rol, $fk_id_permiso);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function Eliminarrol_permiso($id_rol_permiso)
    {
        $result = $this->rol_permiso->Eliminarrol_permiso($id_rol_permiso);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}