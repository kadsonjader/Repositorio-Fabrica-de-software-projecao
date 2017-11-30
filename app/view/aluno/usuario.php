<?php
ob_start();
require_once('../../controller/CryptSenha.php');
require_once('../../model/Usuario.class.php');
require_once('../../model/dao/UsuarioDAO.php');

$usuDAO = new UsuarioDAO();

if(isset($_POST['btn_senha'])){
	$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$crypt = new CryptSenha();
	if($usuDAO->MudarSenha($usuLogado->getMatricula(), $crypt->criptografar($addinfo['senha1']))){
		header("Location: ?pg=usuario&a=c");
	}else{
		header("Location: ?pg=usuario&a=C");
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
								<span>Senha alterado com sucesso!</span>
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
									<span>Não foi possível alterar senha.</span>
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
                    <div class="col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Mudar Senha</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Matrícula</label>
                                                <input type="text" class="form-control" disabled value="<?php echo $usuLogado->getMatricula(); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" name="senha1" id="senha1" placeholder="Senha" oninvalid="setCustomValidity('Campo Requerido')" 
												onchange="try{setCustomValidity('')}catch(e){}" required>
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirmar Senha</label>
                                                <input type="password" class="form-control" name="senha2" id="senha2" placeholder="Senha" oninvalid="setCustomValidity('Campo Requerido')" 
												onchange="try{setCustomValidity('')}catch(e){}" required>
												<span id="error_senha" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success btn-fill pull-right" name="btn_senha" id="submit_btn_senha">Confirmar</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

