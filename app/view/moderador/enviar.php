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

$listaCurso = $cursoDAO -> Listar();

function Renomear(string $string){
	$string = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$string);
	$string = str_replace(' ', '_', $string);
	$string = str_replace('ç', 'c', $string);
	$string = str_replace('Ç', 'C', $string);
	return $string;
}

if(isset($_POST['btn_enviar'])){
	
	$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);	
	$curso = $cursoDAO -> Pesquisar($addinfo['curso']);
	$disciplina = $discDAO -> Pesquisar($addinfo['disciplina']);
	$caminho = '../../../uploads/';
	$arq = $_FILES['arquivo'];
	
	$semestre -> setSemestre($addinfo['semestre']);
	$semestre -> setAno($addinfo['ano']);
	$semestre -> setDisciplina_idDisciplina($disciplina->getIDDisciplina());
	
	if($semestreDAO->Inserir($semestre)){
		$nome_arq = md5(uniqid(rand(), true));
		$nome_curso = Renomear($curso->getCurso());
		$nome_disc = Renomear($disciplina->getDisciplina());
		$arquivo -> setTitulo($addinfo['titulo']);
		$arquivo -> setAluno($addinfo['nome_aluno']);
		$arquivo -> setOrientador($addinfo['nome_orientador']);
		$arquivo -> setHora(date("Y-m-d H:i:s"));
		$arquivo -> setPalavra_chave($addinfo['palavra']);
		$arquivo -> setCaminho_arq($caminho.$nome_curso.'/'.$nome_disc.'/'.$nome_arq.'.pdf');
		$arquivo -> setSemestre_idSemestre($semestreDAO->UltimoInserido());
		$arquivo -> setUsuario_idUsuario($usuLogado->getIDUsuario());
		
		if($arqDAO->Inserir($arquivo)){
			if(!file_exists($caminho.$nome_curso) && !is_dir($caminho.$nome_curso)){
				mkdir($caminho.$nome_curso, 0777);
			}
			if(!file_exists($caminho.$nome_curso.'/'.$nome_disc) && !is_dir($caminho.$nome_curso.'/'.$nome_disc)){
					mkdir($caminho.$nome_curso.'/'.$nome_disc, 0777);
			}
			move_uploaded_file($arq['tmp_name'], $arquivo->getCaminho_arq());
			header("Location: ?pg=arquivo&a=c");
		}else{
			header("Location: ?pg=arquivo&a=C");
		}
	}else{
		header("Location: ?pg=arquivo&a=C");
	}
	
}

?>

        <div class="content">
            <div class="container-fluid">			
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Arquivo</h4>
                            </div>
                            <div class="content">
                                <form name="upload" method="post" action="" enctype="multipart/form-data">
									<div class="form-group">
											<label for="nome_aluno">Título</label>
											<input type="text" class="form-control" name="titulo" id="titulo" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="nome_aluno">Nome do Aluno</label>
											<input type="text" class="form-control" name="nome_aluno" id="nome_aluno" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="nome_orientador">Nome do Orientador</label>
											<input type="text" class="form-control" name="nome_orientador" id="nome_orientador" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="curso">Curso</label>
											<select class="form-control" name="curso" id="cursodisciplina" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
												<option value="" selected> -- Escolha o Curso --</option>
												<?php for($i=0; $i < count($listaCurso); $i++){ ?>
												<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>"><?php echo $listaCurso[$i]->getCurso(); ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<label for="disciplina">Disciplina</label>
											<select class="form-control" name="disciplina" id="disciplinacurso" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
												<option value="" selected> -- Escolha a Disciplina --</option>
											</select>
										</div>
										<div class="form-group">
											<label for="semestre">Semestre</label>
											<input type="number" class="form-control" name="semestre" id="semestre" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="ano">Ano</label>
											<input type="number" class="form-control" name="ano" id="ano" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<label for="palavra">Palavra Chave</label>
											<input type="text" class="form-control" name="palavra" id="palavra" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
										</div>
										<div class="form-group">
											<input type="file" class="form-control btn btn-primary btn-fill" name="arquivo" id="arquivo" aria-describedby="fileHelp" accept="application/pdf"
											oninvalid="setCustomValidity('Selecione um Arquivo')" onchange="try{setCustomValidity('')}catch(e){}" required>
											<small id="fileHelp" class="form-text text-muted">Selecione apenas arquivos no formato PDF. exemplo.pdf</small>
										</div>
										
										<div class="btn-group pull-right" role="group" aria-label="First group">
											<a href="?pg=arquivo"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
											<button type="submit" name="btn_enviar" class="btn btn-success btn-fill pull-right"><i class="pe-7s-plus"></i> Enviar</button>
										</div>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

