<?php 
ob_start();
session_start();
if(!isset($_SESSION['admin'])){
	header("Location: ../../logout.php");
	exit;
}

require_once('../../model/Usuario.class.php');
require_once('../../model/dao/UsuarioDAO.php');

	if(!isset($_GET['pg'])){
		define('PAGINA', 'Início');
	}else{
		if($_GET['pg'] == 'arquivo' || $_GET['pg'] == 'enviar' || $_GET['pg'] == 'verarquivo'){
			define('PAGINA', 'Arquivo');
		}else{
			if($_GET['pg'] == 'curso' || $_GET['pg'] == 'addcurso'){
				define('PAGINA', 'Curso');
			}else{
				if($_GET['pg'] == 'disciplina' || $_GET['pg'] == 'adddisciplina'){
					define('PAGINA', 'Disciplina');
				}else{
					if ($_GET['pg'] == 'usuario' || $_GET['pg'] == 'addusuario'){
						define('PAGINA', 'Usuário');
					}
				}
			}
		}
	}
	
	$loginDAO = new UsuarioDAO();
	$usuLogado = $loginDAO -> buscarPorLogin($_SESSION['admin']);
?>
<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo PAGINA; ?></title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/blockquote-box.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="assets/img/sidebar-6.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="../admin/" class="simple-text">
                    Repositório
                </a>
            </div>

            <ul class="nav">
                <li class="<?php if(PAGINA == 'Início'){echo 'active';}?>">
                    <a href="../admin/">
                        <i class="fa fa-dashboard"></i>
                        <p>Início</p>
                    </a>
                </li>
                <li class="<?php if(PAGINA == 'Arquivo'){echo 'active';}?>">
                    <a href="?pg=arquivo">
                        <i class="pe-7s-file"></i>
                        <p>Arquivo</p>
                    </a>
                </li>
                <li class="<?php if(PAGINA == 'Curso'){echo 'active';}?>">
                    <a href="?pg=curso">
                        <i class="pe-7s-notebook"></i>
                        <p>Curso</p>
                    </a>
                </li>
				<li class="<?php if(PAGINA == 'Disciplina'){echo 'active';}?>">
                    <a href="?pg=disciplina">
                        <i class="pe-7s-note"></i>
                        <p>Disciplina</p>
                    </a>
                </li>
				<li class="<?php if(PAGINA == 'Usuário'){echo 'active';}?>">
                    <a href="?pg=usuario">
                        <i class="pe-7s-users"></i>
                        <p>Usuários</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?php echo PAGINA; ?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php if(PAGINA == 'Início'){ ?>
                                <i class="fa fa-dashboard"></i>
							<?php }else{ 
									if(PAGINA == 'Arquivo'){ ?>
									<i class="pe-7s-file"></i>
									<?php }else{
											if(PAGINA == 'Curso'){ ?>
											<i class="pe-7s-notebook"></i>
											<?php }else{
													if(PAGINA == 'Disciplina'){?>
													<i class="pe-7s-note"></i>
													<?php }else{
															if(PAGINA == 'Usuário'){ ?>
															<i class="pe-7s-users"></i>
															<?php } ?>
													<?php } ?>
											<?php } ?>
									<?php } ?>
							<?php } ?>
                            </a>
                        </li>
                        <!--li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <!--li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </li-->
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               <?php echo $usuLogado -> getLogin(); ?>
                            </a>
                        </li>
                        <!--li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dropdown
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li-->
                        <li>
                            <a href="../../logout.php">
                                Sair
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>