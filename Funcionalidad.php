<?php 
    include './services/Servicios.php';
    $funcionalidad = new Servicios();
    $cod_modulo = "";
    $estado="";
    $url_principal="";
    $nombre="";
    $descripcion="";
    $accion = "Agregar";
    $mensaje="Añadir Nueva Funcionalidad";
                       
    if(isset($_POST['accionInfraestructura']) && ($_POST['accionInfraestructura']=='Agregar'))
    {
        $funcionalidad->insertarFuncionalidad($_POST['url_principal'],$_POST['nombre'],
                                       $_POST['descripcion'],$_POST['cod_modulo_ingresar']);
    }
    else if(isset($_POST["accionInfraestructura"]) && ($_POST["accionInfraestructura"]=="Modificar"))
    {
        $funcionalidad->modificarFuncionalidad($_POST['cod_funcionalidad'],$_POST['url_principal'],$_POST['nombre'],$_POST['descripcion']);
    }
    else if(isset($_GET["update"]))
    {
        $result = $funcionalidad->encontrarFuncionalidad($_GET['update'],$_GET['modulo']);
        if($result!=null)
        {
            $url_principal = $result['URL_PRINCIPAL'];
            $nombre = $result['NOMBRE'];
            $descripcion = $result['DESCRIPCION'];
            $accion="Modificar";
            $mensaje="Modificar datos de la funcionalidad";
        }
    }
    else if(isset($_GET['delete']))
    {
        $funcionalidad->eliminarFuncionalidad($_GET['delete']);
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
            <a class="navbar-brand" href="funcionalidades.php">
                FUNCIONALIDAD
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
                    <li><a href="porrol.php" >Por Rol</a></li>                    
                </ul>
                <ul class="submenu">
                    <li><a href="derol.php" >De Rol</a></li>                    
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




    
    <!--INICIO TABLA-->
    <div class="container">
        <div class="row">
            <div class="col">
                
                
                <form action="" method="get">
                    <label for="estado" id="lblEstado" >Seleccione un modulo:</label>
                    <select class="form-control" name="modulo" id="selectmodulo">
                            <?php 
                                $result2 = $funcionalidad->mostrarModulos();
                                foreach($result2 as $opciones):
                            ?>
                        <option value="<?php echo $opciones['COD_MODULO'] ?>"><?php echo $opciones['NOMBRE'] ?>
                        </option>
                            <?php endforeach ?>
                    </select><br>
                    <input type="submit" name="cod_modulo" value="Aceptar" class="btn btn-primary">
                </form>
                <script type="text/javascript">
                        document.getElementById('selectmodulo').value = "<?php echo $_GET["modulo"] ?>";
                </script>
                
                <?php
                    $nombre_modulo=$_GET["modulo"];
                ?>
            <form action="funcionalidades.php" name="forma" method="post">
                <input type="hidden" name="nombre_modulo" value="<?php echo $nombre_modulo ?>">
            </div><br><br><br>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table id="tablaProductos" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                        <thead class="text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>URL Principal</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = $funcionalidad->mostrarFuncionalidades($nombre_modulo);     
                                if ($result->num_rows > 0) 
                                {
                                    while($row = $result->fetch_assoc()) 
                                    { 
                            ?>
                            <input type="hidden" name="cod_funcionalidad" value="<?php echo $row ["COD_FUNCIONALIDAD"];?>">
                            <input type="hidden" name="cod_modulo" value="<?php echo $row ["COD_MODULO"];?>">
                            <tr>
                                <td><?php echo $row ["NOMBRE"];?></td>
                                <td><?php echo $row ["URL_PRINCIPAL"];?></td>
                                <td><?php echo $row ["DESCRIPCION"];?></td>
                                <td>
                                    <div class="text-center">
                                        <div class="btn-group">
                                            <a href="funcionalidades.php?update=<?php echo $row ["COD_FUNCIONALIDAD"];?>&modulo=<?php echo $row ["COD_MODULO"];?>" type="button" class="btn btn-primary">Editar</a>
                                            <a href="funcionalidades.php?delete=<?php echo $row ["COD_FUNCIONALIDAD"];?>&modulo=<?php echo $row ["COD_MODULO"];?>" type="button" class="btn btn-danger">Eliminar</a>   
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
    </div><br>
    <!--FIN TABLA-->
    <div class="container">
        
        <div>
            <div class="card-body">
                <!--<form action="funcionalidades.php" name="forma" method="post" id="forma">-->
                    <h3 class="text-center text-light"><?php echo $mensaje ?></h3>
                     
                    <input type="hidden" name="cod_modulo_ingresar" value="<?php echo $nombre_modulo ?>">
                    <div class="form-group row" id="editar">
                        <label for="url_principal" id="lblCodigo" class="col-sm-2 col-form-label">URL</label>
                        <div class="col-sm-4">
                            <input type="text" name="url_principal" value="<?php echo $url_principal ?>" require class="form-control">
                        </div>
                    </div>
                    <div class="form-group row" id="editar">
                        <label for="nombre" id="lblNombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-4">
                            <input type="text" name="nombre" value="<?php echo $nombre ?>" require class="form-control">
                        </div>
                    </div>
                    <div class="form-group row" id="editar">
                        <label for="descripcion" id="lbldescripcion" class="col-sm-2 col-form-label">descripcion</label>
                        <div class="col-sm-4">
                            <input type="text" name="descripcion" value="<?php echo $descripcion ?>" require class="form-control">
                        </div>
                    </div>
                    <input type="submit" name="accionInfraestructura" value="<?php echo $accion ?>" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>




            <div class="row form-wrapper">
                <!-- left column -->



        <!-- end upper main stats -->

        <div id="pad-wrapper" class="form-page">

            <!-- statistics chart built with jQuery Flot -->
            <div class="row form-wrapper">
                <!-- left column -->
<br>






                    <div id="mensaje" class="col-md-6">
                        
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