<?php
ob_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../../model/Conexao.class.php');
require_once('../../model/Usuario.class.php');
require_once('../../model/dao/UsuarioDAO.php');

$usuario = new Usuario();
$usuDAO = new UsuarioDAO();

if(isset($_GET['a']) && $_GET['a'] == 'd'){
	if($usuDAO -> Deletar($_GET['id'])){
		header("Location: ?pg=usuario&a=d");
	}else{
		header("Location: ?pg=usuario&a=D");
	}
}else{
    if(isset($_GET['a']) && $_GET['a'] == 's'){
        $pesq = $usuDAO -> Pesquisar($_GET['id']);
        $pesq -> setStatus('D');
        if($usuDAO -> Alterar($pesq)){
            header("Location: ?pg=usuario&a=s");
        }else{
            header("Location: ?pg=usuario&a=S");
        }
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
        case 's':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-success">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Status modificado com sucesso!</span>
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
        case 'S':
?>
				<div class="row">
					<div class="col-md-12 col-sm-12">
                        <div class="content">
							<div class="alert alert-danger">
								<button type="button" aria-hidden="true" data-dismiss="alert" class="close">×</button>
									<span>Não foi possível modificar status.</span>
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
                    <div class="col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Usuários</h4>
								<div class="btn-group pull-right" role="group" aria-label="First group">
									<a href="?pg=addusuario"><button type="button" class="btn btn-success btn-fill"><i class="pe-7s-plus"></i> Cadastrar</button></a>
								</div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="content table-responsive">
                                <table id="tabela_usuario" class="display table table-hover table-striped" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>#</th>
											<th>Login</th>
											<th>Permissão</th>
											<th>Status</th>
											<th><span class="pull-right">Ação</span></th>
										</tr>
									</thead>
									<tbody>
<?php 
$listaUsuarios = $usuDAO -> Listar();
$cont = 0;
for($i = 0; $i < count($listaUsuarios); $i++){
		$cont++;
?>
										<tr>
											<td><?php echo $cont; ?></td>
											<td><?php echo $listaUsuarios[$i]->getLogin(); ?></td>
											<td><?php if($listaUsuarios[$i]->getPermissao() == '0'){echo 'Administrador';}else{echo 'Moderador';} ?></td>
											<td><?php if($listaUsuarios[$i]->getStatus() == 'A'){ ?>
												<a href="?pg=usuario&a&id=<?php echo $listaUsuarios[$i]->getIDUsuario(); ?>">
													<button type="button" class="btn btn-success btn-fill">Ativo</button>
												</a>
												<?php }else{?>
												<a href="?pg=usuario&a=s&id=<?php echo $listaUsuarios[$i]->getIDUsuario(); ?>">
													<button type="button" class="btn btn-danger btn-fill">Inativo</button>
												</a>
												<?php }?>
											</td>
											<td>
												<div class="btn-group pull-right" role="group" aria-label="First group">
													<a href="?pg=addusuario&a=e&id=<?php echo $listaUsuarios[$i]->getIDUsuario(); ?>"><button type="button" class="btn btn-warning btn-fill">
														<i class="pe-7s-note"></i> Editar</button>
													</a>
													<a href="?pg=usuario&a=d&id=<?php echo $listaUsuarios[$i]->getIDUsuario(); ?>"><button type="button" class="btn btn-danger btn-fill">
														<i class="pe-7s-close"></i> Deletar</button>
													</a>
												</div>
											</td>
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

