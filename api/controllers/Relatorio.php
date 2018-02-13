<?php

/**
 * Description of Index
 *
 * @author Guilherme
 */
class Relatorio extends Front {

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
        $dataInicial = getPost('dataInicial');
        $dataFinal = getPost('dataFinal');

        $relatorioModel = new Model_Relatorio();

        $relatorioModel->setDataInicial($dataInicial);
        $relatorioModel->setDataFinal($dataFinal);

        try{
            $data = $relatorioModel->gerar();
        }catch(\Exception $e){
            $message = $e->getMessage();
            print_r(json_encode(compact('message')));
            return;
        }


        print_r(json_encode(compact('data')));
        return;

    }


}
