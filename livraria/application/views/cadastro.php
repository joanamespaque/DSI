<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="utf-8">
	<title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/nav.css');?>">
</head>
<body>
	<div class="container">
        <div>
            <?php if($error = $this->session->flashdata('cadastro_failed')){?>
                <div style='width:100%;' class="mensagem">
                    <div>
                        <div class="alert alert-dismissable alert-danger">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
		<?php echo (isset($msg) ? $msg : '') ?>
		<a class="link" href="<?php echo base_url('index.php/LojaController/login')?>">
        Já possui um cadastro? Clique aqui para fazer login!
		</a>
		<form action="<?php echo base_url('index.php/LojaController/cadastrar')?>" method="post">
			<label for="email">Email:</label>
			<input type="email" name="email" id="email" class="form-control" autofocus='true' required>
			<br>
			<label for="senha">Senha:</label>
			<input type="password" name="senha" id="senha" class="form-control" autofocus='true' required/>
			<br>
            <label for="nome">Nome:</label>
			<input type="text" name="nome" id="nome" class="form-control" autofocus='true' required/>
			<br>
            <label for="estado">Estado:</label>
            <select name="estado" id="estado" class="form-control">
                <option value="AC">Acre</option>
                <option value="AL">Alagoas</option>
                <option value="AP">Amapá</option>
                <option value="AM">Amazonas</option>
                <option value="BA">Bahia</option>
                <option value="CE">Ceará</option>
                <option value="DF">Distrito Federal (Brasília)</option>
                <option value="ES">Espírito Santo</option>
                <option value="GO">Goiás</option>
                <option value="MA">Maranhão</option>
                <option value="MT">Mato Grosso</option>
                <option value="MS">Mato Grosso do Sul</option>
                <option value="MG">Minas Gerais</option>
                <option value="PA">Pará</option>
                <option value="PB">Paraíba</option>
                <option value="PR">Paraná</option>
                <option value="PE">Pernambuco</option>
                <option value="PI">Piauí</option>
                <option value="RN">Rio Grande do Norte</option>
                <option value="RS">Rio Grande do Sul</option>
                <option value="RJ">Rio de Janeiro</option>
                <option value="RO">Rondônia</option>
                <option value="RR">Roraima</option>
                <option value="SC">Santa Catarina</option>
                <option value="SP">São Paulo</option>
                <option value="SE">Sergipe</option>
                <option value="TO">Tocantins</option>
            </select>
			<br>
			<label for="nome">Cidade:</label>
			<input type="text" name="cidade" id="cidade" class="form-control" autofocus='true' required/>
			<br>
			<label for="nome">Endereço:</label>
			<input type="text" name="endereco" id="endereco" class="form-control" autofocus='true' required/>
			<br>
			<input class="btn botao" type="submit" value="Cadastrar"/>
		</form>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){ 
            setTimeout(function() {
                $(".mensagem").fadeOut().empty();
            }, 5000);
        }, false);
    </script>
