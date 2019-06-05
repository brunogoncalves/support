<?php namespace Support;

class CNPJ
{
    /**
     * Valida se numero do CNPJ é um numero valido.
     * 
     * @return bool
     */
    public static function validar($value)
    {
        $value = trim($value);

        // Validar digitos
        if (strlen($value) != 14) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 11.111.111/1111-11
        if (preg_match('/(\d)\1{13}/', $value)) {
            return false;
        }        

        // Criar Matriz de 14 posicoes
        $matriz = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; // 14 numeros
        for ($i = 1; $i <= 14; $i++) {
            $matriz[$i] = intval($value[$i - 1]);
        }

        // Validar o primeiro digito
        $soma = 0;

        for ($i = 12; $i >= 5; $i--) {
            $soma = ($matriz[$i] * ((12 - $i) + 2)) + $soma;
        }

        for ($i = 4; $i >= 1; $i--) {
            $soma = ($matriz[$i] * ((4 - $i) + 2)) + $soma;
        }

        $resultado = $soma - (intval($soma / 11) * 11);
        $val = (($resultado < 2) ? 0 : (11 - $resultado));
        if ($val != $matriz[13]) {
            return false;
        }

        // Validar o segundo digito
        $soma = 0;

        for ($i = 13; $i >= 6; $i--) {
            $soma = ($matriz[$i] * ((13 - $i) + 2)) + $soma;
        }

        for ($i = 5; $i >= 1; $i--) {
            $soma = ($matriz[$i] * ((5 - $i) + 2)) + $soma;
        }

        $resultado = $soma - (intval($soma / 11) * 11);
        $val = (($resultado < 2) ? 0 : (11 - $resultado));
        if ($val != $matriz[14]) {
            return false;
        }

        return true;
    }
}
