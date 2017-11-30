<?php 
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Curso.class.php');
require_once('../../model/dao/CursoDAO.php');

$curso = new Curso();
$cursoDAO = new CursoDAO();
$nome_curso = '';
if(isset($_GET['id'])){
	$nome_curso = $cursoDAO->Pesquisar($_GET['id'])->getCurso();
}

if(isset($_POST['btn_cadastrar'])){
	$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$curso -> setCurso($addinfo['curso']);
	if($cursoDAO->Inserir($curso)){
		header("Location: ?pg=curso&a=c");
	}else{
		header("Location: ?pg=curso&a=C");
	}
}else{
	if(isset($_POST['btn_editar'])){
		$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		$curso -> setIDCurso($_GET['id']);
		$curso -> setCurso($addinfo['curso']);
		if($cursoDAO->Alterar($curso)){
			header("Location: ?pg=curso&a=u");
		}else{
			header("Location: ?pg=curso&a=U");
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
                                <h4 class="title">Curso</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="">
								<?php if(isset($_GET['a']) && $_GET['a'] == 'e'){?>
									<div class="form-group">
											<label for="curso">Nome do Curso</label>
											<input type="text" class="form-control" name="curso" id="curso" value="<?php echo $nome_curso; ?>" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
									</div>
									<div class="btn-group pull-right" role="group" aria-label="First group">
										<a href="?pg=curso"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
										<button type="submit" name="btn_editar" class="btn btn-warning btn-fill pull-right"><i class="pe-7s-note"></i> Editar</button>
									</div>
                                    <div class="clearfix"></div>
								<?php }else{ ?>
									<div class="form-group">
											<label for="curso">Nome do Curso</label>
											<input type="text" class="form-control" name="curso" id="curso" oninvalid="setCustomValidity('Campo Requerido')" 
															onchange="try{setCustomValidity('')}catch(e){}" required>
									</div>
									<div class="btn-group pull-right" role="group" aria-label="First group">
										<a href="?pg=curso"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
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
<?php //ob_end_flush(); ?>