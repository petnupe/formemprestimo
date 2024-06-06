<?php
include_once("./sendmail.php");


$baseDir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads') . DIRECTORY_SEPARATOR;
$mensagem = null;
foreach ($_REQUEST as $key => $value)
    $mensagem .= ucfirst(str_replace("_", " ", $key)) . ": " . $value . "<br />";

move_uploaded_file($_FILES['identidade']['tmp_name'], $baseDir . basename($_FILES['identidade']['name'])) or die('Sem permissao');
move_uploaded_file($_FILES['comprovante_endereco']['tmp_name'], $baseDir . basename($_FILES['comprovante_endereco']['name'])) or die('Sem permissao');
move_uploaded_file($_FILES['outro_documento']['tmp_name'], $baseDir . basename($_FILES['outro_documento']['name'])) or die('Sem permissao');

$rg = $baseDir . basename($_FILES['identidade']['name']);
$compResidencia = $baseDir . basename($_FILES['comprovante_endereco']['name']);
$outro_documento = $baseDir . basename($_FILES['outro_documento']['name']);

//$arrayDestinos = array('peterson@tecbiz.com.br', 'credenciamento@tecbiz.com.br', 'oseias@tecbiz.com.br');
$arrayDestinos = array('peterson@tecbiz.com.br');

$mail = new sendMail($arrayDestinos, 'Formulário de empréstimo', $mensagem, null, null, $rg, null, true, false, true, $compResidencia, $outro_documento);

echo '<script type="text/javascript">alert("Dados enviados com sucesso!"); window.location.href="../form.html";</script>';
