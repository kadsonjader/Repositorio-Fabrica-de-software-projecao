<?php 
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/dao/ArquivoDAO.php');
require_once('../../model/dao/CursoDAO.php');

$arqDAO = new ArquivoDAO();
$cursoDAO = new CursoDAO();

$total_arq = $arqDAO->TotalRegistro();

$total_curso = $cursoDAO->TotalRegistro();
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
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
					
					<div class="col-lg-6 col-md-6">
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



