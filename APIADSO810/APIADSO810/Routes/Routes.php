<?php

return[
    "movimientos" =>[
       "GET" =>"movimientoController@getMovimientos",
       "PUT" =>"movimientoController@crearMovimiento",
       "UPDATE" =>"movimientoController@actualizarMovimiento",
       "DETELE" =>"movimientoController@eliminarMovimiento",
    ],

    "fichastoarea" =>[
        "GET" =>"fichastoareaController@getMovimientos",
        "PUT" =>"fichastoareaController@Crearfichatoarea",
        "UPDATE" =>"fichastoareaController@Actualizarfichatoarea",
        "DETELE" =>"fichastoareaController@Eliminarfichatoarea",
    ],

     "permisos" =>[
         "GET" =>"permisosController@getPermisos",
         "PUT" =>"permisosController@CrearPermisos",
         "UPDATE" =>"permisosController@ActualizarPermisos",
         "DETELE" =>"permisosController@EliminarPermisos",
     ],
     "programa" =>[
         "GET" =>"programaController@getProgramas",
         "PUT" =>"programaController@EliminarProgramas",
         "UPDATE" =>"programaController@ActualizarProgramas",
         "DETELE" =>"programaController@CrearProgramas",
     ],
     "rol" =>[
         "GET" =>"rolController@getRol",
         "PUT" =>"rolController@CrearRol",
         "UPDATE" =>"rolController@ActualizarRol",
         "DETELE" =>"rolController@EliminarRol",
     ],
     "RolPermisos" =>[
         "GET" =>"RolPermisosController@getRolPermisos",
         "PUT" =>"RolPermisosController@CrearRolPermisos",
         "UPDATE" =>"RolPermisosController@ActualizarRolPermisos",
         "DETELE" =>"RolPermisosController@EliminarRolPermisos",
     ],
     "Sedes" =>[
         "GET" =>"SedesController@getSedes",
         "PUT" =>"SedesController@CrearSedes",
         "UPDATE" =>"SedesController@ActualizarSedes",
         "DETELE" =>"SedesController@EliminarSedes",
     ],
     "TipoRol" =>[
         "GET" =>"TipoRolController@getTipoRol",
         "PUT" =>"TipoRolController@CrearTipoRol",
         "UPDATE" =>"TipoRolController@ActualizarTipoRol",
         "DETELE" =>"TipoRolController@EliminarTipoRol",
     ],
     "Area" =>[
        "GET" =>"AreaController@obtenerAreas",
        "PUT" =>"AreaController@agregarAreas",
        "UPDATE" =>"AreaController@ActualizarArea",
        "DETELE" =>"AreaController@borrarBodega",
     ],
    "bodegas" =>[
        "GET" =>"bodegasController@obtenerBodegas",
        "PUT" =>"bodegasController@agregarBodegas",
        "UPDATE" =>"bodegasController@actualizarBodega",
        "DETELE" =>"bodegasController@borrarBodega",
    ],
    "centros" =>[
        "GET" =>"centrosController@obtenerCentros",
        "PUT" =>"centrosController@agregarCentros",
        "UPDATE" =>"centrosController@actualizarCentro",
        "DETELE" =>"centrosController@borrarCentro",
    ],
    "ficha" =>[
        "GET" =>"fichaController@obtenerFichas",
        "PUT" =>"fichaController@agregarFicha",
        "UPDATE" =>"fichaController@actualizarFicha",
        "DETELE" =>"fichaController@borrarFicha",
    ],
    "Programa" =>[
        "GET" =>"ProgramaController@obtenerProgramas",
        "PUT" =>"ProgramaController@agregarProgramas",
        "UPDATE" =>"ProgramaController@actualizarPrograma",
        "DETELE" =>"ProgramaController@borrarPrograma",
    ],
    "usuario" =>[
        "GET" =>"usuarioController@obtenerUsuarios",
        "PUT" =>"usuarioController@agregarUsuario",
        "UPDATE" =>"usuarioController@actualizarUsuario",
        "DETELE" =>"usuarioController@borrarUsuario",
    ]
    
    ];