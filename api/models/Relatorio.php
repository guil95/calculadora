<?php

/**
 * 
 *
 * @author Guilherme
 */
class Model_Relatorio {
    private $dataInicial;
    private $dataFinal;

    /**
     * @return mixed
     */
    public function getDataInicial()
    {
        return $this->dataInicial;
    }

    /**
     * @param mixed $dataInicial
     */
    public function setDataInicial($dataInicial)
    {
        $this->dataInicial = $dataInicial;
    }

    /**
     * @return mixed
     */
    public function getDataFinal()
    {
        return $this->dataFinal;
    }

    /**
     * @param mixed $dataFinal
     */
    public function setDataFinal($dataFinal)
    {
        $this->dataFinal = $dataFinal;
    }

    public function gerar(){
        if((!$this->dataInicial) or (!$this->dataFinal)){
            throw new \Exception('Data inicial e final são obrigatórios');
        }
        $dataInicial = $this->dataInicial . ' 00:00:00';
        $dataFinal = $this->dataFinal . ' 23:59:59';

        $conn = MyPdo::connect();
        $stmt = $conn->prepare("Select l.*, u.nome, u.login from log l inner join usuarios u where data BETWEEN :dataInicial and :dataFinal order by l.id desc");
        $stmt->bindParam('dataInicial', $dataInicial);
        $stmt->bindParam('dataFinal', $dataFinal);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($dados as &$dado){
            $data = explode(" ",$dado['data']);
            $dia = join('/',array_reverse(explode("-",$data[0])));
            $dado['data'] = $dia.' '.$data[1];
        }
        return $dados;
    }


}
