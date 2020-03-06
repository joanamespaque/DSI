<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">  
</head>
<body>
    <div class="container">
        <div id="msg">
            <?php if($error = $this->session->flashdata('cadastro_failed')){?>
                <div style='width:100%;' class="mensagem">
                    <div>
                        <div class="alert alert-dismissable alert-danger">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if($msg = $this->session->flashdata('msg')){?>
                <div style='width:100%;' class="mensagem">
                    <div>
                        <div class="alert alert-dismissable alert-success">
                            <?= $msg ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
            <h4 id="titulo">Insira o título de um gênero:</h4>
		<form method="post" action = "<?php echo base_url('index.php/LojaController/inserirGenero')?>">
            <input type="text" name="titulo" class="form-control" placeholder="gênero">
            <br>
            <input type="submit" class="btn btn-default botao" value="ENVIAR" >
            <div class="tabela"></div>
        </form>
        <div class="divTabelaGenero">
            <table class='table table-hover tabela-genero'>
                <thead>
                    <tr>
                        <th>TÍTULO</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($generos as $g) { ?>  
                    <tr>
                        <td><?php echo $g->titulo;?></td>
                        <td class="botaoExcluirGenero"> 
							<a href="<?php echo base_url('index.php/LojaController/excluirGenero/'.$g->cod);?>">
								<button type="submit" class="btn btn-danger" style="width:160px;"> Excluir </button>
							</a>
						</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){ 
            setTimeout(function() {
                $("#msg").empty();
            }, 5000);
        }, false);
    </script>
</body>
</html>