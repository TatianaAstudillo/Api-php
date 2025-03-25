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
     ]
 

    
    ];