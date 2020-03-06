<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buscar</title>
    <link rel="stylesheet" href="style.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Handlee" rel="stylesheet">  
</head>
<body>
    <div class="container">
        <?php if($error = $this->session->flashdata('erro')){?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="alert">
                            <?= $error ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
		<form method="post" action = "<?php echo base_url('index.php/Meucontroller/procurarPor')?>">
            <select name="buscar"class="buscar form-control">
                <option value="venda">Listar por Vendas</option>
                <option value="aluguel">Listar por Aluguel</option>
                <option value="bairro">Listar por Bairro</option>
                <option value="nDormitorios">Listar por Número de Dormitórios</option>
            </select>
            <br>
            <div class="input">
            </div>
            <input type="submit" class="btn btn-default botao" value="OK" >
            <div class="tabela"></div>
        </form>
    </div>
    <script>
        let select = document.querySelector("select[name='buscar']");
        let div = document.querySelector("div.input");
        let button = document.querySelector(".ok");
        let tabela = document.querySelector(".tabela");
        let html1 = '<label>Pesquisar:</label><input type="text" class="form-control" name="inputValue" required> <br>';
        let html2 = '<label>Pesquisar:</label><input type="number" class="form-control" name="inputValue" required> <br>';
        select.addEventListener('change', function(e) {
            if(select.value == "bairro") { 
                div.innerHTML = "";
                div.innerHTML += html1;
            } else if(select.value == "nDormitorios") { 
                    div.innerHTML = "";
                    div.innerHTML += html2;
                } else{
                    div.innerHTML = "";
                }
        });
    </script>
</body>
</html>