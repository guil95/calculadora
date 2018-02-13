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
        }
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
