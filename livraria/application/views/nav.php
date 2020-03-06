<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>SORVIL</title>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/nav.css');?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Kaushan+Script&display=swap" rel="stylesheet">
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div id="cont1">
      <img src="<?php echo base_url('assets/css/img/livro.png');?>" alt="">
      <a class="navbar-brand" id="titulo">Livraria Sorvil</a>
    </div>
	</nav>
	<div class="pos-f-t">
		<div class="collapse" id="navbarToggleExternalContent">
        <div class="navbar navbar-expand-lg navbar-light bg-light">
          <ul class="navbar-nav">
              <?php if($this->session->userdata('nome')){ ?>
                <li class="nav-item nav-link" id="titulo">
                  Seja bem-vindo(a) <?php echo ($_SESSION['nome']) ?>
                </li>
                <?php if($_SESSION['nome']=='ADMIN'){ ?>
                <li class="nav-item">
                  <?php echo anchor('/Carrinho/listaPendentes','Compras Pendentes','class="nav-link"');?>
                </li>
                <li class="nav-item">
                  <?php echo anchor('/LojaController/listaUsuarios','Usuarios','class="nav-link"');?>
                </li>
                <li class="nav-item">
                  <?php echo anchor('/LojaController/listaLivros','Listar Livros','class="nav-link"');?>
                </li>
                <li class="nav-item">
                  <?php echo anchor('/LojaController/formLivro','Inserir Livro','class="nav-link"');?>
                </li>
                <li class="nav-item">
                  <?php echo anchor('/LojaController/mensagem','Mensagem','class="nav-link"');?>
                </li>
                <li class="nav-item">
                  <?php echo anchor('/LojaController/formGenero','Inserir Genero','class="nav-link"');?>
                </li>
                <?php } ?>
                <?php } else{?>
                <?php echo anchor('/LojaController/login','Login','class="nav-link"');?>
                <?php echo anchor('/LojaController/cadastro','Cadastro','class="nav-link"');?>
                <?php } ?>
                <li class="nav-item">
                  <?php echo anchor('LojaController/generos','Listar por Gênero','class="nav-link"');?>
                </li>
                <?php if($this->session->userdata('nome')){ ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('index.php/Carrinho/comprasUsuario');?>">Suas Compras
                  </a>
                <li class="nav-item">
                  <a class="nav-link" href="<?php echo base_url('index.php/LojaController/logout');?>">Finalizar sessão
                  </a>
                </li>
              <?php } ?>
          </ul>
        </div>
			</div>
		</div>
		<nav class="navbar navbar-dark" style="background-color:#43a690 !important;">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent"
				aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
      </button>
      <?php if($this->session->userdata('nome')){ ?>
      <a href="<?php echo base_url('index.php/Carrinho/listar');?>">
			<img src="<?php echo base_url('assets/css/img/cart.png');?>" alt="cart" id="cart">
		</a>
    <?php } ?>
		</nav>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	</script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	</script>
</body>

</html>
