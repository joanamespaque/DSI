<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Mensagem</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<div class="container">
	<div id="msg"> 
            <?php if($mensagem = $this->session->flashdata('msg')){?>
                    <div class="row ">
                        <div>
                            <div class="alert alert-dismissable alert-sucess">
                                <?= $mensagem ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
    <h4 id="titulo">Envie uma mensagem para os usuários:</h4>
		<?php echo (isset($msg) ? $msg : '') ?>
		<?php  echo  form_open_multipart ('LojaController/enviaMensagem' );?>
			<label for="titulo">Assunto:</label>
			<span class="erro"><?php echo form_error('assunto') ?  : ''; ?></span>
			<input type="text" name="assunto" class="form-control" autofocus='true' required/>	
			<br>
			<label for="tipo">Mensagem:</label>
			<span class="erro"><?php echo form_error('mensagem') ?  : ''; ?></span>
			<textarea name="mensagem" cols="20" rows="5" class="form-control"></textarea>
			<br>
			<div class="divBotao">
				<input type="submit" value="Enviar"  class="btn botao"/>
			</div>
		</form>
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
</body>
</html>
