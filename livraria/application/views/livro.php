<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Livro</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/busca.css');?>">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">  
</head>
<body>
    <div class="container">
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
        <?php if(isset($livro)){?>
        <div class="livro">
            <div class="img">
            <img  src="<?php echo base_url('uploads/').$livro->imagem;?>" alt="Capa livro">
            <p id="preco"><?php echo $livro->preco;?>&nbsp;R$</p>
                <?php
                    if(intval($livro->quantidade)!==0){
                ?>
                <?php if($this->session->userdata('nome')){ ?>
                <form action = "<?php echo base_url('index.php/Carrinho/inserir')?>" method='post'>
                <label >Quantidade:</label>
                <input type="number" name="quantidade" class="form-control" required min=1>
                <input type="hidden" name=peso value="<?php echo $livro->peso;?>">
                <input type="hidden" name=titulo value="<?php echo $livro->titulo;?>">
                <input type="hidden" name=cod value="<?php echo $livro->cod;?>">
                <input type="hidden" name=preco value="<?php echo $livro->preco;?>">
                <input type="hidden" name=imagem value="<?php echo $livro->imagem;?>">
                <input type="hidden" name=estoque value="<?php echo $livro->quantidade;?>">
                <!-- <button type="submit" class="btn botao cartButton">
                    CALCULAR FRETE
                </button> -->
                <button type="submit" class="btn botao cartButton">
                    ADICIONAR AO CARRINHO
                </button>
                </form>
                <?php } ?>
            <?php } else{ ?>
                <span>Vish! Esse livro está fora de estoque!</span>
            <?php }?>
                <p><?php if(isset($response)) echo $response ?></p>
            </div>
            <div class="info">
                <span>Livro:&nbsp;<?php echo $livro->titulo;?></span>
                <div class="detalhes">
                    <span>detalhes:</span>
                        <label>SINOPSE:</label>
                        <p><?php echo $livro->sinopse;?></p>
                        <label>AUTOR:</label>
                        <p><?php echo $livro->autor;?></p>
                        <label>QUANTIDADE EM ESTOQUE:</label>
                        <p><?php echo $livro->quantidade;?></p>
                        <label>PESO:</label>
                        <p><?php echo $livro->peso;?>Kg</p>                       
                </div>
            </div>
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