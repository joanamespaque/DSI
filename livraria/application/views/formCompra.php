<a href ="<?php echo base_url('index.php/Carrinho/listar');?>">
    <button class="btn botao" style="margin-top:-15px; margin-left: 30px !Important;float:left;">VOLTAR</button>
</a>
<div class="container">
	<h2 style="text-align: center;">Dados para pagamento:</h2>
	<form action="<?php echo base_url('index.php/Carrinho/realizaCompra');?>" method='post'>
		<label>Banco:</label>
		<select name="banco" class="form-control" required>
			<option selected disabled>Selecione o Banco</option>
			<option value="001">Banco do Brasil S.A.</option>
			<option value="341">Banco Itaú S.A.</option>
			<option value="033">Banco Santander (Brasil) S.A.</option>
			<option value="652">Itaú Unibanco Holding S.A.</option>
			<option value="237">Banco Bradesco S.A.</option>
			<option value="745">Banco Citibank S.A.</option>
			<option value="399"> HSBC Bank Brasil S.A. – Banco Múltiplo</option>
			<option value="104">Caixa Econômica Federal</option>
		</select>
		<br>
		<label>Agência:</label>
		<input type="text" class="form-control" name="agencia">
		<br>
		<label>Conta:</label>
		<input type="text" class="form-control" name="conta">
        <br>
		<label>Valor para depósito:</label>
        <br>
        <input type="text" name='total' class="form-control" value="<?php echo $_SESSION['total']?>" disabled>
        
        <br>
		<input type="submit" value="EFETUAR PAGAMENTO" class="btn botao">
        <br>
        
	</form>
</div>
