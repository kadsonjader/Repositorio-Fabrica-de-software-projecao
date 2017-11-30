<?php 
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Curso.class.php');
require_once('../../model/dao/CursoDAO.php');
require_once('../../model/dao/DisciplinaDAO.php');

$curso = new Curso();
$cursoDAO = new CursoDAO();
$discDAO = new DisciplinaDAO();
$listaCurso = $cursoDAO->Listar();
$listaDisc = $discDAO->Listar();

if(isset($_GET['id'])){
    $cont = 0;
    for($i = 0; $i < count($listaDisc); $i++){
        if($listaDisc[$i]->getCurso_idCurso() == $_GET['id']){
        	$cont++;
        }
    }
    if($cont == 0){
        if($cursoDAO->Deletar($_GET['id'])){
            header("Location: ?pg=curso&a=d");
        }else{
            header("Location: ?pg=curso&a=D");
        }
    }else{
        header("Location: ?pg=curso&a=N");
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
        case 'N':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Não foi possível excluir. Existem registros associados.</span>
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
								<h4 class="title">Cursos</h4>
                                <div class="btn-group pull-right" role="group" aria-label="First group">
									<a href="?pg=addcurso"><button type="button" class="btn btn-success btn-fill"><i class="pe-7s-plus"></i> Cadastrar</button></a>
								</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="content table-responsive">
                                <table id="tabela_curso" class="table table-hover table-striped">
                                    <thead>
                                        <th>#</th>
										<th></th>
										<th>Nome</th>
										<th><center>Ação</center></th>
                                    </thead>
                                    <tbody>
<?php 
if(count($listaCurso) > 0){
	for($i = 0; $i < count($listaCurso); $i++){
?>
                                        <tr>
											<td><?php echo $i+1; ?></td>
                                        	<td>
												<div class="blockquote-box blockquote-primary clearfix">
													<div class="square pull-left">
														<i class="pe-7s-notebook"></i>
													</div>
												</div>
											</td>
											<td><?php echo $listaCurso[$i]->getCurso(); ?></td>
											<td>
												<div class="btn-group pull-right" role="group" aria-label="First group">
													<a href="?pg=addcurso&a=e&id=<?php echo $listaCurso[$i]->getIDCurso(); ?>"><button type="button" class="btn btn-warning btn-fill">
														<i class="pe-7s-note"></i> Editar</button>
													</a>
													<a href="?pg=curso&id=<?php echo $listaCurso[$i]->getIDCurso(); ?>"><button type="button" class="btn btn-danger btn-fill">
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
											<td></td>
											<td colspan="3"><strong>Não possui informações existentes.</strong></td>
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

