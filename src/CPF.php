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

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $value)) {
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
