<?php
$hash = md5(date('Y-m-d'));
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formul&aacute;rio</title>
    <!-- Adicionando Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
</head>

<body>
    <div id="modalErros" class="modal">
        <div class="modal-content">
            <div style="display: flex; align-items: center; width: 75px; justify-content: space-between;">
                <span class="fechar">&times;</span><span class="fechar pequeno">Fechar</span>
            </div>

            <div style="text-align: center;">
                <h4>Aten&ccedil;&atilde;o, verifique as Informa&ccedil;&otilde;es abaixo:</h4>
            </div>
            <div id="listaErros"></div>
        </div>
    </div>
    <div class="container">
        <div style="display: flex; width: 100%; justify-content: space-between; align-items: center;">
            <img src="https://tecbiz.com.br/wp-content/uploads/2021/10/tecbiz-215x215.png" alt="">
            <h2 class="mt-4 mb-4">Formul&aacute;rio de solicita&ccedil;&atilde;o</h2>
        </div>

        <form action="./form.php" method="post" enctype="multipart/form-data">
            <input type="text" name="hash" value="<?= $hash ?>" style="display: none;">
            <div class="titulo_obrigatorio">* campos obrigat&oacute;rios</div>
            <div>
                <div>
                    <fieldset>
                        <legend>Dados Pessoais</legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group" style="width: 100%;">
                                <label for="cartao">N&uacute;mero do cart&atilde;o: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="cartao" name="cartao" maxlength="50" style="display: flex; flex: 1;" value="6298 69">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <button id="continuar" class="btn-md btn-warning mt-3 btn-block mb-5 p-2" style="color: white;">Continuar</button>
        </form>
    </div>

    <!-- Adicionando Bootstrap JS (opcional, se necess&aacute;rio) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./src/js/mask.js"></script>
    <script src="./src/js/cpfcnpj.js"></script>
    <script>
        $(document).ready(function() {

            $('#cartao').mask("9999 9999 9999 9999");
            $('#continuar').click(validarCartao);
            $('.fechar').click(function() {
                $('.modal').css('display', 'none');
            });
        });
    </script>
</body>

</html>
