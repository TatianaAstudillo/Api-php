<?php

class Centro extends Controlador
{
    private $centroModelo;

    public function __construct()
    {
        $this->centroModelo = $this->modelo('Centro');
    }

    public function index()
    {
        // Obtener los centros
        $centros = $this->centroModelo->obtenerCentros();
        $datos = [
            'centros' => $centros
        ];

        // Llamar a la vista con los datos
        $this->vista('centros/inicio', $datos);
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado
            $datos = [
                'nombre' => trim($_POST['nombre']),
                'direccion' => trim($_POST['direccion']),
                'cantidad_sedes' => (int)trim($_POST['cantidad_sedes']),
                'municipio' => trim($_POST['municipio']),
                'activo' => isset($_POST['activo']) ? true : false // Checkbox para activo
            ];

            // Intentar agregar el centro usando el modelo
            if ($this->centroModelo->agregarCentro($datos)) {
                // Redireccionar a la página principal si la inserción fue exitosa
                redireccionar('/centros');
            } else {
                // Manejo de error en la inserción
                die('Algo salió mal al agregar el centro');
            }
        } else {
            // Cargar la vista inicial con datos vacíos si la solicitud no es POST
            $datos = [
                'nombre' => '',
                'direccion' => '',
                'cantidad_sedes' => 0,
                'municipio' => '',
                'activo' => true
            ];
            $this->vista('centros/agregar', $datos);
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado
            $datos = [
                'id_centro' => $id,
                'nombre' => trim($_POST['nombre']),
                'direccion' => trim($_POST['direccion']),
                'cantidad_sedes' => (int)trim($_POST['cantidad_sedes']),
                'municipio' => trim($_POST['municipio']),
                'activo' => isset($_POST['activo']) ? true : false // Checkbox para activo
            ];

            if ($this->centroModelo->actualizarCentro($datos)) {
                // Redireccionar a la página principal si la actualización fue exitosa
                redireccionar('/centros');
            } else {
                // Manejo de error en la actualización
                die('Algo salió mal al actualizar el centro');
            }
        } else {
            // Obtener información del centro desde el modelo
            $centro = $this->centroModelo->obtenerCentroPorId($id);

            // Cargar la vista inicial con datos del centro
            $datos = [
                'id_centro' => $centro->id_centro,
                'nombre' => $centro->nombre,
                'direccion' => $centro->direccion,
                'cantidad_sedes' => $centro->cantidad_sedes,
                'municipio' => $centro->municipio,
                'activo' => $centro->activo
            ];
            $this->vista('centros/editar', $datos);
        }
    }

    public function borrar($id)
    {
        // Obtener información del centro desde el modelo
        $centro = $this->centroModelo->obtenerCentroPorId($id);

        // Cargar la vista inicial con datos del centro
        $datos = [
            'id_centro' => $centro->id_centro,
            'nombre' => $centro->nombre,
            'direccion' => $centro->direccion,
            'cantidad_sedes' => $centro->cantidad_sedes,
            'municipio' => $centro->municipio
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado
            if ($this->centroModelo->borrarCentro($id)) {
                // Redireccionar a la página principal si la eliminación fue exitosa
                redireccionar('/centros');
            } else {
                // Manejo de error en la eliminación
                die('Algo salió mal al borrar el centro');
            }
        }

        // Llamar a la vista con los datos del centro
        $this->vista('centros/borrar', $datos);
    }
}
?>