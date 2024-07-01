<?php

if (!isset($_POST['hash']) || $_POST['hash'] != md5(date('Y-m-d')))
    die('Esta p&aacutegina n&atilde;o pode ser acessad diretamente');

//$host = 'http://192.168.15.30:8080/tecbiz/tecbiz.php?a=5e7ae4&cartao=' . str_replace(" ", "", $_POST['cartao']);
$host = 'https://www2.tecbiz.com.br/tecbiz/tecbiz.php?a=5e7ae4&cartao=' . str_replace(" ", "", $_POST['cartao']);
$json = utf8_decode(file_get_contents($host));
$dadosAssociado = json_decode($json);

if (json_last_error() > 0) {
    //$host = 'https://www2.tecbiz.com.br/tecbiz/tecbiz.php?a=5e7ae4&cartao=' . str_replace(" ", "", $_POST['cartao']);
    $json = file_get_contents($host);
    $dadosAssociado = json_decode($json);
}

if (is_null($dadosAssociado)) {

    $texto = "**ATENÇÃO**\\n\\nNúmero de cartão inválido!";
    echo "
    <script>
        alert('" . utf8_decode($texto) . "'); 
        window.open('./index.php', '_self');
    </script>";
    die($texto);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta>
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

        <form action="./src/envia.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="emailDestino" value="<?= $dadosAssociado->emailEntidade; ?>" style="display: none;">
            <input type="hidden" name="cartao" value="<?= $dadosAssociado->cartao; ?>" style="display: none;">
            <div class="titulo_obrigatorio">* campos obrigat&oacute;rios</div>
            <div>
                <div>
                    <fieldset>
                        <legend>Dados Pessoais</legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="nome_completo">Nome completo: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="nome_completo" name="nome_completo" maxlength="50" value="<?php echo $dadosAssociado->nome; ?>">
                            </div>
                            <div class="form-group">
                                <label for="nome_preferencial">Nome preferencial:</label>
                                <input type="text" class="form-control" id="nome_preferencial" name="nome_preferencial" maxlength="50">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="cpf">CPF: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" value="<?php echo $dadosAssociado->cpf; ?>">
                            </div>
                            <div class="form-group">
                                <label for="data_nascimento">Data de nascimento: <span class="obrigatorio">*</span></label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $dadosAssociado->dataNasc; ?>">
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="nome_mae">Nome da m&atilde;e: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="nome_mae" name="nome_mae" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="nome_pai">Nome do pai:</label>
                                <input type="text" class="form-control" id="nome_pai" name="nome_pai" maxlength="50">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="nacionalidade">Nacionalidade: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="nacionalidade" name="nacionalidade" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="naturalidade">Naturalidade: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="naturalidade" name="naturalidade" maxlength="50">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="estado_civil">Estado civil: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="estado_civil" name="estado_civil" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="conjuge">C&ocirc;njuge:</label>
                                <input type="text" class="form-control" id="conjuge" name="conjuge" maxlength="50">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="email">E-mail: <span class="obrigatorio">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="50" value="<?php echo $dadosAssociado->email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="telefone">Celular: <span class="obrigatorio">*</span></label>
                                <input type="tel" class="form-control" id="telefone" name="telefone" maxlength="15" value="<?php echo $dadosAssociado->fone; ?>">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend>Informa&ccedil;&otilde;es Profissionais</legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="nivel_escolaridade">N&iacutevel de escolaridade: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="nivel_escolaridade" name="nivel_escolaridade" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="ocupacao">Ocupa&ccedil;&atilde;o: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="ocupacao" name="ocupacao">
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="renda_mensal">Renda mensal (R$): <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="renda_mensal" name="renda_mensal" maxlength="10">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div>
                <div>
                    <fieldset>
                        <legend>Endere&ccedil;o <span class="obrigatorio" style="font-size: 8pt;">(Dados do comprovante de endere&ccedil;o)</span></legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="rua_av">Rua/Av.: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="rua" name="rua" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="numero">N&uacute;mero: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="numero" name="numero" maxlength="20">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="cep">CEP: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9">
                            </div>
                            <div class="form-group">
                                <label for="bairro">Bairro: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="bairro" name="bairro" maxlength="50">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="uf">UF: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="uf" name="uf" maxlength="2">
                            </div>
                            <div class="form-group">
                                <label for="cidade">Cidade: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="cidade" name="cidade" maxlength="50">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="complemento">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" maxlength="50">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div>
                    <fieldset>
                        <legend>Informa&ccedil;&otilde;es Banc&aacute;rias</legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="banco">Banco: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="banco" name="banco" maxlength="30">
                            </div>
                            <div class="form-group">
                                <label for="agencia">Ag&ecirc;ncia: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="agencia" name="agencia" maxlength="10">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="tipo_conta">Tipo de conta: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="tipo_conta" name="tipo_conta" maxlength="20" list="tipos_conta">
                                <datalist name="tipos_conta" id="tipos_conta">
                                    <option name="Corrente">Corrente</option>
                                    <option name="Poupan&ccedil;a">Poupan&ccedil;a</option>
                                    <option name="Pagamento">Pagamento</option>
                                </datalist>
                            </div>
                            <div class="form-group">
                                <label for="numero_conta">N&uacute;mero da conta: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="numero_conta" name="numero_conta" maxlength="10">
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="digito_conta">D&iacute;gito da conta: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control" id="digito_conta" name="digito_conta" maxlength="1">
                            </div>
                            <div class="form-group">
                                <label for="chave_pix">Chave PIX:</label>
                                <input type="text" class="form-control" id="chave_pix" name="chave_pix" maxlength="200">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div>
                <div>
                    <fieldset>
                        <legend>Dados da opera&ccedil;&atilde;o</legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group" style="width: 30%;">
                                <label for="valor_solicitado">Valor solicitado: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control-file" id="valor_solicitado" name="valor_solicitado" placeholder="A partir de R$ 500,00">
                            </div>
                            <div class="form-group" style="width: 30%;">
                                <label for="parcelas">Quantidade de parcelas: <span class="obrigatorio">*</span></label>
                                <input type="number" class="form-control-file" id="parcelas" name="parcelas" placeholder="M&iacute;nimo 4 parcelas" maxlength="3">
                            </div>
                            <div class="form-group" style="width: 30%;">
                                <label for="mes_vencimento">Vencimetno 1&ordf; parcela: <span class="obrigatorio">*</span></label>
                                <input type="text" class="form-control-file" id="mes_vencimento" name="mes_vencimento" placeholder="M&ecirc;s de vencimento da 1&ordf; parcela" list="meses">
                                <datalist name="meses" id="meses">
                                    <option value="Janeiro">Janeiro</option>
                                    <option value="Fevereiro">Fevereiro</option>
                                    <option value="Mar&ccedil;o">Mar&cedil;o</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Maio">Maio</option>
                                    <option value="Junho">Junho</option>
                                    <option value="Julho">Julho</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Setembro">Setembro</option>
                                    <option value="Outubro">Outubro</option>
                                    <option value="Novembro">Novembro</option>
                                    <option value="Dezembro">Dezembro</option>
                                </datalist>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div>
                <div>
                    <fieldset>
                        <legend>Documentos</legend>
                        <div style="display: flex; justify-content: space-between;">
                            <div class="form-group">
                                <label for="identidade">Identidade completa: <span class="obrigatorio">*</span></label>
                                <input type="file" class="form-control-file" id="identidade" name="identidade" accept=".pdf,.jpg,.png">
                            </div>
                            <div class="form-group">
                                <label for="comprovante_endereco">Comprovante de endere&ccedil;o: <span class="obrigatorio">*</span></label>
                                <input type="file" class="form-control-file" id="comprovante_endereco" name="comprovante_endereco" accept=".pdf,.jpg,.png">
                            </div>
                            <div class="form-group">
                                <label for="outro_documentoF">Outro documento: </label>
                                <input type="file" class="form-control-file" id="outro_documento" name="outro_documento" accept=".pdf,.jpg,.png">
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <button id="enviar" class="btn-md btn-warning mt-3 btn-block mb-5 p-2" style="color: white;">Enviar</button>
        </form>
    </div>

    <!-- Adicionando Bootstrap JS (opcional, se necessário) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./src/js/mask.js"></script>
    <script src="./src/js/cpfcnpj.js"></script>
    <script>
        $(document).ready(function() {
            $('#telefone').mask('(99) 9999-99999');
            $('#cpf').mask('999.999.999-99');
            $('#data').mask('99/99/9999');
            $('#renda_mensal').mask('00.000,00', {
                reverse: true
            });
            $('#valor_solicitado').mask('000.000,00', {
                reverse: true
            });
            $('#parcelas').mask('999');
            $('#cep').mask('99999-999');

            $('#enviar').click(validar);
            $('.fechar').click(function() {
                $('.modal').css('display', 'none');
            });
        });
    </script>
</body>

</html>