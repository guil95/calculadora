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

    private $metodos = [
        self::ADICAO => 'Adição',
        self::SUBTRACAO => 'Subtração',
        self::MULTIPLICACAO => 'Multiplicação',
        self::DIVISAO => 'Divisão',
        self::RAIZ => 'Raiz',
        self::PORCENTAGEM => 'Porcentagem'
    ];

    private $metodo;
    private $valor1;
    private $valor2;

    public function calcular(){

        switch ($this->metodo){
            case self::ADICAO:
                return $this->adicao();
                break;
            case self::SUBTRACAO:
                return $this->subtracao();
                break;
            case self::MULTIPLICACAO:
                return $this->multiplicacao();
                break;
            case self::DIVISAO:
                return $this->divisao();
                break;
            case self::RAIZ:
                return $this->raiz();
                break;
            case self::PORCENTAGEM:
                return $this->porcentagem();
                break;
            default:
                return 0;
                break;
        }
    }

    private function saveLog(){
        try{
            $datetime = date('Y-m-d H:i:s');
            $conn = MyPdo::connect();
            $stmt = $conn->prepare("Insert into log (data, operacao, id_usuario) values (:data, :operacao, :id_usuario)");
            $stmt->bindParam('data',$datetime );
            $stmt->bindParam('operacao', $this->metodos[$this->getMetodo()]);
            $stmt->bindParam('id_usuario', $_SESSION['usuario']);
            $stmt->execute();
        }catch(\Exception $e){
            throw new \Exception('Falha ao salvar usuario');
        }

    }

    private function adicao(){
        $this->saveLog();
        return $this->valor1 + $this->valor2;
    }

    private function subtracao(){
        $this->saveLog();
        return $this->valor1 - $this->valor2;
    }

    private function multiplicacao(){
        $this->saveLog();
        return $this->valor1 * $this->valor2;
    }

    private function divisao(){
        $this->saveLog();
        if($this->valor2 == 0){
            throw new \Exception('Divisão por zero inválida');
        }
        return $this->valor1 / $this->valor2;
    }

    private function raiz(){
        $this->saveLog();
        if($this->valor1 <= 0){
            return 0;
        }
        $x = 1;
        while ( $x << 2 < $this->valor1 ) ++$x;

        for ( $i = 0 , $t = 14 ; $x != $this->valor1 && $i < $t ; ++$i , $x = 0.5 * ( $x + $this->valor1 / $x ) );

        return $x;
    }

    private function porcentagem(){
        $this->saveLog();
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
