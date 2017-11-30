<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Conexao.class.php');
require_once('../../model/Usuario.class.php');
require_once('../../model/dao/UsuarioDAO.php');
require_once('../../controller/CryptSenha.php');

$usuario = new Usuario();
$usuDAO = new UsuarioDAO();
$usuEditar = new Usuario();
$crypt = new CryptSenha();

if(isset($_GET['id'])){
	$usuEditar = $usuDAO -> Pesquisar($_GET['id']);
}

if(isset($_POST['btn_cadastrar'])){
	$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	
	$usuario -> setLogin($addinfo['login_user']);
	$usuario -> setSenha($crypt->criptografar($addinfo['senha_user']));
	$usuario -> setPermissao($addinfo['permissao_user']);
	$usuario -> setStatus('A');
	if($usuDAO -> Inserir($usuario)){
		header("Location: ?pg=usuario&a=c");
	}else{
		header("Location: ?pg=usuario&a=C");
	}
}else{
	if(isset($_POST['btn_editar'])){
		$addinfo = filter_input_array(INPUT_POST, FILTER_DEFAULT);
		
		$usuario -> setIDUsuario($_GET['id']);
		$usuario -> setLogin($usuEditar->getLogin());
		$usuario -> setSenha('');
		if($addinfo['senha_user'] != ''){
			$usuario -> setSenha($crypt->criptografar($addinfo['senha_user']));
		}
		$usuario -> setPermissao($addinfo['permissao_user']);
		$usuario -> setStatus('A');
		
		if($usuDAO -> Alterar($usuario)){
			header("Location: ?pg=usuario&a=u");
		}else{
			header("Location: ?pg=usuario&a=U");
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
                                <h4 class="title">Usuários</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="" id="formAddUsuario">
								<?php if(isset($_GET['a']) && $_GET['a'] == 'e'){?>
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                            	<label>Login</label>
                                                <input type="text" class="form-control" name="login_user" id="login_user" 
                                                placeholder="Login" value="<?php echo $usuEditar->getLogin(); ?>" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Permissão</label>
                                                <select class="form-control" name="permissao_user"
                                                oninvalid="setCustomValidity('Campo Requerido')" 
                                                onchange="try{setCustomValidity('')}catch(e){}" required>
                                                <?php if($usuEditar->getPermissao() == '0'){?>
                                                	<option value=""></option>
                                                	<option value="0" selected>Administrador</option>
                                                	<option value="1">Moderador</option>
                                                <?php }else{ ?>
                                                	<option value=""></option>
                                                	<option value="0">Administrador</option>
                                                	<option value="1" selected>Moderador</option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" name="senha_user" id="senha_user" placeholder="Senha"
                                                oninvalid="setCustomValidity('Campo Requerido')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                                <span id="error_senha" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Confirmar Senha</label>
                                                <input type="password" class="form-control" name="senha_user2" id="senha_user2" placeholder="Senha"
                                                oninvalid="setCustomValidity('Campo Requerido')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                                <span id="error_senha2" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-group pull-right" role="group" aria-label="First group">
										<a href="?pg=usuario"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
										<button type="submit" name="btn_editar" id="submit_btn_editar" class="btn btn-warning btn-fill pull-right"><i class="pe-7s-note"></i> Editar</button>
									</div>
                                    <div class="clearfix"></div>
								<?php }else{ ?>
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Login</label>
                                                <input type="text" class="form-control" name="login_user" id="login_user" placeholder="Login" 
                                                oninvalid="setCustomValidity('Campo Requerido')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Permissão</label>
                                                <select class="form-control" name="permissao_user" oninvalid="setCustomValidity('Campo Requerido')" 
                                                onchange="try{setCustomValidity('')}catch(e){}" required>
                                                	<option value=""></option>
                                                	<option value="0">Administrador</option>
                                                	<option value="1">Moderador</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Senha</label>
                                                <input type="password" class="form-control" name="senha_user" id="senha_user" placeholder="Senha"
                                                oninvalid="setCustomValidity('Campo Requerido')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="btn-group pull-right" role="group" aria-label="First group">
										<a href="?pg=usuario"><button type="button" class="btn btn-primary btn-fill"><i class="pe-7s-back"></i> Voltar</button></a>
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

