<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/dao/ArquivoDAO.php');
require_once('../../model/dao/CursoDAO.php');
require_once('../../model/dao/UsuarioDAO.php');

$arqDAO = new ArquivoDAO();
$cursoDAO = new CursoDAO();
$usuDAO = new UsuarioDAO();

$total_arq = $arqDAO->TotalRegistro();
$total_curso = $cursoDAO->TotalRegistro();
$listaUsuario = $usuDAO->Listar();
$total_usuario = $usuDAO->TotalRegistro();
$total_prof = 0;
$total_aluno = 0;
for($i = 0; $i < count($listaUsuario); $i++){
	if($listaUsuario[$i]->getPermissao() == '1'){
		$total_prof++;
	}else{
		if($listaUsuario[$i]->getPermissao() == '2'){
			$total_aluno++;
		}
	}
}
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
					<!--div class="col-lg-3 col-md-6">
                        <div class="card ">
							<div class="header" style="background: #FF6249;">
								<i class="pe-7s-user fa-5x pull-left" style="color: white;"></i><br/>
								<h4 class="title pull-right" style="color: white;">Docentes</h4>
								<div class="clearfix"></div><br/>
                            </div>
							<div class="content" style="background: #FFCCC4;">
								<center><h3 style="color: white;"><strong><?php echo $total_prof; ?></strong></h3></center>
							</div>
                        </div>
                    </div>
					
					<!--div class="col-lg-3 col-md-6">
                        <div class="card ">
							<div class="header" style="background: #848400;">
								<i class="pe-7s-users fa-5x pull-left" style="color: white;"></i><br/>
								<h4 class="title pull-right" style="color: white;">Alunos</h4>
								<div class="clearfix"></div><br/>
                            </div>
							<div class="content" style="background: #EDED93;">
								<center><h3 style="color: white;"><strong><?php echo $total_aluno; ?></strong></h3></center>
							</div>
                        </div>
                    </div-->
                    
                    <div class="col-lg-4 col-md-4">
						<div class="card ">
							<div class="header" style="background: #3A82FF;">
								<i class="pe-7s-users fa-5x pull-left" style="color: white;"></i><br/>
								<h4 class="title pull-right" style="color: white;">Usuários</h4>
								<div class="clearfix"></div><br/>
                            </div>
							<div class="content" style="background: #9ABDF9;">
								<center><h3 style="color: white;"><strong><?php echo $total_usuario; ?></strong></h3></center>
							</div>
                        </div>
					</div>
                    <div class="col-lg-4 col-md-4">
                        <div class="card ">
							<div class="header" style="background: MediumSeaGreen;">
								<i class="pe-7s-notebook fa-5x pull-left" style="color: white;"></i><br/>
								<h4 class="title pull-right" style="color: white;">Cursos</h4>
								<div class="clearfix"></div><br/>
                            </div>
							<div class="content" style="background: #8DDD8D;">
								<center><h3 style="color: white;"><strong><?php echo $total_curso; ?></strong></h3></center>
							</div>
                        </div>
                    </div>
					
					<div class="col-lg-4 col-md-4">
                        <div class="card ">
							<div class="header" style="background: #00D6DD;">
								<i class="pe-7s-file fa-5x pull-left" style="color: white;"></i><br/>
								<h4 class="title pull-right" style="color: white;">Arquivos</h4>
								<div class="clearfix"></div><br/>
                            </div>
							<div class="content" style="background: #D7F4F4;">
								<center><h3 style="color: white;"><strong><?php echo $total_arq; ?></strong></h3></center>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



