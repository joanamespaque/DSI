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
	<?php if($msg = $this->session->flashdata('msg')){?>
                <div class="row" style="display:block;margin-left:auto;margin-right:auto;">
                    <div class="col-lg-6">
                        <div class="alert alert-success">
                            <?= $msg ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
	<a class="pdf" href="<?php echo base_url('index.php/Meucontroller/pdf');?>">
		<button type="submit" class="btn botao"> 
			GERAR PDF
		</button>
	</a>
	<div class="container">
		<?php foreach ($items as $item) { ?>      
        <table class = "table table-hover">
            <thead>
                <tr>
                    <th>CÓDIGO</th>
                    <th>DESCRIÇÃO</th>
                    <th>BAIRRO</th>
                    <th>TIPO</th>
					<th>PREÇO</th>
					<th>NÚMERO DE DORMITÓRIOS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
					<td>
						<?php echo $item->codigo;?>
					</td>
                    <td>
						<?php echo $item->descricao;?>
                    </td>
                    <td>
						<?php echo $item->bairro;?>
                    </td>
                    <td>
						<?php echo $item->tipo_operacao;?>
                    </td>
                    <td>
						R$ <?php echo $item->preco;?>
					</td>
					<td>
						<?php echo $item->nDormitorios;?>
					</td>
					<?php if($_SESSION['admin']=='Sim'){ ?>
						<td> 
							<a href="<?php echo base_url('index.php/Meucontroller/excluir/'.$item->codigo);?>">
									<button type="submit" class="btn botao"> Excluir
									</button>
							</a>
						</td>
						<td> 
							<a href="<?php echo base_url('index.php/Meucontroller/alterar/'.$item->codigo);?>">
									<button type="submit" class="btn botao"> Alterar
									</button>
							</a>
						</td>
					<?php } ?>
					<img  class="foto" src="<?php echo base_url('uploads/').$item->foto;?>" alt="">
			<?php } ?>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
