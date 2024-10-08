<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

include_once("./sendmail.php");

$baseDir = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'uploads') . DIRECTORY_SEPARATOR;
$mensagem = null;

//$emailDestino = $_REQUEST['emailDestino'];
$emailDestino = "credenciamento@tecbiz.com.br";

unset($_REQUEST['emailDestino']);
$dataAmericana = explode("-", $_REQUEST['data_nascimento']);
$_REQUEST['data_nascimento'] = $dataAmericana[2] . '/' . $dataAmericana[1] . "/" . $dataAmericana[0];

foreach ($_REQUEST as $key => $value) {
    $value = utf8_encode($value);
    $mensagem .= ucfirst(str_replace("_", " ", $key)) . ": " . $value . "<br />";
}

$string = http_build_query($_REQUEST);
$prefix = $_REQUEST['cartao'] . "-" . date('Ymd') . "-";

$rg             = $baseDir . $prefix . "RG." . pathinfo(basename($_FILES['identidade']['name']), PATHINFO_EXTENSION);
$compResidencia = $baseDir . $prefix . "CR." . pathinfo(basename($_FILES['comprovante_endereco']['name']), PATHINFO_EXTENSION);

move_uploaded_file($_FILES['identidade']['tmp_name'], $rg);
move_uploaded_file($_FILES['comprovante_endereco']['tmp_name'], $compResidencia);

$outro_documento = null;

if (trim($_FILES['outro_documento']['name']) != '') {
    move_uploaded_file($_FILES['outro_documento']['tmp_name'], $baseDir . basename($_FILES['outro_documento']['name'])) or die('Sem permissao 3');
    $outro_documento = $baseDir . basename($_FILES['outro_documento']['name']);
}

$arrayDestinos = array($emailDestino);

$mail = new sendMail($arrayDestinos, 'ETD - Formulário de empréstimo', utf8_decode($mensagem), null, null, $rg, null, true, null, null, $compResidencia, $outro_documento);
//$mail = new sendMail("peterson@tecbiz.com.br", 'ETD - Formulário de empréstimo', utf8_decode($mensagem), null, null,null, null, true, null, null);
echo '<script type="text/javascript">alert("Dados enviados com sucesso!"); window.location.href="../index.php";</script>';
