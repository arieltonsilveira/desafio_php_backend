<?php

/**
* Retorna a temperatura mais proxima de zero.
* Se duas temperaturas com o mesmo valor absouto (uma positiva e outra negativa) serem igualmente proxima a zero, deve ser dada a preferencia para o valor positivo.
* @param array $temperaturas Lista de temperaturas
* @return int A temperatura mais proxima de zero
**/
function menorTemperatura($temperaturas) {
	$resultado = separarTemperaturaPositivaNegativa($temperaturas);
	ordenaArrayPositivo($resultado["positivo"]);
	ordenaArrayNegativo($resultado["negativo"]);

	if (verificaPorTemperaturaPositiva($resultado)) {
		return maiorTemperaturaNegativa($resultado);
	}

	if (verificaPorTemperaturaNegativa($resultado)) {
		return menorTemperaturaPositiva($resultado);
	}

	if (converterNegativoParaPositivo(maiorTemperaturaNegativa($resultado)) >= menorTemperaturaPositiva($resultado)) {
		return menorTemperaturaPositiva($resultado);
	}

	return maiorTemperaturaNegativa($resultado);
}

function separarTemperaturaPositivaNegativa($temperaturas) {
	$temperaturaPositiva = array();
	$temperaturaNegativa = array();
	foreach ($temperaturas as $temperatura) {
		if ($temperatura >= 0) {
			array_push($temperaturaPositiva, $temperatura);
		} else {
			array_push($temperaturaNegativa, $temperatura);
		}
	}

	return [
		"positivo" => $temperaturaPositiva,
		"negativo" => $temperaturaNegativa
	];
}

function ordenaArrayPositivo(&$temperaturas) {
	sort($temperaturas);
}

function ordenaArrayNegativo(&$temperaturas) {
	rsort($temperaturas);
}

function menorTemperaturaPositiva($temperaturas) {
	return $temperaturas["positivo"][0];
}

function maiorTemperaturaNegativa($temperaturas) {
	return $temperaturas["negativo"][0];
}

function verificaPorTemperaturaPositiva($temperaturas) {
	return !isset($temperaturas["positivo"][0]);
}

function verificaPorTemperaturaNegativa($temperaturas) {
	return !isset($temperaturas["negativo"][0]);
}

function converterNegativoParaPositivo($valor) {
	return $valor * -1;
}

/***** Teste 01 *****/
$temperaturas = array( 17, 32, 14, 21 );
$resultadoEsperado = 14;
$resultado = menorTemperatura($temperaturas);
verificaResultado("01", $resultadoEsperado, $resultado);


/***** Teste 02 *****/
$temperaturas = array( 27, -8, -12, 9 );
$resultadoEsperado = -8;
$resultado = menorTemperatura($temperaturas);
verificaResultado("02", $resultadoEsperado, $resultado);


/***** Teste 03 *****/
$temperaturas = array( -6, 14, 42, 6, 25, -18 );
$resultadoEsperado = 6;
$resultado = menorTemperatura($temperaturas);
verificaResultado("03", $resultadoEsperado, $resultado);


/***** Teste 04 *****/
$temperaturas = array( 34, 11, 13, -23, -11, 18 );
$resultadoEsperado = 11;
$resultado = menorTemperatura($temperaturas);
verificaResultado("04", $resultadoEsperado, $resultado);


/***** Teste 05 *****/
$temperaturas = array( 17, 0, 28, -4 );
$resultadoEsperado = 0;
$resultado = menorTemperatura($temperaturas);
verificaResultado("05", $resultadoEsperado, $resultado);

/***** Teste 06 *****/
$temperaturas = array( -10, 27, 9, -12 );
$resultadoEsperado = 9;
$resultado = menorTemperatura($temperaturas);
verificaResultado("06", $resultadoEsperado, $resultado);

/***** Teste 07 *****/
$temperaturas = array( -47, -14, -5, -12, -8 );
$resultadoEsperado = -5;
$resultado = menorTemperatura($temperaturas);
verificaResultado("07", $resultadoEsperado, $resultado);

/***** Teste 08 *****/
$temperaturas = array( -47, -14, -5, -12, -5 );
$resultadoEsperado = -5;
$resultado = menorTemperatura($temperaturas);
verificaResultado("08", $resultadoEsperado, $resultado);

/***** Teste 09 *****/
$temperaturas = array( -7, 12, -13, 8 );
$resultadoEsperado = -7;
$resultado = menorTemperatura($temperaturas);
verificaResultado("09", $resultadoEsperado, $resultado);


function verificaResultado($nTeste, $resultadoEsperado, $resultado) {
	if(intval($resultadoEsperado) === intval($resultado)) {
		echo "Teste $nTeste passou.\n";
	} else {
		echo "Teste $nTeste NAO passou (Resultado esperado = $resultadoEsperado, Resultado obtido = $resultado).\n";
	}
}

?>