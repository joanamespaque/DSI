<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <title>Lista Usuários</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/compra.css');?>">
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
	<div style="width:95%!important; margin:0 auto;">
        <table  class='table table-hover' style='width:100%; margin:0 auto;'>
            <thead>
                <tr>
                    <th>DATA</th>
                    <th>USUÁRIO</th>
                    <th>VALOR TOTAL</th>
                    <th>VALOR FRETE</th>
                    <th>Nº DE ITENS</th>
                    <th>Nº DO BANCO</th>
                    <th>AGÊNCIA</th>
                    <th>CONTA</th>
                </tr>
            </thead>
            <tbody>
                
                <?php 
                if(($pendentes)){
                foreach ($pendentes as $p) { ?>     
                <tr>
                    <td><?php echo $p->datacompra;?></td>
                    <td><?php echo $p->nome;?></td>
                    <td><?php echo $p->total;?></td>
                    <td><?php echo $p->frete;?></td>
                    <td><?php echo $p->quantidade;?></td>
                    <td><?php echo $p->banco;?></td>
                    <td><?php echo $p->agencia;?></td>
                    <td><?php echo $p->conta;?></td>
                    <td>
                        <a href="<?php echo base_url('index.php/Carrinho/validaCompra/'.$p->cod);?>">
                            <button class="btn botao">Validar</button>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo base_url('index.php/Carrinho/cancelaCompra/'.$p->cod);?>">
                            <button class="btn btn-danger">Cancelar</button>
                        </a>
                    </td>
                </tr>
                <?php }}else{ ?>
                    <h4>Não existem compras pendentes até agora.</h4>
                <?php }?>
            </tbody>
        </table>

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
