<?php

include_once("./mail/phpmailer/class.phpmailer.php");

class sendMail
{

	function __construct($emailDestino, $assunto, $msg = null, $anexo = null, $remetente = null, $arquivoAnexo = null, $semdata = null, $sendPulse = false, $copiaOculta = false, $envioTerceiro = false)
	{
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		

		//
		$fromName = trim(_TBZ_NOME_PADRAO_) ? _TBZ_NOME_PADRAO_ : 'TecBiz';
		$mail->FromName = "Email {$fromName}";
		$mail->CharSet = 'UTF-8';
		/**
		 * NUNCA PUBLICAR ABAIXO
		 */

		if ($emailDestino != '') {
			$emailDestino = is_array($emailDestino) ? join("; ", array_filter($emailDestino)) : $emailDestino;
			$msg = 'DESTINO ORIGINAL: ' . $emailDestino . '<br><br>' . $msg;
			$emailDestino = 'tecnologia@tecbiz.com.br';
			//$envioTerceiro = true;
		}

		/**
		 * NUNCA PUBLICAR ACIMA 
		 */

		$config = $this->getConfigGmail();
		//$mail->SMTPDebug = 2;
		$sendPulse = true;
		if ($sendPulse == true) {
			$config = $this->getConfigSendPulse();
		}

		if ($envioTerceiro) {
			$config = $this->getConfigTerceiro();
			//echo $this->remetente;
		}

		$mail->Host = $config->Host;
		$mail->SMTPSecure = $config->SMTPSecure;
		$mail->Port = $config->Port;
		$mail->Username = $config->Username;
		$mail->Password = $config->Password;
		$mail->From = $config->remetente;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->SMTPAuth = true;

		$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
		$data = "";
		if (!$semdata) {
			$data = " - " . date("d/m/Y H:i:s");
		}
		$assunto = "[TESTE] " . $assunto . $data;
		$mail->Subject = $assunto;

		if (is_array($emailDestino)) {
			foreach ($emailDestino as $dest) {

				if ($copiaOculta) {
					$mail->AddBCC($dest, $dest);
				} else {
					$mail->AddAddress($dest, $dest);
				}
			}
		} else {
			if ($copiaOculta) {
				$mail->AddBCC($emailDestino, $emailDestino);
			} else {
				$mail->AddAddress($emailDestino, $emailDestino);
			}
		}

		if ($arquivoAnexo) {
			$mail->AddAttachment($arquivoAnexo);
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
		$mail->remetente = "naoresponda@tecbiz.com.br";
		$mail->SMTPDebug = null;
		return $mail;
	}

	public function getConfigGmail()
	{
		$mail = new stdClass();
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		$mail->Username = "tecnologia@tecbiz.com.br";
		$mail->Password = "tecbiz18";
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

