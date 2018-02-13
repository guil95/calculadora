<?php

/**
 * Description of Index
 *
 * @author Guilherme
 */
class Calculadora extends Front {

    //sempre implementar método parent::construct
    public function __construct($params) {
        parent::__construct($params);
        if(!isset($_SESSION['logado'])){
            print_r(json_encode(
                [
                    'message'=>'Usuário precisa estar logado'
                ]
            ));

            exit;
        }
    }

    public function index() {
        $metodo = getPost('metodo');
        $valor1 = getPost('valor1');
        $valor2 = getPost('valor2');
        $calculadoraModel = new Model_Calculadora();

        $calculadoraModel->setValor1($valor1);
        $calculadoraModel->setMetodo($metodo);

        if($valor2 != ''){
            $calculadoraModel->setValor2($valor2);
        }

        try{
            $data = $calculadoraModel->calcular();
        }catch(\Exception $e){
            $message = $e->getMessage();
            print_r(json_encode(compact('message')));
            return;
        }


        print_r(json_encode(compact('data')));
        return;



    }


}
