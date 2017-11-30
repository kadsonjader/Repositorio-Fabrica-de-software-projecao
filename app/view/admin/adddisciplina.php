<?php 
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Curso.class.php');
require_once('../../model/Disciplina.class.php');
require_once('../../model/dao/CursoDAO.php');
require_once('../../model/dao/DisciplinaDAO.php');

$curso = new Curso();
$disciplina = new Disciplina();
$cursoDAO = new CursoDAO();
$discDAO = new DisciplinaDAO();

$listaCurso = $cursoDAO->Listar();
$disc = new Disciplina();
if(isset($_GET['id'])){
	$disc = $discDAO->Pesquisar($_GET['id']);
}
if(isset($_POST['btn_cadastrar'])){
	$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$disciplina -> setCurso_idCurso($addinfo['curso']);
	$disciplina -> setDisciplina($addinfo['disciplina']);
	$disciplina -> setStatus('A');
	if($discDAO->Inserir($disciplina)){
		header("Location: ?pg=disciplina&a=c");
	}else{
		header("Location: ?pg=disciplina&a=C");
	}
}else{
	if(isset($_POST['btn_editar'])){
		$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$disciplina -> setIDDisciplina($_GET['id']);
		$disciplina -> setCurso_idCurso($addinfo['curso']);
		$disciplina -> setDisciplina($addinfo['disciplina']);
		$disciplina -> setStatus('A');
		if($discDAO->Alterar($disciplina)){
			header("Location: ?pg=disciplina&a=u");
		}else{
			header("Location: ?pg=disciplina&a=U");
		}
	}
}
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Disciplina</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="">
								<?php if(isset($_GET['a']) && $_GET['a'] == 'e'){?>
									<div class="form-group">
										<label for="curso">Curso</label>
										<select class="form-control" name="curso" id="curso" oninvalid="setCustomValidity('Campo Requerido')" 
														onchange="try{setCustomValidity('')}catch(e){}" required>
											<option value=""></option>
											<?php $idDisciplina = $_GET['id']; ?>
											<?php for($i=0; $i < count($listaCurso); $i++){ ?>
											<?php if($disc->getCurso_idCurso() == $listaCurso[$i]->getIDCurso()){ ?>
											<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>" selected><?php echo $listaCurso[$i]->getCurso(); ?></option>
											<?php }else{ ?>
											<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>"><?php echo $listaCurso[$i]->getCurso(); ?></option>
											<?php } ?>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
											<label for="disciplina">Nome da Disciplina</label>
											<input type="text" class="form-control" name="disciplina" id="disciplina" value="<?php echo $disc->getDisciplina();?>" oninvalid="setCustomValidity('Campo Requerido')" onchange="try{setCustomValidity('')}catch(e){}" required>
									</div>
									<div class="btn-group pull-right" role="group" aria-label="First group">
										<a href="?pg=disciplina"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
										<button type="submit" name="btn_editar" class="btn btn-warning btn-fill pull-right"><i class="pe-7s-plus"></i> Editar</button>
									</div>
                                    <div class="clearfix"></div>
								<?php }else{ ?>
									<div class="form-group">
										<label for="curso">Curso</label>
										<select class="form-control" name="curso" id="curso" oninvalid="setCustomValidity('Campo Requerido')" 
														onchange="try{setCustomValidity('')}catch(e){}" required>
											<option value="" selected></option>
											<?php for($i=0; $i < count($listaCurso); $i++){ ?>
											<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>"><?php echo $listaCurso[$i]->getCurso(); ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="form-group">
											<label for="disciplina">Nome da Disciplina</label>
											<input type="text" class="form-control" name="disciplina" id="disciplina" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
									</div>
									<div class="btn-group pull-right" role="group" aria-label="First group">
										<a href="?pg=disciplina"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
										<button type="submit" name="btn_cadastrar" class="btn btn-success btn-fill pull-right"><i class="pe-7s-plus"></i> Cadastrar</button>
									</div>
                                    <div class="clearfix"></div>
								<?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

