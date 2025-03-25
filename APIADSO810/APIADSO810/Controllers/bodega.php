<?php

// El controlador es el intermediario entre la vista y modelo. Es quien maneja las condiciones

class Bodega extends Controlador
{
    private $bodegaModelo;

    public function __construct()
    {
        $this->bodegaModelo = $this->modelo('Bodega');
    }

    public function index()
    {
        // Obtener las bodegas
        $bodegas = $this->bodegaModelo->obtenerBodegas();
        // Preparamos los datos para pasarlos a la vista
        $datos = [
            'bodegas' => $bodegas
        ];

        // Llamamos a la vista con los datos
        $this->vista('bodegas/inicio', $datos);
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'numero_bodega' => trim($_POST['numero_bodega']),
                'id_sede' => trim($_POST['id_sede'])
            ];

            // Intentar agregar la bodega usando el modelo
            if ($this->bodegaModelo->agregarBodega($datos)) {
                // Redireccionar a la página principal si la inserción fue exitosa
                redireccionar('/bodegas');
            } else {
                // Manejo de error en la inserción
                die('Algo salió mal');
            }
        } else {
            // Cargar la vista inicial con datos vacíos si la solicitud no es POST
            $datos = [
                'numero_bodega' => '',
                'id_sede' => ''
            ];
            $this->vista('bodegas/agregar', $datos);
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_bodega' => $id,
                'numero_bodega' => trim($_POST['numero_bodega']),
                'id_sede' => trim($_POST['id_sede'])
            ];

            // Intentar actualizar la bodega usando el modelo
            if ($this->bodegaModelo->actualizarBodega($datos)) {
                // Redireccionar a la página principal si la actualización fue exitosa
                redireccionar('/bodegas');
            } else {
                // Manejo de error en la actualización
                die('Algo salió mal');
            }
        } else {
            // Obtener información de la bodega desde el modelo
            $bodega = $this->bodegaModelo->obtenerBodegaId($id);

            // Cargar la vista inicial con datos de la bodega
            $datos = [
                'id_bodega' => $bodega->id_bodega,
                'numero_bodega' => $bodega->numero_bodega,
                'id_sede' => $bodega->id_sede
            ];
            $this->vista('bodegas/editar', $datos);
        }
    }

    public function borrar($id)
    {
        // Obtener información de la bodega desde el modelo
        $bodega = $this->bodegaModelo->obtenerBodegaId($id);

        // Cargar la vista inicial con datos de la bodega
        $datos = [
            'id_bodega' => $bodega->id_bodega,
            'numero_bodega' => $bodega->numero_bodega,
            'id_sede' => $bodega->id_sede
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_bodega' => $id
            ];

            // Intentar borrar la bodega usando el modelo
            if ($this->bodegaModelo->borrarBodega($datos)) {
                // Redireccionar a la página principal si la eliminación fue exitosa
                redireccionar('/bodegas');
            } else {
                // Manejo de error en la eliminación
                die('Algo salió mal');
            }
        }

        // Llamar a la vista con los datos de la bodega
        $this->vista('bodegas/borrar', $datos);
    }
}