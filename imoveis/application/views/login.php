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
        <div id="msg">
            <?php if($error = $this->session->flashdata('login_failed')){?>
                <div class="row">
                    <div class="mensagem">
                        <div class="alert alert-dismissable alert-danger">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

		<form action="<?php echo base_url('index.php/Meucontroller/logar')?>" method="post">
			<label for="login">Login</label>
			<input type="text" name="login" id="login" class="form-control" autofocus='true' maxlength='20' required/>
			<br>
			<label for="senha">Senha</label>
			<input type="password" name="senha" id="senha" class="form-control" autofocus='true' maxlength='100' required/>
			<br>
			<input type="submit" value="Entrar" class="btn botao"/>
		</form>
        <a class="link" href="<?php echo base_url('index.php/Meucontroller/cadastro')?>" style="text-align: center;">
        Ainda não tem cadastro? Clique aqui para se cadastrar!
		</a>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){ 
            setTimeout(function() {
                $("#msg").empty();
            }, 5000);
        }, false);
    </script>