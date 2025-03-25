<?php

// El controlador es el intermediario entre la vista y modelo. Es quien maneja las condiciones

class Ficha extends Controlador
{
    private $fichaModelo;

    public function __construct()
    {
        $this->fichaModelo = $this->modelo('Ficha');
    }

    public function index()
    {
        // Obtener las fichas
        $fichas = $this->fichaModelo->obtenerFichas();
        // Preparamos los datos para pasarlos a la vista
        $datos = [
            'fichas' => $fichas
        ];

        // Llamamos a la vista con los datos
        $this->vista('fichas/inicio', $datos);
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'numero_ficha' => trim($_POST['numero_ficha']),
                'cantidad_usuarios' => trim($_POST['cantidad_usuarios']),
                'id_programa' => trim($_POST['id_programa']),
                'id_usuario_lider' => trim($_POST['id_usuario_lider'])
            ];

            // Intentar agregar la ficha usando el modelo
            if ($this->fichaModelo->agregarFicha($datos)) {
                // Redireccionar a la página principal si la inserción fue exitosa
                redireccionar('/fichas');
            } else {
                // Manejo de error en la inserción
                die('Algo salió mal');
            }
        } else {
            // Cargar la vista inicial con datos vacíos si la solicitud no es POST
            $datos = [
                'numero_ficha' => '',
                'cantidad_usuarios' => '',
                'id_programa' => '',
                'id_usuario_lider' => ''
            ];
            $this->vista('fichas/agregar', $datos);
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_ficha' => $id,
                'numero_ficha' => trim($_POST['numero_ficha']),
                'cantidad_usuarios' => trim($_POST['cantidad_usuarios']),
                'id_programa' => trim($_POST['id_programa']),
                'id_usuario_lider' => trim($_POST['id_usuario_lider'])
            ];

            // Intentar actualizar la ficha usando el modelo
            if ($this->fichaModelo->actualizarFicha($datos)) {
                // Redireccionar a la página principal si la actualización fue exitosa
                redireccionar('/fichas');
            } else {
                // Manejo de error en la actualización
                die('Algo salió mal');
            }
        } else {
            // Obtener información de la ficha desde el modelo
            $ficha = $this->fichaModelo->obtenerFichaId($id);

            // Cargar la vista inicial con datos de la ficha
            $datos = [
                'id_ficha' => $ficha->id_ficha,
                'numero_ficha' => $ficha->numero_ficha,
                'cantidad_usuarios' => $ficha->cantidad_usuarios,
                'id_programa' => $ficha->id_programa,
                'id_usuario_lider' => $ficha->id_usuario_lider
            ];
            $this->vista('fichas/editar', $datos);
        }
    }

    public function borrar($id)
    {
        // Obtener información de la ficha desde el modelo
        $ficha = $this->fichaModelo->obtenerFichaId($id);

        // Cargar la vista inicial con datos de la ficha
        $datos = [
            'id_ficha' => $ficha->id_ficha,
            'numero_ficha' => $ficha->numero_ficha,
            'cantidad_usuarios' => $ficha->cantidad_usuarios,
            'id_programa' => $ficha->id_programa,
            'id_usuario_lider' => $ficha->id_usuario_lider
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_ficha' => $id
            ];

            // Intentar borrar la ficha usando el modelo
            if ($this->fichaModelo->borrarFicha($datos)) {
                // Redireccionar a la página principal si la eliminación fue exitosa
                redireccionar('/fichas');
            } else {
                // Manejo de error en la eliminación
                die('Algo salió mal');
            }
        }

        // Llamar a la vista con los datos de la ficha
        $this->vista('fichas/borrar', $datos);
    }
}
