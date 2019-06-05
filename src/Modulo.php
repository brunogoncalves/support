<?php namespace Support;

class Modulo
{
    /**
     * Retorna o módulo 11 para calclular de CPF e CNPJ por exemplo.
     * 
     * @param string $value
     * @param int|false $len Tamanho da string que precisará ser validada.
     * @return int
     */
    public static function digi11($value, $len = false)
    {
        $len  = ($len === false) ? strlen($value) : $len;
        $soma = 0;

        for ($i = 1; $i <= $len; $i++) {
            $soma = $soma + (intval($value[$i - 1]) * ((($len + 1) - $i) + 1));
        }

        $resto = $soma - (intval($soma / 11) * 11);
        $val = (($resto < 2) ? 0 : (11 - $resto));

        return $val;
    }
}
