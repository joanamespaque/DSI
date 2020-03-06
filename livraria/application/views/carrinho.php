<html>

<head>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">  
    <link rel="stylesheet" href="<?php echo base_url('assets/css/carrinho.css');?>">
	<style>
	</style>
</head>

<body>
<?php if($this->session->userdata('nome')){ ?>
    <div id="container" style="width: 100%; margin: 0 auto;">
        <div id="msg">
            <?php if($error = $this->session->flashdata('erro')){?>
                <div class="row">
                    <div class="mensagem">
                        <div class="alert alert-dismissable alert-danger">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
            <?php if( $this->cart->total_items() > 0){ ?>
                    <div>
                        <a  href="<?= base_url('index.php/carrinho/paginaCompra')?>">
                            <button class="btn botao">PAGAMENTO</button>
                        </a>
                    </div>
            <?php } ?>
		<h2 style="text-align: center;">Produtos no seu Carrinho de Compras (<?= $this->cart->total_items() ?>)</h2>
		<p style="text-align: center; "><a style="color:#43a690;" href="<?= base_url('index.php/LojaController/generos')?>">Continuar Comprando</a></p>
        <?php echo form_open('carrinho/atualizar'); ?>
		<p  style="text-align:center">Para excluir um produto, informe quantidade 0 e clique no botão Atualizar.</p>
		<table class="table" style="width:100%" border="1" align="center">

			<tr>
				<th></th>
				<th class="ajusta branco">Produto</th>
				<th class="ajusta branco">Quantidade</th>
				<th class="ajusta branco">Preço</th>
				<th class="ajusta branco">Sub-Total</th>
			</tr>

            <?php $i = 1;
            $valoresFrete = array(
                'RS' => [15, 25, 55, 95],
                'SC' => [15, 25, 55, 95],
                'PR' => [15, 25, 55, 95],
                'SP' => [30, 50, 110, 190],
                'RJ' => [30, 50, 110, 190],
                'ES' => [30, 50, 110, 190],
                'MG' => [30, 50, 110, 190],
                'MT' => [30, 50, 110, 190],
                'MS' => [30, 50, 110, 190],
                'RO' => [45, 65, 140, 210],
                'BA' => [45, 65, 140, 210],
                'GO' => [45, 65, 140, 210],
                'SE' => [45, 65, 140, 210],
                'DEMAIS' => [50, 80, 170, 240]
            );
            $pesoTotal = 0; 
            $frete = 0;           
            ?>
    
            <?php foreach ($this->cart->contents() as $items): 
            ?>

			<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

			<tr>
                <td>
                <img src="<?php echo base_url('uploads/').$items['image']?>" alt="">
                </td>
				<td class="ajusta">
					<?php echo $items['name']; ?>

					<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

					<p>
						<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

						<?php endforeach; ?>
					</p>

					<?php endif; ?>

                </td>
                <td class="ajusta"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5', 'max' => $items['estoque'], 'min' => 1,  'type' => 'number', 'class' => 'semborda')); ?></td>
				<td class="ajusta">R$ <?php echo $items['price']; ?></td>
				<td class="ajusta">R$ <?php echo $items['subtotal']; ?></td>
			</tr>

			<?php $i++; ?>

            <?php
            $pesoTotal+=$items['qty']*$items['peso'];  
            endforeach; ?>
			<tr>
                <td></td>
				<td colspan="2">&nbsp;</td>
				<td class="left"><strong>Sub-Total</strong></td>
				<td class="right">R$ <?php echo $this->cart->total(); ?></td>
            </tr>
            <tr>
                <td></td>
            <td colspan="2">&nbsp;</td>
            <td class="left"><strong>Frete</strong></td>
            <td class="right">R$ <?php 
                
            if(array_key_exists($_SESSION['estado'], $valoresFrete)){
                if($pesoTotal == 0){
                    $frete = 0;
                } elseif($pesoTotal <= 1 && $pesoTotal > 0){
                    $frete = $valoresFrete[$_SESSION['estado']][0]; 
                } elseif($pesoTotal > 1 && $pesoTotal <= 2){
                    $frete = $valoresFrete[$_SESSION['estado']][1]; 
                } elseif($pesoTotal > 2 && $pesoTotal <= 5){
                    $frete = $valoresFrete[$_SESSION['estado']][2]; 
                } else{
                    $frete = $valoresFrete[$_SESSION['estado']][3]; 
                }
            } else{
                if($pesoTotal <= 1 && $pesoTotal > 0){
                    $frete = $valoresFrete['DEMAIS'][0]; 
                } elseif($pesoTotal > 1 && $pesoTotal <= 2){
                    $frete = $valoresFrete['DEMAIS'][1]; 
                } elseif($pesoTotal > 2 && $pesoTotal <= 5){
                    $frete = $valoresFrete['DEMAIS'][2]; 
                } else{
                    $frete = $valoresFrete['DEMAIS'][3]; 
                }
            }
            echo $frete;          
            
            ?></td>
            </tr>

			<tr>
                <td></td>
				<td colspan="2">&nbsp;</td>
				<td class="left"><strong>Total</strong></td>
				<td class="right">R$ <?php echo $this->cart->total()+$frete; ?></td>
            </tr>

			<tr>
                <td></td>
				<td colspan="4">
                    <div style="float: right;">
                        <a style="color:#43a690; margin-top:10px;" href="<?= base_url('index.php/carrinho/limpar')?>">
                            LIMPAR CARRINHO
                        </a></div>
					<div style="float: right; margin-right:10px;"><?php echo form_submit('', 'Atualizar', 'class="btn botao" style="margin-bottom:-10px;"'); ?></div>
				</td>
			</tr>
        </table>
	</div>
            <div class="dados">
                <input type="hidden" name='valortotal' value=<?php echo $this->cart->total()+$frete; ?>>
                <input type="hidden" name='idusuario' value=<?php echo $_SESSION['cod']; ?>>
                <?php
                    $_SESSION['frete'] = $frete;
                    $_SESSION['total'] = $this->cart->total()+$frete;
                ?>
            </div>
            <?php } ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){ 
            setTimeout(function() {
                $("#msg").empty();
            }, 5000);
        }, false);
    </script>
</body>

</html>
