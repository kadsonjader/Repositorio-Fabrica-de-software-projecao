<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Disciplina.class.php');
require_once('../../model/dao/DisciplinaDAO.php');
require_once('../../model/dao/SemestreDAO.php');

$disciplina = new Disciplina();
$discDAO = new DisciplinaDAO();
$semDAO = new SemestreDAO();
$listaDisciplina = $discDAO->Listar();
$listaSemestre = $semDAO->Listar();

if(isset($_GET['id'])){
	$cont = 0;
	for($i = 0; $i < count($listaSemestre); $i++){
		if($listaSemestre[$i]->getDisciplina_idDisciplina() == $_GET['id']){
			$cont++;
		}
	}
	if($cont == 0){
		if($discDAO->Deletar($_GET['id'])){
			header("Location: ?pg=disciplina&a=d");
		}else{
			header("Location: ?pg=disciplina&a=D");
		}
	}else{
		header("Location: ?pg=disciplina&a=D");
	}
}
?>
        <div class="content">
            <div class="container-fluid">
<?php 
if(isset($_GET['a'])){
    switch ($_GET['a']){
        case 'c':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-success" >
								<button type="button" aria-hidden="true" data-dismiss="alert" class="btn close">×</button>
								<span>Cadastrado com sucesso!</span>
							</div>
						</div>	
					</div>
				</div>
<?php
            break;
        case 'u':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-success">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Salvo com sucesso!</span>
							</div>
                        </div>
					</div>
				</div>
<?php
            break;
        case 'd':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-success">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Excluído com sucesso!</span>
							</div>
                        </div>
					</div>
				</div>
<?php
            break;
        case 'C':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Não foi possível cadastrar.</span>
							</div>
						</div>
					</div>
				</div>
<?php
            break;
        case 'U':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Não foi possível alterar.</span>
							</div>
						</div>
					</div>
				</div>
<?php
            break;
        case 'D':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Não foi possível excluir.</span>
							</div>
						</div>
					</div>
				</div>
<?php
            break;
    }
}
?>
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
								<h4 class="title">Disciplinas</h4>
                                <div class="btn-group pull-right" role="group" aria-label="First group">
									<a href="?pg=adddisciplina"><button type="button" class="btn btn-success btn-fill"><i class="pe-7s-plus"></i> Cadastrar</button></a>
								</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="content table-responsive">
                                <table id="tabela_disciplina" class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
										<th></th>
										<th>Nome</th>
										<th>Curso</th>
										<th><center>Ação</center></th>
                                    </thead>
                                    <tbody>
<?php 
if(count($listaDisciplina) > 0){
	for($i = 0; $i < count($listaDisciplina); $i++){
?>
                                        <tr>
											<td><?php echo $i+1; ?></td>
                                        	<td>
												<div class="blockquote-box blockquote-primary clearfix">
													<div class="square pull-left">
														<i class="pe-7s-note"></i>
													</div>
												</div>
											</td>
											<td><?php echo $listaDisciplina[$i]->getDisciplina(); ?></td>
											<td><?php echo $listaDisciplina[$i]->getCurso(); ?></td>
											<td>
												<div class="btn-group pull-right" role="group" aria-label="First group">
													<a href="?pg=adddisciplina&a=e&id=<?php echo $listaDisciplina[$i]->getIDDisciplina(); ?>"><button type="button" class="btn btn-warning btn-fill">
														<i class="pe-7s-note"></i> Editar</button>
													</a>
													<a href="?pg=disciplina&id=<?php echo $listaDisciplina[$i]->getIDDisciplina(); ?>"><button type="button" class="btn btn-danger btn-fill">
														<i class="pe-7s-close"></i> Deletar</button>
													</a>
												</div>
											</td>
                                        </tr>
<?php 
	}
}else{
?>
										<tr>
											<td colspan="5"><strong>Não possui informações existentes.</strong></td>
										</tr>
<?php 
}
?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
				
            </div>
        </div>

