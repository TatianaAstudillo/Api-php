<?php

// El controlador es el intermediario entre la vista y modelo. Es quien maneja las condiciones

class Paginas extends Controlador
{
    private $usuarioModelo;

    public function __construct()
    {
        $this->usuarioModelo = $this->modelo('usuario');
    }

    public function index()
    {
        // Obtener los usuarios
        $usuarios = $this->usuarioModelo->obtenerUsuarios();
        // Preparamos los datos para pasarlos a la vista
        $datos = [
            'usuarios' => $usuarios
        ];

        // Llamamos a la vista con los datos
        $this->vista('paginas/inicio', $datos);
    }

    public function agregar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'nombre' => trim($_POST['nombre']),
                'apellido' => trim($_POST['apellido']),
                'rol' => trim($_POST['rol']),
                'fecha_registro' => date('Y-m-d'), // Fecha actual
                'activo' => isset($_POST['activo']) ? 1 : 0
            ];

            // Intentar agregar el usuario usando el modelo
            if ($this->usuarioModelo->agregarUsuario($datos)) {
                // Redireccionar a la página principal si la inserción fue exitosa
                redireccionar('/paginas');
            } else {
                // Manejo de error en la inserción
                die('Algo salió mal');
            }
        } else {
            // Cargar la vista inicial con datos vacíos si la solicitud no es POST
            $datos = [
                'nombre' => '',
                'apellido' => '',
                'rol' => '',
                'fecha_registro' => '',
                'activo' => ''
            ];
            $this->vista('paginas/agregar', $datos);
        }
    }

    public function editar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_usuario' => $id,
                'nombre' => trim($_POST['nombre']),
                'apellido' => trim($_POST['apellido']),
                'rol' => trim($_POST['rol']),
                'activo' => isset($_POST['activo']) ? 1 : 0
            ];

            // Intentar actualizar el usuario usando el modelo
            if ($this->usuarioModelo->actualizarUsuario($datos)) {
                // Redireccionar a la página principal si la actualización fue exitosa
                redireccionar('/paginas');
            } else {
                // Manejo de error en la actualización
                die('Algo salió mal');
            }
        } else {
            // Obtener información del usuario desde el modelo
            $usuario = $this->usuarioModelo->obtenerUsuarioId($id);

            // Cargar la vista inicial con datos del usuario
            $datos = [
                'id_usuario' => $usuario->id_usuario,
                'nombre' => $usuario->nombre,
                'apellido' => $usuario->apellido,
                'rol' => $usuario->rol,
                'fecha_registro' => $usuario->fecha_registro,
                'activo' => $usuario->activo
            ];
            $this->vista('paginas/editar', $datos);
        }
    }

    public function borrar($id)
    {
        // Obtener información del usuario desde el modelo
        $usuario = $this->usuarioModelo->obtenerUsuarioId($id);

        // Cargar la vista inicial con datos del usuario
        $datos = [
            'id_usuario' => $usuario->id_usuario,
            'nombre' => $usuario->nombre,
            'apellido' => $usuario->apellido,
            'rol' => $usuario->rol,
            'fecha_registro' => $usuario->fecha_registro,
            'activo' => $usuario->activo
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario enviado

            // Recoger y sanitizar datos del formulario
            $datos = [
                'id_usuario' => $id
            ];

            // Intentar borrar el usuario usando el modelo
            if ($this->usuarioModelo->borrarUsuario($datos)) {
                // Redireccionar a la página principal si la eliminación fue exitosa
                redireccionar('/paginas');
            } else {
                // Manejo de error en la eliminación
                die('Algo salió mal');
            }
        }

        // Llamar a la vista con los datos del usuario
        $this->vista('paginas/borrar', $datos);
    }
}
