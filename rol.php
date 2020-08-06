<?php 
    include './services/Servicios.php';
    $rol = new Servicios();
    //$modulo = new Servicios();
    $nombre_rol="";
    $cod_modulo = "";
    $estado="";
    $url_principal="";
    $nombre="";
    $descripcion="";
    $accion = "Agregar";
    
    if(isset($_POST['accionRol']) && ($_POST['accionRol']=='Agregar'))
    {
        $rol->insertarModuloPorRol($_POST['rol'],$_POST['modulo']);
    }
    
     else if(isset($_GET['delete']))
    {
        $rol->eliminarrol($_GET['delete'],$_GET['modulo']);
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
                MODULOS POR ROL
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
                       
            <!--INICIO TABLA-->
    
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>ROL</h3>
                <form action="" method="get">
                    <select class="form-control" name="rol" id="selectrol">
                           <option value="" disabled="" selected="">Selecciona un Módulo</option>
                                
                           <?php 
                                $result2 = $rol->mostrarRoles();
                                foreach($result2 as $opciones):
                                    $nombre_rol=$_GET["rol"];
                            ?>
                        <option value="<?php echo $opciones['COD_ROL'] ?>"><?php echo $opciones['NOMBRE'] ?></option>
                            <?php endforeach ?>
                    </select><br>
                    <input type="submit" name="cod_rol" value="Aceptar" class="btn btn-primary">
                </form>
                <script type="text/javascript">
                        document.getElementById('selectrol').value = "<?php echo $_GET["rol"] ?>";
                </script>
                
               
            </div><br>
        
            <div class="col-lg-12"><br>
            <form action="rol.php" name="forma" method="post" id="forma">
                <div class="table-responsive">
                    <table id="tablaRoles" class="table table-striped table-bordered table-condensed" style="width: 100%;">
                        <thead class="text-center">
                            <tr>
                                <th>Modulos</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = $rol->mostrarModulosPorRol($nombre_rol);     
                                if ($result->num_rows > 0) 
                                {
                                    while($row = $result->fetch_assoc()) 
                                    { 
                            ?>
                            
                            <input type="hidden" name="cod_modulo" value="<?php echo $row ["COD_MODULO"];?>">
                            <input type="hidden" name="nombre_rol" value="<?php echo $row ["COD_ROL"];?>">
                           



                            <tr>
                                <td><?php echo $row ["NOMBRE"];?></td>
                              
                                <td>
                                    <div class="text-center">
                                        <div class="btn-group">
                                        <a href="rol.php?delete=<?php echo $row ["COD_ROL"];?>&modulo=<?php echo $row ["COD_MODULO"];?>" type="button" class="btn btn-danger">Eliminar</a>   
                                        
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
        <div class="card">
            <h2 class="text-center text-light">Añadir Rol</h2>
            </div>
        </div>
        <div>
            <div class="card-body">
                <!--<form action="index.php" name="forma" method="post" id="forma">-->
                    <div class="form-group row" id="editar">
                        <label for="url_principal" id="lblCodigo" class="col-sm-2 col-form-label">Rol</label>
                        <div class="col-sm-4">
                            <input type="text" name="rol" value="<?php echo $nombre_rol ?>" require class="form-control">
                        </div>
                    </div>
                    <div class="form-group row" id="editar">
                        <label for="url_principal" id="lblCodigo" class="col-sm-2 col-form-label">Módulo</label>
                        <div class="col-sm-4">
                            <select class="form-control" name="modulo" id="selectmodulo">
                                <option value="" disabled="" selected="">Selecciona un Módulo</option>
                                    <?php 
                                        $result3 = $rol->mostrarModulos();
                                        foreach($result3 as $opciones):
                                    ?>
                                <option value="<?php echo $opciones['COD_MODULO'] ?>"><?php echo $opciones['NOMBRE'] ?></option>
                                    <?php endforeach ?>
                            </select>    
                        </div>
                        
                    </div>
                    <input type="submit" name="accionRol" value="<?php echo $accion ?>" class="btn btn-primary">
                </form>
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