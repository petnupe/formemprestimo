<?php

include_once("./sendmail.php");

$mensagem = null;
foreach ($_REQUEST as $key => $value)
    $mensagem .= ucfirst(str_replace("_", " ", $key)) . ": " . $value . "<br />";

move_uploaded_file($_FILES['identidade']['tmp_name'], '../uploads/' . basename($_FILES['identidade']['name']));
move_uploaded_file($_FILES['comprovante_endereco']['tmp_name'], '../uploads/' . basename($_FILES['comprovante_endereco']['name']));

$rg = '../uploads/' . basename($_FILES['identidade']['name']);
$compResidencia = '../uploads/' . basename($_FILES['comprovante_endereco']['name']);

$mail = new sendMail(array('peterson@tecbiz.com.br', 'credenciamento@tecbiz.com.br', 'oseias@tecbiz.com.br'), 'Form empréstimo', $mensagem, null, null, $rg, null, true, false, false, $compResidencia);



echo '<script type="text/javascript">alert("Dados enviados com sucesso!"); window.location.href="../form.html";</script>';
