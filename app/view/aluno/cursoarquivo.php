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
                                <div class="clearfix"></div>
                            </div>
							<div class="content">
								<form method="post" action="?pg=arquivo">
                                    <div class="form-group">
										<label for="curso">Curso</label>
										<select class="form-control" name="lista_curso" id="lista_curso" oninvalid="setCustomValidity('Campo Requerido')" 
														onchange="try{setCustomValidity('')}catch(e){}" required>
											<option value="" selected>-- Escolha o Curso -- </option>
											<?php for($i=0; $i < count($listaCurso); $i++){ ?>
											<option value="<?php echo $listaCurso[$i]->getIDCurso(); ?>"><?php echo $listaCurso[$i]->getCurso(); ?></option>
											<?php } ?>
										</select>
									</div>

                                    <button type="submit" class="btn btn-success btn-fill pull-right" name="btn_curso" id="submit_btn_curso">Confirmar</button>
                                    <div class="clearfix"></div>
                                </form>
							</div>
						</div>
					</div>
				</div>
                
				
            </div>
        </div>

