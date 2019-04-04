<?php

/**
 * 
 * Exercicio de lógica envolvendo REST
 * 
 * Guarda dados a cada POST enviado ao servidor 
 * Mostra a listagem com os dados que foram armazenado
 * 
 * @author Danilo Song <danilosong@outlook.com>
 * @since 03-04-2019
 * @version 1.0
 */

// verifica se post tem pelo menos 1 ou mais itens no array
if(count($_POST) > 0){
    $old = $_POST['dados'] . "," . $_POST['old'];
}else{
    $old = "";
}
// $list faz um explode para remover as virgulas e transformar em array a cada virgula removida
// $list depois do explode faz array_filter para remover os valores vazio dentro do array
$itens = array_filter(explode(",", $old));
// Ordena os itens em ordem alfabetica
sort($itens);
?>

<html>
<head>
    <title>Guarda dados e exibe lista</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" >
    
<!-- Latest compiled and minified CSS  BOOTSTRAP-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous" />
</head>
<body>
    <div id="mensagem" class="alert alert-success">
        <p>Salvo com sucesso!.</p>
    </div>
    <br>
    <h1>Grava dados <small>grava dados para exibição da listagem</small></h1>
    <hr>
    <form class="form-inline" name="guarda-dados" action="/index.php" method="POST">
        <div class="form-group">
            <label for="dados">Adicionar dados</label>
            <input type="text" class="form-control" name="dados" id="dados" placeholder="Adicione um valor">
            <input type="hidden" id='old' name="old" value="<?= $old; ?>">
        </div>
        <div class="form-group">
            <button type="submit" id='salva-dados' class="btn btn-success">Enviar dados</button>
            <button type="button" id="exibe-listagem" class="btn btn-primary">Exibe listagem</button>
        </div>
        <div id="exibir">
            <hr>
            <!-- Faz a listagem pela tag UL -->
            <div class="col-md-6 bg-danger">
                <h3>Listagem <small>Por TAG &lt;ul></small></h3>
                <ul>
                    <li><u>Dados</u></li>
                    <?php
                        // foreach percorrendo os itens salvo e criando as linhas com as tag
                        foreach ($itens as $item){
                            echo "<li>" . $item . "</li>";
                        }
                    ?>
                </ul>
            </div>
            <!-- Faz a listagem pela tag table -->
            <div class="col-md-6 bg-warning">
                <h3>Listagem <small>Por TAG &lt;table></small></h3>
                <table class="table table-bordered table-striped">
                    <tr><th>Dados</th></tr>
                        <?php
                            // foreach percorrendo os itens salvo e criando as linhas com as tag
                            foreach ($itens as $item){
                                echo "<tr><td>" . $item . "</td></tr>";
                            }
                        ?>
                </table>
            </div>
        </div>
    </form>
</body>
</html>

<!--Perfumarias -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
    $("#exibir").hide();
    if($('#old').val() == ""){
        $('#mensagem').hide();
    }else{
        $().ready(function() {
            setTimeout(function () {
                $('#mensagem').hide('slow');
            }, 2000); // O valor é representado em milisegundos.
        });
    }
    
    // Exibe a listagem
    $("#exibe-listagem").click(function(){
        $("#exibir").show('slow');
    });
    
    // Não aceita caracteres especiais
    $('#dados').on('keypress', function() {
        var regex = new RegExp("^[a-zA-Z0-9-Zàèìòùáéíóúâêîôûãõ\b]+$");
        var _this = this;
        // Curta pausa para esperar colar para completar
        setTimeout( function(){
            var texto = $(_this).val();
            if(!regex.test(texto))
            {
                $(_this).val(texto.substring(0, (texto.length-1)))
            }
        }, 100);
    });
</script>
    