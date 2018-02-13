<?php

/**
 * Description of Front
 *
 * @author guilherme
 */
class Front {

    private $params = array();

    public function __construct($params) {
//        if(!isset($_SESSION['logado'])){
//            print_r(json_encode(
//                [
//                    'message'=>'Usuário precisa estar logado'
//                ]
//            ));
//
//            exit;
//        }

        $this->params = $params;
    }

    public function getParam($name, $default = '') {
        return (isset($this->params[$name])) ? urldecode($this->params[$name]) : $default;
    }

    public function getParams() {
        return $this->params;
    }

}
