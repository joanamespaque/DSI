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
	<div class="container-compra">
        <?php
            if($compras){
            foreach($compras as $c){
        ?>
        <div class="compra">
            <table  class='table table-hover' style='width:90%; margin:0 auto;'>
                <thead>
                    <tr>
                        <th>DATA</th>
                        <th>VALOR</th>
                        <th>FRETE</th>
                        <th>ITENS</th>
                        <th>NÚMERO DO BANCO</th>
                        <th>AGÊNCIA</th>
                        <th>CONTA</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td><?php echo $c->datacompra;?></td>
                        <td><?php echo $c->total;?></td>
                        <td><?php echo $c->frete;?></td>
                        <td><?php echo $c->quantidade;?></td>
                        <td><?php echo $c->banco;?></td>
                        <td><?php echo $c->agencia;?></td>
                        <td><?php echo $c->conta;?></td>
                        <td>
                            <?php
                            if($c->validado == 0){
                                if($c->negada == 0){
                                    $status = 'NEGADA';
                                } else{
                                    $status = 'APROVADA';
                                }
                            } else{
                                $status = 'NÃO VALIDADA';
                            }
                            echo $status;
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
            <h5>PRODUTO(S):</h5>
            <div>
                <?php foreach($itens as $livro){?>
                    <?php 
                        if($livro->compra_cod == $c->cod){
                    ?>
                    <table class="table table-hover"  style='width:60%; margin-top: 20px; margin:0 auto;'>
                        <tr>
                            <th>LIVRO</th>
                            <th>QUANTIDADE</th>
                            <th>SUB-TOTAL</th>
                        </tr>
                        <tr>
                            <td><?php echo $livro->titulo; ?></td>
                            <td><?php echo $livro->quantidade; ?></td>
                            <td><?php echo $livro->subtotal; ?></td>
                        </tr>
                    </table>
                        <?php }?>
                <?php }?>
            </div>
        </div>
        <?php }} else{    
        ?>
        <h4>Você ainda não efetuou compras.</h4>
        <?php } ?>

	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
