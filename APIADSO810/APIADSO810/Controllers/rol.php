<?php
// Se incluyen los archivos necesarios para la configuración de la base de datos y el modelo de Movimiento
require_once('Config/dataBase.php'); // Archivo donde se maneja la conexión a la base de datos
require_once('Models/Rol.php'); // Archivo donde se define la clase Movimiento


class RolController
{

    private $db;
    private $Rol;

    // Constructor de la clase
    public function __construct()
    {

        $database = new Database();
        $this->db = $database->getConnection();
        

        $this->Rol = new Rol($this->db);
    }


    public function getRol()
    {

        $stmt = $this->movimiento->getAll();
        $Rol = $stmt->fetchAll(PDO::FETCH_ASSOC);


        echo json_encode([
            'Estatus' => 'Code 200',
            'rol' => $Rol
        ]);
    }



    public function CrearRol($data)
    {
        $idRol = $data['idRol'] ?? null;
        $fkPersona = $data['fkPersona'] ?? null;
        $fkTipoRol = $data['fkTipoRol'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($idRol && $fkPersona && $fkTipoRol && $email && $password &&  $activo) {
            $result = $this->movimieRolnto->CrearRol($idRol, $fkPersona, $fkTipoRol, $email, $password, $activo );
            echo json_encode(["message" => $result ? "accion exitosa" : "Error al realizar la accion"]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }


    public function ActualizarRol($idRol, $data)
    {
        $idRol = $data['idRol'] ?? null;
        $fkPersona = $data['fkPersona'] ?? null;
        $fkTipoRol = $data['fkTipoRol'] ?? null;
        $email = $data['email'] ?? null;
        $password = $data['password'] ?? null;
        $activo = $data['activo'] ?? null;


        if ($idRol && $fkPersona && $fkTipoRol && $email && $password &&  $activo) {
            $result = $this->Rol->ActualizarRol($idRol, $fkPersona, $fkTipoRol, $email, $password, $activo);
            echo json_encode(["message" => $result ? "actualizado con exito" : "Error al actualizar "]);
        } else {
            echo json_encode(["message" => "Datos incompletos"]);
        }
    }

    public function EliminarRol($idRol)
    {
        $result = $this->Rol->EliminarRol($idRol);
        echo json_encode(["message" => $result ? " eliminado con exitos" : "Error al realizar la accion"]);
    }
}