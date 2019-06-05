<?php namespace Support;

class CPF
{
    /**
     * Valida se numero do CPF é um numero valido.
     * 
     * @return bool
     */
    public static function validar($value)
    {
        $value = trim($value);

        // Verificar qtdade de digitos
        if (strlen($value) != 11) {
            return false;
        }

        // Checar 1o digito
        if (Modulo::digi11($value, 9) != $value[9]) {
            return false;
        }

        // Chegar 2o digito
        if (Modulo::digi11($value, 10) != $value[10]) {
            return false;
        }

        return true;
    }
}
