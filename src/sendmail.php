<?php
include_once("./mail/phpmailer/class.phpmailer.php");

class sendMail
{

        function __construct($emailDestino, $assunto, $msg = null, $anexo = null, $remetente = null, $arquivoAnexo = null, $semdata = null, $sendPulse = false, $copiaOculta = false, $envioTerceiro = false, $arquivoAnexo2 = null, $arquivoAnexo3)
        {
                
                //$emailDestino = $emailDestino;
		$assunto = urlencode($assunto);
		//$msg = urlencode($msg);

		// Criando a URL completa
		$url = "http://www1.tecbiz.com.br/teste/enviaEmail.php?emailDestino=".$emailDestino."&assunto={$assunto}&msg=".urlencode($msg);
		// Usando @ para suprimir warnings e adicionar tratamento de erro
		$response = @file_get_contents($url);
		return;

                
                
                $mail = new PHPMailer(true);
                $mail->IsSMTP();
                $remetente = "naoresponda@tecbiz.com.br";

                $mail->SMTPDebug = 2;

                $mail->From = $remetente;
                $fromName =  'TecBiz';
                $mail->FromName = "Email {$fromName}";
                $mail->CharSet = 'UTF-8';

                $config = $this->getConfigGmail();

                $sendPulse = true;

                if ($sendPulse = true) {
                        $config = $this->getConfigSendPulse();
                }

                if ($envioTerceiro) {
                        $config = $this->getConfigTerceiro();
                }

                $mail->Host = $config->Host;
                $mail->SMTPSecure = $config->SMTPSecure;
                $mail->Port = $config->Port;

                $mail->SMTPDebug = $config->SMTPDebug;
                $mail->Username = $config->Username;
                $mail->Password = $config->Password;

                $mail->WordWrap = 50;
                $mail->IsHTML(true);
                $mail->SMTPAuth = true;

                $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
                $data = "";
                if (!$semdata) {
                        $data = " - " . date("d/m/Y H:i:s");
                }
                $assunto = $assunto . $data;
                $mail->Subject = $assunto;

                if (is_array($emailDestino)) {
                        foreach ($emailDestino as $dest) {

                                // $mail->AddAddress($dest, $dest);

                                if ($copiaOculta) {
                                        $mail->AddBCC($dest, $dest);
                                } else {
                                        $mail->AddAddress($dest, $dest);
                                }
                        }
                } else {
                        // $mail->AddAddress($emailDestino, $emailDestino);

                        if ($copiaOculta) {
                                $mail->AddBCC($emailDestino, $emailDestino);
                        } else {
                                $mail->AddAddress($emailDestino, $emailDestino);
                        }
                }

                if ($arquivoAnexo) {
                        $mail->AddAttachment($arquivoAnexo);
                }

                if ($arquivoAnexo2) {
                        $mail->AddAttachment($arquivoAnexo2);
                }

                if ($arquivoAnexo3) {
                        $mail->AddAttachment($arquivoAnexo3);
                }

                if ($anexo) {
                        $file = file("/var/log/tecbiz/" . $anexo . ".txt");
                        $msg = "Log número: " . $anexo . "<br />";
                        foreach ($file as $ln) {
                                $msg .= $ln . "<br />";
                        }
                }

                $mail->Body = utf8_encode($msg);

                if (!$mail->Send()) {
                        print("\n" . $mail->ErrorInfo . "\n");
                } else {
                        //print "\nMensagem enviada\n\n";
                }
        }

        public function getConfigSendPulse()
        {
                // Alterado o fornecedor
                $mail = new stdClass();
                $mail->Host = "smtplw.com.br";
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->Username = "tecbizcorp";
                $mail->Password = "2726oQcjbQmGd";
                $mail->SMTPDebug = null;
                return $mail;
        }

        public function getConfigGmail()
        {
                $mail = new stdClass();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->Username = "atendimento@tecbiz.com.br";
                $mail->Password = "t3cb1z@22";
                $mail->SMTPDebug = null;
                return $mail;
        }

        public function getConfigTerceiro()
        {
                $mail = new stdClass();
                $mail->Host = "smtp.izicartoes.com.br";
                $mail->SMTPSecure = false;
                $mail->SMTPAutoTLS = true;
                $mail->Port = 587;
                $mail->Username = "atendimento@izicartoes.com.br";
                $mail->Password = "izi$12345";
                $mail->remetente = "atendimento@izicartoes.com.br";
                $mail->SMTPDebug = null;
                return $mail;
        }
}
