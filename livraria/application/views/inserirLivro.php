<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Inserir Livro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<?php echo (isset($msg) ? $msg : '') ?>
		<?php  echo  form_open_multipart ('LojaController/salvarLivro' );?>
			<input type='hidden' name="cod" value="<?= set_value('cod') ? : (isset($cod) ? $cod : ''); ?>">
			<label for="titulo">Título:</label>
			<span class="erro"><?php echo form_error('titulo') ?  : ''; ?></span>
			<input type="text" name="titulo" class="form-control" value="<?= set_value('titulo') ? : (isset($titulo) ? $titulo: '') ?>" autofocus='true' required/>	
			<br>
			<label for="autor">Autor:</label>
			<span class="erro"><?php echo form_error('autor') ?  : ''; ?></span>
			<input type="text" name="autor" id="autor" class="form-control" value="<?= set_value('autor') ? : (isset($autor) ? $autor: '') ?>" autofocus='true' required/>	
			<br>
			<label for="tipo">Sinopse:</label>
			<span class="erro"><?php echo form_error('sinopse') ?  : ''; ?></span>
			<textarea name="sinopse" cols="20" rows="5" class="form-control"><?= set_value('sinopse') ? : (isset($sinopse) ? $sinopse: '') ?></textarea>
			<br>
			<label for="nome">Preço:</label>
			<span class="erro"><?php echo form_error('preco') ?  : ''; ?></span>
			<input type="number" name="preco"  step=0.01 id="preco" class="form-control" value="<?= set_value('preco') ? : (isset($preco) ? $preco: '') ?>" autofocus='true' required/>	
			<br>
			<label for="quantidade">Quantidade em Estoque:</label>
			<span class="erro"><?php echo form_error('quantidade') ?  : ''; ?></span>
			<input type="number" name="quantidade" class="form-control" value="<?= set_value('quantidade') ? : (isset($quantidade) ? $quantidade: '') ?>" required/>
			<br>
			<label for="nome">Peso:</label>
			<span class="erro"><?php echo form_error('peso') ?  : ''; ?></span>
			<input type="number" name="peso"  step=0.001 id="peso" class="form-control" value="<?= set_value('peso') ? : (isset($peso) ? $peso: '') ?>" autofocus='true' required/>	
			<br>
			<label for="foto">Foto da capa:</label>
			<span class="erro"><?php echo form_error('imagem') ?  : ''; ?></span>
			<br>
			<input type="file" name="userfile" size="20" required/>
			<br>
			<br>
			<label for="foto">Selecione os gêneros:</label>
			<ul class="radioUl">
				<?php foreach ($items as $item) { ?>  
			<li>
						<input class="check" type="checkbox" name='genero[]'value="<?php echo $item->cod;?>"
						<?php 
						if(isset($generos)){
						foreach ($generos as $g) { ?>  
							<?php 
								if($g->genero_id == $item->cod){
							?>
							checked							
							<?php } } }?>
						>
						<label class="form-check-label"><?php echo $item->titulo;?></label>
						<div class="check"><div class="inside"></div></div>
			</li>
				<?php } ?>
			</ul>
			<div class="divBotao">
				<input type="submit" value="Salvar"  class="btn botao"/>
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
