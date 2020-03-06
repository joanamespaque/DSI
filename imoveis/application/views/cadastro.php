<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nav.css');?>">
</head>
<body>
	<div class="container" style="width:40%;">
    <div>
            <?php if($error = $this->session->flashdata('cadastro_failed')){?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="alert alert-dismissable alert-danger">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php echo (isset($msg) ? $msg : '') ?>
		<form action="<?php echo base_url('index.php/Meucontroller/cadastrar')?>" method="post">
			<label for="login">Login</label>
			<input type="text" name="login" id="login" class="form-control" autofocus='true' placeholder="Login" required/>
			<br>
			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha" class="form-control" autofocus='true' placeholder="Senha" required/>
			<br>
            <label for="nome">Nome Completo</label>
			<input type="text" name="nome" id="nome" class="form-control" autofocus='true'placeholder="Nome completo" required/>
			<br>
            <label for="admin">Administrador?</label>
			<select name="administrador" id=""class="form-control" required>
				<option disabled >Selecione</option>
				<option value="Nao">Não</option>
				<option value="Sim">Sim</option>
			</select>
			<br>
			<input class="btn botao" type="submit" value="Cadastrar"/>
		</form>
		<a class="link" href="<?php echo base_url('index.php/Meucontroller/login')?>" style="text-align: center;">
        Já tem um cadastro? Clique aqui para fazer login!
		</a>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
