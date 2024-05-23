<?php

include_once("./sendmail.php");

$mensagem = null;
foreach ($_REQUEST as $key => $value)
    $mensagem .= ucfirst(str_replace("_", " ", $key)) . ": " . $value . "<br />";

move_uploaded_file($_FILES['identidade']['tmp_name'], '../uploads/' . basename($_FILES['identidade']['name']));
move_uploaded_file($_FILES['comprovante_endereco']['tmp_name'], '../uploads/' . basename($_FILES['comprovante_endereco']['name']));
move_uploaded_file($_FILES['outro_documento']['tmp_name'], '../uploads/' . basename($_FILES['outro_documento']['name']));

$rg = '../uploads/' . basename($_FILES['identidade']['name']);
$compResidencia = '../uploads/' . basename($_FILES['comprovante_endereco']['name']);
$outro_documento = '../uploads/' . basename($_FILES['outro_documento']['name']);

$arrayDestinos = array('peterson@tecbiz.com.br', 'credenciamento@tecbiz.com.br', 'oseias@tecbiz.com.br');
//$arrayDestinos = array('peterson@tecbiz.com.br');

$mail = new sendMail($arrayDestinos, 'Formulário de empréstimo', $mensagem, null, null, $rg, null, true, false, true, $compResidencia, $outro_documento);

echo '<script type="text/javascript">alert("Dados enviados com sucesso!"); window.location.href="../form.html";</script>';
