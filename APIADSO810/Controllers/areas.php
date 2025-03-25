<?php

// El controlador es el intermediario entre la vista y modelo. Es quien maneja las condiciones

class Area extends Controlador
{
    private $areaModelo;

    public function __construct()
    {
        $this->areaModelo = $this->modelo('Area');
    }

    public function index()
    {
        // Obtener las áreas
        $areas = $this->areaModelo->obtenerAreas();
        // Preparamos los datos para pasarlos a la vista
        $datos = [
            'areas' => $areas
        ];

        // Llamamos a la vista con los datos
        $this->vista('areas/inicio', $datos);
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'nombre' => trim($_POST['nombre']),
                'id_usuario_lider' => trim($_POST['id_usuario_lider'])
            ];

            // Intentar agregar el área usando el modelo
            if ($this->areaModelo->agregarArea($datos)) {
                // Redireccionar a la página principal si la inserción fue exitosa
                redireccionar('/areas');
            } else {
                // Manejo de error en la inserción
                die('Algo salió mal');
            }
        } else {
            // Cargar la vista inicial con datos vacíos si la solicitud no es POST
            $datos = [
                'nombre' => '',
                'id_usuario_lider' => ''
            ];
            $this->vista('areas/agregar', $datos);
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_area' => $id,
                'nombre' => trim($_POST['nombre']),
                'id_usuario_lider' => trim($_POST['id_usuario_lider'])
            ];

            // Intentar actualizar el área usando el modelo
            if ($this->areaModelo->actualizarArea($datos)) {
                // Redireccionar a la página principal si la actualización fue exitosa
                redireccionar('/areas');
            } else {
                // Manejo de error en la actualización
                die('Algo salió mal');
            }
        } else {
            // Obtener información del área desde el modelo
            $area = $this->areaModelo->obtenerAreaId($id);

            // Cargar la vista inicial con datos del área
            $datos = [
                'id_area' => $area->id_area,
                'nombre' => $area->nombre,
                'id_usuario_lider' => $area->id_usuario_lider
            ];
            $this->vista('areas/editar', $datos);
        }
    }

    public function borrar($id)
    {
        // Obtener información del área desde el modelo
        $area = $this->areaModelo->obtenerAreaId($id);

        // Cargar la vista inicial con datos del área
        $datos = [
            'id_area' => $area->id_area,
            'nombre' => $area->nombre,
            'id_usuario_lider' => $area->id_usuario_lider
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_area' => $id
            ];

            // Intentar borrar el área usando el modelo
            if ($this->areaModelo->borrarArea($datos)) {
                // Redireccionar a la página principal si la eliminación fue exitosa
                redireccionar('/areas');
            } else {
                // Manejo de error en la eliminación
                die('Algo salió mal');
            }
        }

        // Llamar a la vista con los datos del área
        $this->vista('areas/borrar', $datos);
    }
}