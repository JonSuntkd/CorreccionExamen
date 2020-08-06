<?php 
    include './services/Servicios.php';
    $modulo = new Servicios();
    
    $cod_modulo = "";
    $nombre="";
    $estado="";
    $accion = "Agregar";
    $mensaje="Añadir Nuevo Modulo";
    
    if(isset($_POST['accionModulo']) && ($_POST['accionModulo']=='Agregar'))
    {
        $modulo->insertarModulo($_POST['cod_modulo'],$_POST['nombre'],$_POST['estado']);
    }
    else if(isset($_POST["accionModulo"]) && ($_POST["accionModulo"]=="Modificar"))
    {
        $modulo->modificarModulo($_POST['cod_modulo'],$_POST['nombre'],$_POST['estado'],$_POST['cod_modulo_comparar']);
    }
    else if(isset($_GET["update"]))
    {
        $result = $modulo->encontrarModulo($_GET['update']);
        if($result!=null)
        {
            $cod_modulo = $result['COD_MODULO'];
            $nombre = $result['NOMBRE'];
            $estado = $result['ESTADO'];
            $accion="Modificar";
            $mensaje = "Modificar Módulo";
        }
    }
    else if(isset($_GET['delete']))
    {
        $modulo->eliminarLogicoModulo($_GET['delete']);
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <title>Espe-Cliente</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- bootstrap -->
    <link href="css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="css/bootstrap/bootstrap-overrides.css" type="text/css" rel="stylesheet" />

    <!-- libraries -->
    <link href="css/lib/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/lib/font-awesome.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/uniform.default.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/select2.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/bootstrap.datepicker.css" type="text/css" rel="stylesheet" />
    <link href="css/lib/jquery.dataTables.css" type="text/css" rel="stylesheet" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="css/compiled/layout.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/elements.css" />
    <link rel="stylesheet" type="text/css" href="css/compiled/icons.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="css/compiled/index.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/form-showcase.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/compiled/datatables.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/pb/pb.css" type="text/css"/>
    <!-- open sans font -->
    <link href='http://fonts.googleapis.com/css?family=OpenSans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css' />

    <!-- lato font -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />
</head>
<body>
    <!-- navbar -->
    <header class="navbar navbar-inverse" role="banner">
        <div class="navbar-header">            
            <a class="navbar-brand" href="index.php">
                MODULO
            </a>
        </div>
        <ul class="nav navbar-nav pull-right hidden-xs">                       
            <li class="notification-dropdown hidden-xs hidden-sm">
                <a href="#" class="trigger">
                    <i class="icon-user"></i>
                </a>
                <div class="pop-dialog">                    
                </div>
            </li>
            <li class="dropdown open">
                <a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown">
                    Bienvenido                  
                </a>                
            </li>             
            
        </ul>
    </header>
    <!-- end navbar -->

    <!-- sidebar -->
    <div id="sidebar-nav">
        <ul id="dashboard-menu">
            <li class="active">
                <div class="pointer">
                    <div class="arrow"></div>
                    <div class="arrow_border"></div>
                </div>
                <a href="principal.php">
                    <i class="icon-home"></i>
                    <span>Home</span>
                </a>
            </li>            
            
            <li>
                <a class="dropdown-toggle" href="#">
                    <i class="icon-group"></i>
                    <span>Gestion</span>
                    <i class="icon-chevron-down"></i>
                </a>
                <ul class="submenu">
                    <li><a href="modulo.php" >Modulo</a></li>                    
                </ul>
                <ul class="submenu">
                    <li><a href="funcionalidades.php" >Funcionalidad</a></li>                    
                </ul>
                <ul class="submenu">
                    <li><a href="rol.php" >Rol</a></li>                    
                </ul>
                
            </li> 
        </ul>
    </div>
    <!-- end sidebar -->


    <!-- main container -->
    <div class="content">

        <!-- end upper main stats -->

        <div id="pad-wrapper" class="form-page">

            <!-- statistics chart built with jQuery Flot -->
            <div class="row form-wrapper">
                <!-- left column -->

                
                <div id="pad-wrapper" class="form-page">
                    <div class="row header">
                            <h3>Listado de los modulos </h3>
                            <br><br/>
                            <br><br/>
                    <div class="table-responsive">
                        <table id="tablaProductos" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                            <thead class="text-center">
                                <tr>
                                    <th>Código Módulo</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $result = $modulo->mostrarModulos(); 

                                    if ($result->num_rows > 0) 
                                    {
                                        while($row = $result->fetch_assoc()) 
                                        { 
                                ?>
                                <tr>
                                    <td><?php echo $row ["COD_MODULO"];?></td>
                                    <td><?php echo $row ["NOMBRE"];?></td>
                                    <td><?php echo $row ["ESTADO"];?></td>
                                    <td>
                                        <div class="text-center">
                                            <div class="btn-group">
                                                <a href="modulo.php?update=<?php echo $row ["COD_MODULO"];?>#editar" type="button" class="btn btn-primary">Editar</a>
                                                <a href="modulo.php?delete=<?php echo $row ["COD_MODULO"];?>" type="button" class="btn btn-danger">Eliminar</a>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }
                                    else
                                    {
                                ?>
                                <tr>
                                    <td>No hay datos en la tabla</td>
                                </tr>
                                <?php
                                    } 
                                ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
                

                <div id="pad-wrapper" class="form-page">
                    <div class="row header">
                            <h3 class="text-center text-light"><?php echo $mensaje ?></h3>
                            <br><br/>
                            <br><br/>
                        <form action="modulo.php" name="forma" method="post" id="forma">

                        <input type="hidden" name="cod_modulo_comparar" value="<?php echo $cod_modulo ?>">
                        
                        <div class="form-group row" id="editar">
                            <label for="cod_modulo" id="lblCodigo" >Codigo:</label>
                            <div class="col-md-7">
                                <input type="text" name="cod_modulo" value="<?php echo $cod_modulo ?>" require class="form-control">
                            </div>                            
                        </div>
                        <div class="form-group row" id="editar">
                            <label for="nombre" id="lblNombre" >Nombre:</label>
                            <div class="col-md-7">
                                <input type="text" name="nombre" value="<?php echo $nombre ?>" require class="form-control">
                            </div>                            
                        </div>
                        <div class="form-group row" id="editar">
                            <label for="estado" id="lblEstado" >Estado:</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="estado">
                                    <option value="ACT">ACTIVO</option>
                                    <option value="INA">INACTIVO</option>
                                </select>
                            </div>                           
                        </div>
                        
                        <input type="submit" name="accionModulo" value="<?php echo $accion ?>" class="btn btn-primary">
                        
                    </form>
        
                           

                    </div>
            </div>

                </div>


                </div>

                <!-- right column -->
                <div id="miTabla" class="col-md-7 column pull-right">
                    <div id="cargando"></div>
                </div>
            </div>
        </div>
    </div>




    <!-- scripts -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="js/wysihtml5-0.3.0.js"></script>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.datepicker.js"></script>
    <script src="js/jquery.uniform.min.js"></script>
    <script src="js/select2.min.js"></script>
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>  
    <script src="js/theme.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/personal.js"></script>
    <script type="text/javascript">
        registrarModulo();
    </script>
</body>
</html>