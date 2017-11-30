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

$listaCurso = $cursoDAO -> Listar();
$listaDisc = $discDAO -> Listar();

if(isset($_POST['btn_enviar'])){
    $addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);	
	$curso = $cursoDAO -> Pesquisar($addinfo['curso']);
	$disciplina = $discDAO -> Pesquisar($addinfo['disciplina']);
	$caminho = '../../../uploads/';
	$arq = $_FILES['arquivo'];
	
	$semestre -> setSemestre($addinfo['semestre']);
	$semestre -> setAno($addinfo['ano']);
	$semestre -> setDisciplina_idDisciplina($disciplina->getIDDisciplina());
	$semestre -> setUsuario_idUsuario($addinfo['id_aluno']);
	
	if($semestreDAO->Inserir($semestre)){	
		$arquivo -> setNome_arq($addinfo['nome_arq'].'_'.str_replace(":", "", date("H:i:s")));
		$arquivo -> setHora(date("Y-m-d H:i:s"));
		$arquivo -> setPalavra_chave($addinfo['palavra']);
		$arquivo -> setCaminho_arq($caminho.$curso->getCurso().'/'.$disciplina->getDisciplina().'/');
		$arquivo -> setSemestre_idSemestre($semestreDAO->UltimoInserido());
		$arquivo -> setUsuario_idUsuario($usuLogado->getIDUsuario());
		
		if($arqDAO->Inserir($arquivo)){
			if(!file_exists($arquivo->getCaminho_arq()) && !is_dir($arquivo->getCaminho_arq())){
				mkdir($arquivo->getCaminho_arq(), 0777);
			}
			move_uploaded_file($arq['tmp_name'], $arquivo->getCaminho_arq().$arquivo->getNome_arq().'.pdf');
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
                            <div class="content">
								<div class="btn-group pull-right" role="group" aria-label="First group">
									<a href="?pg=arquivo"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
									<a href="?pg=enviados"><button type="button" class="btn btn-success btn-fill"><i class="pe-7s-next-2"></i> Enviados</button></a>
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
											<label for="nome_aluno">Nome do Aluno</label>
											<input type="hidden" class="form-control" name="id_aluno" id="id_aluno"/>
											<input type="text" class="form-control" name="nome_aluno" id="nome_aluno" oninvalid="setCustomValidity('Campo Requerido')" 
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
												<?php /* for($i=0; $i < count($listaDisc); $i++){ ?>
												<option data-idCurso="<?php echo $listaDisc[$i]->getCurso_idCurso(); ?>" value="<?php echo $listaDisc[$i]->getIDDisciplina(); ?>"><?php echo $listaDisc[$i]->getDisciplina(); ?></option>
												<?php } */?>
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
											<label for="nome_arq">Nome do Arquivo</label>
											<input type="text" class="form-control" name="nome_arq" id="nome_arq" oninvalid="setCustomValidity('Campo Requerido')" 
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
										<button type="submit" name="btn_enviar" class="btn btn-primary btn-fill pull-right">Enviar</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

