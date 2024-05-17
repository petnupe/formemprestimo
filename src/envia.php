<?php

include_once("../../tecbiz/logica/elementos/sendmail.php");
$mail = new sendMail('peterson@tecbiz.com.br', 'form emprestimo', 'mensagem do form emprestimo', null, null, null, null, true);
die('vou enviar os dados');
