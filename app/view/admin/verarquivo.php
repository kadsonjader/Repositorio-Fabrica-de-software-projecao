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

$listaCurso = $cursoDAO -> Listar();
$listaDisc = $discDAO -> Listar();
$arqBanco = $arqDAO->Pesquisar($_GET['id']);
$semBanco = $semestreDAO->Pesquisar($arqBanco->getSemestre_idSemestre());
$discBanco = $discDAO->Pesquisar($semBanco->getDisciplina_idDisciplina());

function Renomear(string $string){
    $string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
    $string = str_replace(' ', '_', $string);
    $string = str_replace('ç', 'c', $string);
    $string = str_replace('Ç', 'C', $string);
    return $string;
}

if(isset($_POST['btn_editar'])){
    $addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);	
	$curso = $cursoDAO -> Pesquisar($addinfo['curso']);
	$disciplina = $discDAO -> Pesquisar($addinfo['disciplina']);
	$caminho = '../../../uploads/';
	$arq = '';
	if($_FILES['arquivo']){
		$arq = $_FILES['arquivo'];
	}
	
	$arquivo -> setIDArquivo($_GET['id']);
	$arquivo -> setTitulo($addinfo['titulo']);
	$arquivo -> setAluno($addinfo['nome_aluno']);
	$arquivo -> setOrientador($addinfo['nome_orientador']);
	$arquivo -> setHora($arqBanco->getHora());
	$arquivo -> setPalavra_chave($addinfo['palavra']);
	$arquivo -> setCaminho_arq($arqBanco->getCaminho_arq());
	$arquivo -> setSemestre_idSemestre($arqBanco->getSemestre_idSemestre());
	$arquivo -> setUsuario_idUsuario($usuLogado->getIDUsuario());
	if($arq != ''){
		$arquivo -> setHora(date("Y-m-d H:i:s"));
		$nome_arq = md5(uniqid(rand(), true));
		$nome_curso = Renomear($curso->getCurso());
		$nome_disc = Renomear($disciplina->getDisciplina());
		$arquivo -> setCaminho_arq($caminho.$nome_curso.'/'.$nome_disc.'/'.$nome_arq.'.pdf');
		unlink($arquivo->getCaminho_arq());
		move_uploaded_file($arq['tmp_name'], $arquivo->getCaminho_arq());
	}
	
	if($arqDAO->Alterar($arquivo)){
		$semestre -> setIDSemestre($arqBanco->getSemestre_idSemestre());
		$semestre -> setSemestre($addinfo['semestre']);
		$semestre -> setAno($addinfo['ano']);
		$semestre -> setDisciplina_idDisciplina($addinfo['disciplina']);
		
		if($semestreDAO->Alterar($semestre)){	
			header("Location: ?pg=arquivo&a=u");
		}
	}else{
		header("Location: ?pg=arquivo&a=U");
	}
}else{
	if(isset($_GET['a']) && $_GET['a'] == 'd'){
		$a = $arqDAO->Pesquisar($_GET['id']);
		if($arqDAO->Deletar($_GET['id'])){
			if($semestreDAO->Deletar($a->getSemestre_idSemestre())){
				header("Location: ?pg=arquivo&a=d");
			}else{
				header("Location: ?pg=arquivo&a=D");
			}
		}
	}
}

?>

        <div class="content">
            <div class="container-fluid">
				<div class="row">
					<div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                        <div class="card">
                            <div class="content">
								<div class="btn-group pull-right" role="group" aria-label="First group">
									<a href="?pg=arquivo"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
								</div>
                                <div class="clearfix"></div>
                            </div>
						</div>
					</div>
				</div>
				
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Arquivo</h4>
                            </div>
                            <div class="content">
                                <form name="upload" method="post" action="" enctype="multipart/form-data">
                                	
                                	<div class="form-group">
											<label for="titulo">Título</label>
											<input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo $arqBanco->getTitulo(); ?>" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="nome_aluno">Nome do Aluno</label>
											<input type="text" class="form-control" name="nome_aluno" id="nome_aluno" value="<?php echo $arqBanco->getAluno(); ?>" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="nome_orientador">Nome do Orientador</label>
											<input type="text" class="form-control" name="nome_orientador" id="nome_orientador" value="<?php echo $arqBanco->getOrientador(); ?>" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="curso">Curso</label>
											<select class="form-control" name="curso" id="cursodisciplinas" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
												<option value=""> -- Escolha o Curso --</option>
												<?php for($i=0; $i < count($listaCurso); $i++){ ?>
												<?php if($discBanco->getCurso_idCurso() == $listaCurso[$i]->getIDCurso()){?>
												<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>" selected><?php echo $listaCurso[$i]->getCurso(); ?></option>
												<?php }else{ ?>
												<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>"><?php echo $listaCurso[$i]->getCurso(); ?></option>
												<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label for="disciplina">Disciplina</label>
											<select class="form-control" name="disciplina" id="disciplinacurso" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
												<option value=""> -- Escolha a Disciplina --</option>
												<?php for($i=0; $i < count($listaDisc); $i++){ ?>
												<?php if($discBanco->getIDDisciplina() == $listaDisc[$i]->getIDDisciplina()){?>
												<option data-idCurso="<?php echo $listaDisc[$i]->getCurso_idCurso(); ?>" value="<?php echo $listaDisc[$i]->getIDDisciplina(); ?>" selected><?php echo $listaDisc[$i]->getDisciplina(); ?></option>
												<?php }else{ ?>
												<?php if($discBanco->getCurso_idCurso() == $listaDisc[$i]->getCurso_idCurso()){ ?>
												<option data-idCurso="<?php echo $listaDisc[$i]->getCurso_idCurso(); ?>" value="<?php echo $listaDisc[$i]->getIDDisciplina(); ?>"><?php echo $listaDisc[$i]->getDisciplina(); ?></option>
												<?php } ?>
												<?php } ?>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label for="semestre">Semestre</label>
											<input type="number" class="form-control" name="semestre" id="semestre" value="<?php echo $semBanco->getSemestre(); ?>"  oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="ano">Ano</label>
											<input type="number" class="form-control" name="ano" id="ano" value="<?php echo $semBanco->getAno(); ?>" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="palavra">Palavra Chave</label>
											<input type="text" class="form-control" name="palavra" id="palavra" value="<?php echo $arqBanco->getPalavra_chave(); ?>" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<input type="file" class="form-control btn btn-primary btn-fill" name="arquivo" id="arquivo" aria-describedby="fileHelp" accept="application/pdf">
											<small id="fileHelp" class="form-text text-muted">Selecione apenas arquivos no formato PDF. exemplo.pdf</small>
										</div>
										<div class="btn-group pull-right" role="group" aria-label="First group">
											<a href="?pg=arquivo"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
											<a href="?pg=download&id=<?php echo $_GET['id']; ?>"><button type="button" class="btn btn-success btn-fill"><i class="pe-7s-look"></i> Ver</button></a>
											<a href=""><button type="submit" name="btn_editar" class="btn btn-warning btn-fill"><i class="pe-7s-note"></i> Editar</button></a>
											<a href="?pg=verarquivo&a=d&id=<?php echo $_GET['id']; ?>"><button type="button" class="btn btn-danger btn-fill"><i class="pe-7s-close"></i> Deletar</button></a>
										</div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

