<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Imobiliária</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<?php echo (isset($msg) ? $msg : '') ?>
		<?php  echo  form_open_multipart ('Meucontroller/salvar' );?>
			<input type='hidden' name="codigo" value="<?= set_value('codigo') ? : (isset($codigo) ? $codigo : ''); ?>">
			<label for="descricao">Descrição:</label><span class="erro"><?php echo form_error('descricao') ?  : ''; ?></span>
			<input type="text" name="descricao" id="descricao" class="form-control" value="<?= set_value('descricao') ? : (isset($descricao) ? $descricao: '') ?>" autofocus='true' required/>	
			<br>
			<label for="bairro">Bairro:</label><span class="erro"><?php echo form_error('bairro') ?  : ''; ?></span>
			<input type="text" name="bairro" id="bairro" class="form-control" value="<?= set_value('bairro') ? : (isset($bairro) ? $bairro: '') ?>" autofocus='true' required/>	
			<br>
			<label for="tipo">Tipo:</label>
			<select name="tipo_operacao" id=""class="form-control" >
				<option value="aluguel">Aluguel</option>
				<option value="venda">Venda</option>
			</select>
			<br>
			<label for="nome">Preço:</label><span class="erro"><?php echo form_error('preco') ?  : ''; ?></span>
			<input type="number" name="preco" id="preco" class="form-control" value="<?= set_value('preco') ? : (isset($preco) ? $preco: '') ?>" autofocus='true' required/>	
			<br>
			<label for="dormitorios">Número de dormitórios:</label>
			<input type="number" name="dormitorios" class="form-control" value="<?= set_value('nDormitorios') ? : (isset($nDormitorios) ? $nDormitorios: '') ?>" required/>
			<br>
			<label for="foto">Foto do imóvel:</label>
			<br>
			<input type="file" name="userfile" size="20" required/>
			<br>
			<input type="submit" value="Salvar"  class="btn botao"/>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
