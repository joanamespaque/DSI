<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Lista Usuários</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<?php if($msg = $this->session->flashdata('msg')){?>
                <div class="row" style="display:block;margin-left:auto;margin-right:auto;">
                    <div class="col-lg-6">
                        <div class="alert alert-success">
                            <?= $msg ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
	<div class="container">
        <div style="width:50%; margin:0 auto;">
        <form action=""></form>
        <?php  echo  form_open_multipart ('LojaController/listaUsuarios' );?>
        <span class="erro"><?php echo form_error('busca') ?  : ''; ?></span>
        <input type="text" class="form-control" name="busca" autofocus='true' required
        value ="<?php if(isset($valor)) echo $valor?>">
        <input type="submit" class="btn btn-default botao" value="BUSCAR" style="margin-top:10px;">

        </form>
        </div>
        <table  class='table table-hover'>
            <thead>
                <tr>
                    <th>NOME</th>
                    <th>E-MAIL</th>
                    <th>ESTADO</th>
                    <th>CIDADE</th>
                    <th>ENDEREÇO</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $u) { ?>     
                <tr>
                    <td><?php echo $u->nome;?></td>
                    <td><?php echo $u->email;?></td>
                    <td><?php echo $u->estado;?></td>
                    <td><?php echo $u->cidade;?></td>
                    <td><?php echo $u->endereco;?></td>
                    <?php if($u->nome !== 'ADMIN'){ ?>
                    <td> 
						<a href="<?php echo base_url('index.php/LojaController/excluirUsuario/'.$u->cod);?>">
							<button type="submit" class="btn btn-danger"> Excluir </button>
						</a>
					</td>
                    <?php } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="<?php echo base_url('index.php/LojaController/pdfUsuario');?>">>
            <button class="btn botao">GERAR PDF</button>
        </a>

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
