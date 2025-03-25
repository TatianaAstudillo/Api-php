<?php

// El controlador es el intermediario entre la vista y modelo. Es quien maneja las condiciones

class Programa extends Controlador
{
    private $programaModelo;

    public function __construct()
    {
        $this->programaModelo = $this->modelo('Programa');
    }

    public function index()
    {
        // Obtener los programas
        $programas = $this->programaModelo->obtenerProgramas();
        // Preparamos los datos para pasarlos a la vista
        $datos = [
            'programas' => $programas
        ];

        // Llamamos a la vista con los datos
        $this->vista('programas/inicio', $datos);
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion'])
            ];

            // Intentar agregar el programa usando el modelo
            if ($this->programaModelo->agregarPrograma($datos)) {
                // Redireccionar a la página principal si la inserción fue exitosa
                redireccionar('/programas');
            } else {
                // Manejo de error en la inserción
                die('Algo salió mal');
            }
        } else {
            // Cargar la vista inicial con datos vacíos si la solicitud no es POST
            $datos = [
                'nombre' => '',
                'descripcion' => ''
            ];
            $this->vista('programas/agregar', $datos);
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_programa' => $id,
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion'])
            ];

            // Intentar actualizar el programa usando el modelo
            if ($this->programaModelo->actualizarPrograma($datos)) {
                // Redireccionar a la página principal si la actualización fue exitosa
                redireccionar('/programas');
            } else {
                // Manejo de error en la actualización
                die('Algo salió mal');
            }
        } else {
            // Obtener información del programa desde el modelo
            $programa = $this->programaModelo->obtenerProgramaId($id);

            // Cargar la vista inicial con datos del programa
            $datos = [
                'id_programa' => $programa->id_programa,
                'nombre' => $programa->nombre,
                'descripcion' => $programa->descripcion
            ];
            $this->vista('programas/editar', $datos);
        }
    }

    public function borrar($id)
    {
        // Obtener información del programa desde el modelo
        $programa = $this->programaModelo->obtenerProgramaId($id);

        // Cargar la vista inicial con datos del programa
        $datos = [
            'id_programa' => $programa->id_programa,
            'nombre' => $programa->nombre,
            'descripcion' => $programa->descripcion
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_programa' => $id
            ];

            // Intentar borrar el programa usando el modelo
            if ($this->programaModelo->borrarPrograma($datos)) {
                // Redireccionar a la página principal si la eliminación fue exitosa
                redireccionar('/programas');
            } else {
                // Manejo de error en la eliminación
                die('Algo salió mal');
            }
        }

        // Llamar a la vista con los datos del programa
        $this->vista('programas/borrar', $datos);
    }
}
