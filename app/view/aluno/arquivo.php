<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Conexao.class.php');
require_once('../../model/Arquivo.class.php');
require_once('../../model/Curso.class.php');
require_once('../../model/Semestre.class.php');
require_once('../../model/Disciplina.class.php');
require_once('../../model/Usuario.class.php');
require_once('../../model/dao/ArquivoDAO.php');
require_once('../../model/dao/CursoDAO.php');
require_once('../../model/dao/SemestreDAO.php');
require_once('../../model/dao/DisciplinaDAO.php');
require_once('../../model/dao/PessoaDAO.php');
require_once('../../model/dao/UsuarioDAO.php');

$arquivo = new Arquivo();
$curso = new Curso();
$semestre = new Semestre();
$disciplina = new Disciplina();
$arqDAO = new ArquivoDAO();
$cursoDAO = new CursoDAO();
$semestreDAO = new SemestreDAO();
$discDAO = new DisciplinaDAO();
$usuDAO = new UsuarioDAO();

$arqArray = $arqDAO->Listar();

$listaCurso = $cursoDAO->Listar();
?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="card">
							<div class="header">
								<h4 class="title">Arquivos</h4>
								<div class="btn-group pull-right" role="group" aria-label="First group">
<?php 
if(isset($_GET['id'])){
?>
									<a href="?pg=arquivo&curso=<?php echo $_GET['id']; ?>"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
<?php 
}else{
	if(!isset($_GET['id'])){
?>
									<a href="?pg=cursoarquivo"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
<?php
	}
}
?>
								</div>
                                <div class="clearfix"></div>
                            </div>
<?php
if(isset($_GET['disc'])){
?>
							<div class="content table-responsive">
								<table id="tabela_arquivo" class="display table table-hover table-striped" cellspacing="0" width="100%">
									<thead>
                                        <th></th>
										<th>Arquivo</th>
										<th>Professor</th>
                                    	<th>Aluno</th>
										<th>Disciplina</th>
										<th>Sem.</th>
										<th>Ano</th>
										<th>Curso</th>
                                    	<th>Data</th>
										<th></th>
                                    </thead>
									<tbody>
<?php
//https://datatables.net/examples/advanced_init/events_live.html
	$cont = 0;
	if(count($arqArray) > 0){
		for($i = 0; $i < count($arqArray); $i++){
			$semestre = $semestreDAO->Pesquisar($arqArray[$i]->getSemestre_idSemestre());
			$disciplina = $discDAO->Pesquisar($semestre->getDisciplina_idDisciplina());
			$curso = $cursoDAO->Pesquisar($disciplina->getCurso_idCurso());
			$tam = strlen($arqArray[$i]->getNome_arq());
			$nome = substr($arqArray[$i]->getNome_arq(), 0, $tam-7);
			$data = explode(" ", $arqArray[$i]->getHora());
			$dt = implode('/', array_reverse(explode('-', $data[0])));
			$professor = $usuDAO->Pesquisar($arqArray[$i]->getUsuario_idUsuario());
			$aluno = $usuDAO->Pesquisar($semestre->getUsuario_idUsuario());
			if($disciplina->getIDDisciplina() == $_GET['disc']){
				$cont++;
?>
										<tr>
                                        	<td style="vertical-align:middle">
												<div class="blockquote-box blockquote-info clearfix">
													<div class="square pull-left">
														<i class="fa fa-file"></i>
													</div>
												</div>
											</td>
											<td><?php echo $nome; ?></td>
											<td><?php echo $professor->getNome_completo(); ?></td>
                                        	<td><?php echo $aluno->getNome_completo(); ?></td>
											<td><?php echo $disciplina->getDisciplina(); ?></td>
											<td><?php echo $semestre->getSemestre(); ?></td>
											<td><?php echo $semestre->getAno(); ?></td>
                                        	<td><?php echo $curso->getCurso(); ?></td>
                                        	<td><?php echo $dt." ".$data[1]; ?></td>
											<td><a href="?pg=download&id=<?php echo $arqArray[$i]->getIDArquivo(); ?>" style="color:black;"><button class="btn btn-xs btn-info btn-fill"><i class="pe-7s-cloud-download"></i></button></a></td>
                                        </tr>
<?php
			}
		} //fim do FOR
		if($cont == 0){
?>
										<tr>
											<td></td>
											<td colspan="9"><strong>Não possui informações existentes.</strong></td>
										</tr>
<?php
		}
	}else{//se contador da lista de arquivos for igual a 0
?>
										<tr>
											<td></td>
											<td colspan="9"><strong>Não possui informações existentes.</strong></td>
										</tr>
<?php
	}
?>
									</tbody>
								</table>
							</div>
<?php 
}else{//se não clicou na pasta da disciplina
	if(isset($_POST['btn_curso'])){
		$cont = 0;
		$listaDisc = $discDAO->Listar();
?>
							<div class="content table-responsive">
								<table id="tabela_disciplina" class="display table table-hover table-striped" cellspacing="0" width="100%">
									<thead>
                                        <th></th>
										<th colspan="25"></th>
										<th></th>
                                    </thead>
									<tbody>
<?php
//https://datatables.net/examples/advanced_init/events_live.html
		if(count($listaDisc) > 0){
			for($i = 0; $i < count($listaDisc); $i++){
				if($listaDisc[$i]->getCurso_idCurso() == $_POST['lista_curso']){
					$cont++;
?>
										<tr>
                                        	<td style="vertical-align:middle">
												<div class="blockquote-box blockquote-info clearfix">
													<div class="square pull-left">
														<i class="fa fa-folder"></i>
													</div>
												</div>
											</td>
											<td><a href="?pg=arquivo&disc=<?php echo $listaDisc[$i]->getIDDisciplina().'&id='.$listaDisc[$i]->getCurso_idCurso(); ?>" style="color:black;"><?php echo $listaDisc[$i]->getDisciplina(); ?></a></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
                                        </tr>
<?php
				}
			} //fim do FOR
			if($cont == 0){
?>
										<tr>
											<td></td>
											<td colspan="25"><strong>Não possui informações existentes.</strong></td>
											<td></td>
										</tr>
<?php
			}
		}else{//se contador da lista de arquivos for igual a 0
?>
										<tr>
											<td></td>
											<td colspan="25"><strong>Não possui informações existentes.</strong></td>
											<td></td>
										</tr>
<?php
		}
?>
									</tbody>
								</table>
							</div>
<?php
	}else{
		if(isset($_GET['curso'])){
			$cont = 0;
			$listaDisc = $discDAO->Listar();
?>
							<div class="content table-responsive">
								<table id="tabela_disciplina" class="display table table-hover table-striped" cellspacing="0" width="100%">
									<thead>
                                        <th></th>
										<th colspan="25"></th>
										<th></th>
                                    </thead>
									<tbody>
<?php
//https://datatables.net/examples/advanced_init/events_live.html
			if(count($listaDisc) > 0){
				for($i = 0; $i < count($listaDisc); $i++){
					if($listaDisc[$i]->getCurso_idCurso() == $_GET['curso']){
						$cont++;
?>
										<tr>
                                        	<td style="vertical-align:middle">
												<div class="blockquote-box blockquote-info clearfix">
													<div class="square pull-left">
														<i class="fa fa-folder"></i>
													</div>
												</div>
											</td>
											<td><a href="?pg=arquivo&disc=<?php echo $listaDisc[$i]->getIDDisciplina().'&id='.$listaDisc[$i]->getCurso_idCurso(); ?>" style="color:black;"><?php echo $listaDisc[$i]->getDisciplina(); ?></a></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
                                        </tr>
<?php
					}
				} //fim do FOR
				if($cont == 0){
?>
										<tr>
											<td></td>
											<td colspan="25"><strong>Não possui informações existentes.</strong></td>
											<td></td>
										</tr>
<?php
				}
			}else{//se contador da lista de arquivos for igual a 0
?>
										<tr>
											<td></td>
											<td colspan="25"><strong>Não possui informações existentes.</strong></td>
											<td></td>
										</tr>
<?php
			}
?>
									</tbody>
								</table>
							</div>
<?php
		}
	}//fim do ELSE
}//fim do ELSE
?>
						</div>
					</div>
				</div>
                
				
            </div>
        </div>

