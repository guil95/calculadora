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
        $logado = file_get_contents('temp/tmp.json');
        $logado = json_decode($logado,1);
        if($logado['logado'] == 2){
            print_r(json_encode(
                [
                    'message'=>'Usuário precisa estar logado',
                    'erro' => 9
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
