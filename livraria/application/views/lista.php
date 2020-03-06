<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista - ADMIN</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/livros.css');?>">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">  
</head>
<body>
    <div class="container">
        <a href="<?php echo base_url('index.php/LojaController/pdfLivros');?>" >
            <button class="btn botao" style='margin-top:-10px;'>GERAR PDF</button>
        </a>
        <?php if($error = $this->session->flashdata('erro')){?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="alert">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        <?php if(isset($livros)){ ?>
        <div class="livros">
            <?php foreach ($livros as $l) { ?>     
                <div class="livroItem">
                    <a  href="<?php echo base_url('index.php/LojaController/livro/'.$l->cod);?>">
                        <img  class="foto" src="<?php echo base_url('uploads/').$l->imagem;?>" alt="">
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
                    <div class="buttons">
                        <a href="<?php echo base_url('index.php/LojaController/excluirLivro/'.$l->cod);?>">
							<button type="submit" class="btn">
                                <img src="<?php echo base_url('assets/css/img/lixeira.png');?>" alt="lixeira">
                            </button>
						</a>
                        <a href="<?php echo base_url('index.php/LojaController/alterarLivro/'.$l->cod);?>">
                        <button type="submit" class="btn">
                            <img src="<?php echo base_url('assets/css/img/edit.png');?>" alt="editar">
                        </button>
						</a>
                    </div>
                </div> 
            <?php } ?>
        </div>
        <?php } ?>
        <div class="pagination">
            <?php if(isset($pagination)) echo $pagination; ?>
        </div>
    </div>
</body>
</html>