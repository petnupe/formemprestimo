// comment

function validaCPF(cpf) {

	if (cpf.length < 11) {
		return false;
	}

	var nonNumbers = /\D/;

	if (nonNumbers.test(cpf)) {
		return false;
	}

	if (cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999") {
		return false;
	}

	var a = [];
	var b = new Number;
	var c = 11;
	for (i = 0; i < 11; i++) {
		a[i] = cpf.charAt(i);
		if (i < 9) {
			b += (a[i] * --c);
		}
	}
	if ((x = b % 11) < 2) {
		a[9] = 0;
	} else {
		a[9] = 11 - x;
	}
	b = 0;
	c = 11;
	for (y = 0; y < 10; y++) {
		b += (a[y] * c--);
	}
	if ((x = b % 11) < 2) {
		a[10] = 0;
	} else {
		a[10] = 11 - x;
	}
	if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10])) {
		return false;
	}
	return true;
}

function validaCNPJ(CNPJ) {
	var nonNumbers = /\D/;
	if (nonNumbers.test(CNPJ)) {
		return false;
	}

	var a = [];
	var b = new Number;
	var c = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

	for (i = 0; i < 12; i++) {
		a[i] = CNPJ.charAt(i);
		b += a[i] * c[i + 1];
	}

	if ((x = b % 11) < 2) {
		a[12] = 0;
	} else {
		a[12] = 11 - x;
	}

	b = 0;

	for (y = 0; y < 13; y++) {
		b += (a[y] * c[y]);
	}

	if ((x = b % 11) < 2) {
		a[13] = 0;
	} else {
		a[13] = 11 - x;
	}

	if ((CNPJ.charAt(12) != a[12]) || (CNPJ.charAt(13) != a[13])) {
		return false;
	}
	return true;
}

function validacpfCNPJ(cpfCNPJ) {

	if (cpfCNPJ.length == 11) {

		return validacpf(cpfCNPJ);

	} else {

		if (cpfCNPJ.length == 14) {

			return validaCNPJ(cpfCNPJ);

		} else {

			alert('cpf/CNPJ inv&aacute;lido');

		}

	}

}

function formatacpfCNPJ(cpfCNPJ) {

	if (cpfCNPJ.length == 11) {

		return formatacpf(cpfCNPJ);

	} else {

		if (cpfCNPJ.length == 14) {

			return formataCNPJ(cpfCNPJ);

		} else {

			alert('Nao e possível formatar cpf/CNPJ"');

		}

	}

}

function desformatacpfCNPJ(cpfCNPJ) {

	if (cpfCNPJ.length == 14) {

		return desformatacpf(cpfCNPJ);

	} else {

		if (cpfCNPJ.length == 18) {

			return desformataCNPJ(cpfCNPJ);

		} else {

			alert('Nao e poss�vel desformatar cpf/CNPJ"');

		}

	}

}

function formatacpf(cpf) {

	cpf = cpf.substr(0, 3) + '.' + cpf.substr(3, 3) + '.' + cpf.substr(6, 3) + '-' + cpf.substr(9, 2);

	return cpf;

}

function formataCNPJ(CNPJ) {

	CNPJ = CNPJ.substr(0, 2) + '.' + CNPJ.substr(2, 3) + '.' + CNPJ.substr(5, 3) + '/' + CNPJ.substr(8, 4) + '-' + CNPJ.substr(12, 2);

	return CNPJ;

}

function desformataCPF(CPF) {

	CPF = CPF.replace('.', '');
	CPF = CPF.replace('.', '');
	CPF = CPF.replace('-', '');

	return CPF;
}

function desformatacpf(CPF) {

	CPF = CPF.replace('.', '');
	CPF = CPF.replace('.', '');
	CPF = CPF.replace('-', '');

	return CPF;
}

function desformataCNPJ(CNPJ) {

	CNPJ = CNPJ.replace('.', '');

	CNPJ = CNPJ.replace('.', '');

	CNPJ = CNPJ.replace('-', '');

	CNPJ = CNPJ.replace('/', '');

	return CNPJ;

}

function filtra_digitos_cnpj(cnpj) {

	cnpj = cnpj.split('');

	var i = 0;

	var saida = '';

	for (i = 0; i < cnpj.length; i++) {

		if (cnpj[i] >= '0' && cnpj[i] <= '9') {

			saida += cnpj[i];

		}

	}

	saida = formataCNPJ(saida);

	return saida;

}

function filtra_digitos_cpf(cpf) {

	cpf = cpf.split('');

	var i = 0;

	var saida = '';

	for (i = 0; i < cpf.length; i++) {

		if (cpf[i] >= '0' && cpf[i] <= '9') {

			saida += cpf[i];

		}

	}

	saida = formatacpf(saida);

	return saida;

}

function filtra_digitos_numeros(numero) {

	numero = numero.split('');
	var i = 0;
	var saida = '';

	for (i = 0; i < numero.length; i++) {
		if ((numero[i] >= '0' || numero[i] >= 0) && (numero[i] <= '9' || numero[i] <= 9)) {
			saida += numero[i];
		}
	}

	saida = formata_valor(saida);
	return saida;
}

function formata_valor(valor) {
	var len = valor.length;
	var intini = 0;
	var inttam = len - 2;
	var decini = len - 2;
	var dectam = 2;
	valor = valor.substr(intini, inttam) + ',' + valor.substr(decini, dectam);
	return valor;
}

function informa_CNPJ(cnpj) {
	if (cnpj != '' && cnpj != '../-') {
		cnpj = desformataCNPJ(cnpj);
		if (validaCNPJ(cnpj) != true) {
			alert('CNPJ invalido!');
		}
	}
}

function informa_CPF(cpf, retornar, mensagem) {
	if (cpf != '' && cpf != '..-') {
		cpf = desformataCPF(cpf);

		if (validaCPF(cpf) != true) {
			if (retornar) {
				return false;
			} else {
				if (mensagem) {
					alert('**ATEN��O**\n\n!' + mensagem);
				} else {
					alert('**ATEN��O**\n\nCPF invalido!');
				}
			}
		}
	}
}

function filtra_caracteres_nao_numericos(numero) {
	numero = numero.split('');
	var i = 0;
	var saida = '';

	for (i = 0; i < numero.length; i++) {
		if (numero[i] >= '0' && numero[i] <= '9') {
			saida += numero[i];
		}
	}
	return saida;
}


function validarCartao() {

	let erroHTML = '';

	var regex = /^6298 69/;
	if ($('#cartao').val().length != 19 || !regex.test($('#cartao').val()))
		erroHTML += '<li>Número de Cartão inválido!</li>';

	if (erroHTML.length > 0) {
		$('#listaErros').html("<ul>" + erroHTML + "</ul>");
		$('.modal').css('display', 'block');
		event.preventDefault();
	} else {
		document.forms['0'].submit();
	}

}


function validar() {

	let erroHTML = '';

	if ($('#nome_completo').val().length < 3)
		erroHTML += '<li>Nome inválido!</li>';

	if (!validaCPF(filtra_caracteres_nao_numericos($('#cpf').val())))
		erroHTML += '<li>CPF inválido!</li>';

	if ($('#data_nascimento').val().length < 10)
		erroHTML += '<li>Data de nascimento inválida!</li>';

	if ($('#nome_mae').val().length < 3)
		erroHTML += '<li>Nome da Mãe inválido!</li>';

	if ($('#nacionalidade').val().length < 3)
		erroHTML += '<li>Nacionalidade inválida!</li>';

	if ($('#naturalidade').val().length < 3)
		erroHTML += '<li>Naturalidade inválida!</li>';

	if ($('#estado_civil').val().length < 3)
		erroHTML += '<li>Estado Civil inválido!</li>';

	if (!validarEmail($('#email').val()))
		erroHTML += '<li>Email inválido!</li>';

	if ($('#telefone').val().length < 14)
		erroHTML += '<li>Celular inválido!</li>';

	if ($('#nivel_escolaridade').val().length < 3)
		erroHTML += '<li>Nível de Escolaridade inválido!</li>';

	if ($('#ocupacao').val().length < 3)
		erroHTML += '<li>Ocupação inválida!</li>';

	if ($('#renda_mensal').val().length < 3)
		erroHTML += '<li>Renda Mensal inválida!</li>';

	if ($('#rua').val().length < 3)
		erroHTML += '<li>Rua inválida!</li>';

	if ($('#numero').val().length < 0)
		erroHTML += '<li>Número inválido!</li>';

	if ($('#cep').val().length < 9)
		erroHTML += '<li>CEP inválido!</li>';

	if ($('#bairro').val().length < 3)
		erroHTML += '<li>Bairro inválido!</li>';

	if ($('#uf').val().length < 2)
		erroHTML += '<li>UF inválido!</li>';

	if ($('#cidade').val().length < 3)
		erroHTML += '<li>Cidade inválida!</li>';

	if ($('#banco').val().length < 1)
		erroHTML += '<li>Banco inválido!</li>';

	if ($('#agencia').val().length < 1)
		erroHTML += '<li>Agência inválida!</li>';

	if ($('#tipo_conta').val().length < 3)
		erroHTML += '<li>Tipo de Conta inválido!</li>';

	if ($('#numero_conta').val().length < 1)
		erroHTML += '<li>Número da Conta inválido!</li>';

	if ($('#digito_conta').val().length < 1)
		erroHTML += '<li>Dígito da Conta inválido!</li>';

	if (!$('#parcelas').val() || $('#parcelas').val() < 4)
		erroHTML += '<li>Quantidade de parcelas inválida ou inferior a 4 parcelas!</li>';

	if (!$('#mes_vencimento').val() || $('#mes_vencimento').val().length < 4)
		erroHTML += '<li>Mês de vencimento da primeira parcela inválido!</li>';

	if (!$('#valor_solicitado').val() || converterParaNumero($('#valor_solicitado').val()) < 500)
		erroHTML += '<li>Valor Solicitado inválido ou inferior a R$ 500,00!</li>';

	if ($('#identidade').val().length < 3)
		erroHTML += '<li>Identidade inválida!</li>';

	if ($('#comprovante_endereco').val().length < 3)
		erroHTML += '<li>Comprovante de Endereço inválido!</li>';

	if (erroHTML.length > 0) {
		$('#listaErros').html("<ul>" + erroHTML + "</ul>");
		$('.modal').css('display', 'block');
		event.preventDefault();
	} else {
		if (confirm('Confirma o envio dos dados?')) {
			document.forms['0'].submit();
		} else {
			event.preventDefault();
		}
	}

}

function validarEmail(email) {
	// Expressão regular para validar o formato do e-mail
	const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	return re.test(email);
}

function converterParaNumero(valor) {
	let valorSemPontos = valor.replace(/\./g, '');
	let valorComPonto = valorSemPontos.replace(/,/, '.');
	let valorNumerico = parseFloat(valorComPonto);
	return valorNumerico;
}
