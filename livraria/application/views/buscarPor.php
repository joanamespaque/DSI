<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/livros.css');?>">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">  
</head>
<body>
    <div class="container">
        <div id="msg"> 
            <?php if($error = $this->session->flashdata('erro')){?>
                    <div class="row ">
                        <div>
                            <div class="alert">
                                <?= $error ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
        </div>
            <h4 id="titulo">Escolha um gênero para procurar livros:</h4>
		<form method="get" action = "<?php echo base_url('index.php/LojaController/procurarPor')?>">
            <select name="genero"class="buscar form-control">
                <option disabled selected>Selecione um gênero</option>
                <?php foreach ($items as $item) { ?>   
                <option value="<?php echo $item->cod;?>"
                <?php  
                if(isset($cod)){
                    print($cod);
                    if($item->cod == $cod){
                        ?>
                        selected
                        <?php
                    }
                } ?>
                >
                <?php echo $item->titulo;?></option>
                <?php } ?>
            </select>
            <br>
            <input type="submit" class="btn btn-default botao" value="OK" >
        </form>
        <?php if(isset($livros)){ ?>
        <div class="livros">
            <?php foreach ($livros as $l) { ?>      
                <div class="livroItem">
                    <a href="<?php echo base_url('index.php/LojaController/livro/'.$l->cod);?>">
                        <img  class="foto" src="<?php echo base_url('uploads/').$l->imagem;?>"  alt="">
                    </a>
                    <div class="info">
                        <div class="detalhes">
                            <h6>Livro - <?php echo $l->titulo;?></h6>
                            <span>R$&nbsp;<?php echo $l->preco;?></span>
                            <br>
                            <?php if($l->quantidade == 0){?>
                                <span class='estoque0'>PRODUTO INDISPONÍVEL</span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>

    </div>
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