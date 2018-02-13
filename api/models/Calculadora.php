<?php

/**
 * Description of _Calculadora
 *
 * @author Guilherme
 */
class Model_Calculadora {
    const ADICAO = 1;
    const SUBTRACAO = 2;
    const MULTIPLICACAO = 3;
    const DIVISAO = 4;
    const RAIZ = 5;
    const PORCENTAGEM = 6;

    private $metodo;
    private $valor1;
    private $valor2;

    public function calcular(){
        switch ($this->metodo){
            case self::ADICAO:
                return $this->valor1 + $this->valor2;
                break;
            case self::SUBTRACAO:
                return $this->valor1 - $this->valor2;
                break;
            case self::MULTIPLICACAO:
                return $this->valor1 * $this->valor2;
                break;
            case self::DIVISAO:
                return $this->valor1 / $this->valor2;
                break;
            case self::RAIZ:
                return $this->raiz();
                break;
            case self::PORCENTAGEM:
                return $this->porcentagem();
                break;
        }
    }

    private function raiz(){
        $x = 1;
        while ( $x << 2 < $this->valor1 ) ++$x;

        for ( $i = 0 , $t = 14 ; $x != $this->valor1 && $i < $t ; ++$i , $x = 0.5 * ( $x + $this->valor1 / $x ) );

        return $x;
    }

    private function porcentagem(){
        return ($this->valor1 * $this->valor2) / 100;
    }
    /**
     * @return mixed
     */
    public function getMetodo()
    {
        return (int) $this->metodo;
    }

    /**
     * @param mixed $metodo
     */
    public function setMetodo($metodo)
    {
        $this->metodo = (int) $metodo;
    }

    /**
     * @return mixed
     */
    public function getValor1()
    {
        return (float) $this->valor1;
    }

    /**
     * @param mixed $valor1
     */
    public function setValor1($valor1)
    {
        $this->valor1 = (float) $valor1;
    }

    /**
     * @return mixed
     */
    public function getValor2()
    {
        return (float) $this->valor2;
    }

    /**
     * @param mixed $valor2
     */
    public function setValor2($valor2)
    {
        $this->valor2 = (float) $valor2;
    }


}
