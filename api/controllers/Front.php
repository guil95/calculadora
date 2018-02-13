<?php

/**
 * Description of Front
 *
 * @author guilherme
 */
class Front {

    private $params = array();

    public function __construct($params) {
        $this->params = $params;
    }

    public function getParam($name, $default = '') {
        return (isset($this->params[$name])) ? urldecode($this->params[$name]) : $default;
    }

    public function getParams() {
        return $this->params;
    }

}
