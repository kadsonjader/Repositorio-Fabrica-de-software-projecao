<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Conexao.class.php');
require_once('../../model/dao/ArquivoDAO.php');
require_once('../../model/dao/CursoDAO.php');
require_once('../../model/dao/SemestreDAO.php');
require_once('../../model/dao/DisciplinaDAO.php');

$arqDAO = new ArquivoDAO();
$cursoDAO = new CursoDAO();
$semestreDAO = new SemestreDAO();
$discDAO = new DisciplinaDAO();

$lista = $arqDAO -> Listar();
$total_registros = $arqDAO -> TotalRegistro();

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
                    <div class="col-xs-12 col-sm-12">
                        <div class="card">
                            <div class="header">
								<h4 class="title">Arquivos</h4>
                                <div class="btn-group pull-right" role="group" aria-label="First group">
									<a href="?pg=enviar"><button type="button" class="btn btn-success btn-fill"><i class="pe-7s-upload"></i> Enviar</button></a>
								</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="content table-responsive">
                                <table id="tabela_arquivo" class="table table-hover table-striped">
                                    <thead>
                                        <th></th>
										<th>Título</th>
										<th>Aluno</th>
                                    	<th>Orientador</th>
										<th>Disciplina</th>
										<th>Sem.</th>
										<th>Ano</th>
										<th>Curso</th>
                                    	<th>Data</th>
                                    </thead>
                                    <tbody>
<?php
if(count($lista) > 0){
	for($i = 0; $i < count($lista); $i++){
		$semestre = $semestreDAO->Pesquisar($lista[$i]->getSemestre_idSemestre());
		$disciplina = $discDAO->Pesquisar($semestre->getDisciplina_idDisciplina());
		$curso = $cursoDAO->Pesquisar($disciplina->getCurso_idCurso());
		$data = explode(" ", $lista[$i]->getHora());
		$dt = implode('/', array_reverse(explode('-', $data[0])));
?>
                                        <tr>
                                        	<td>
												<div class="blockquote-box blockquote-info clearfix">
													<a href="?pg=download&id=<?php echo $lista[$i]->getIDArquivo(); ?>">
													<div class="square pull-left">
														<i class="fa fa-file"></i>
													</div></a>
												</div>
											</td>
											<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $lista[$i]->getTitulo(); ?></a></td>
											<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $lista[$i]->getAluno(); ?></a></td>
                                        	<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $lista[$i]->getOrientador(); ?></a></td>
											<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $disciplina->getDisciplina(); ?></a></td>
											<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $semestre->getSemestre(); ?></a></td>
											<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $semestre->getAno(); ?></a></td>
                                        	<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $curso->getCurso(); ?></a></td>
                                        	<td><a href="?pg=verarquivo&id=<?php echo $lista[$i]->getIDArquivo(); ?>" style="color:black;"><?php echo $dt." ".$data[1]; ?></a></td>
                                        </tr>
<?php
	}//fim do FOR
}else{
?>
										<tr>
											<td></td>
											<td colspan="8"><strong>Não possui informações existentes.</strong></td>
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

