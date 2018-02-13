<?php

/**
 * Description of _Calculadora
 *
 * @author Guilherme
 */
class Model_Usuario {
    private $nome;
    private $login;
    private $senha;
    private $erro = [];

    /**
     * @return mixed
     */
    public function getNome()
    {

        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $erro = [];

        if(!trim($nome)){
            $this->erro[] = 'Nome não pode ser vazio';

        }

        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {

        if(!filter_var($login, FILTER_VALIDATE_EMAIL)){
            $this->erro[]  = 'Digite um email valido';
        }

        if(!trim($login)){
            $this->erro[] = 'Email não pode ser vazio';

        }

        $conn = MyPdo::connect();
        $stmt = $conn->prepare('Select * from usuarios where login = :login');
        $stmt->bindParam('login', $login);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($data){
            $this->erro[]  = 'Usuário ja cadastrado para este email';
        }

        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha)
    {


        if(!trim($senha)){
            $this->erro[] = 'Senha não pode ser vazio';

        }

        $this->senha = md5($senha);
    }


    public function salvar(){
        $this->validErrors();

        try{
            $conn = MyPdo::connect();
            $stmt = $conn->prepare("Insert into usuarios (nome, senha, login) values (:nome, :senha, :login)");
            $stmt->bindParam('nome', $this->nome);
            $stmt->bindParam('senha', $this->senha);
            $stmt->bindParam('login', $this->login);

            $stmt->execute();
        }catch(\Exception $e){
            throw new \Exception('Falha ao salvar usuario');
        }


    }

    public function autenticar(){
        try{
            $conn = MyPdo::connect();
            $stmt = $conn->prepare("Select * from usuarios where login = :login and senha = :senha");
            $stmt->bindParam('senha', $this->senha);
            $stmt->bindParam('login', $this->login);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$data){
                throw new \Exception('Usuário ou senha inválidos');
            }

        }catch(\Exception $e){
            throw new \Exception('Usuário ou senha inválidos');
        }

        return $data;
    }

    private function validErrors(){
        if($this->erro){
            throw new \Exception(join(', ',$this->erro));
            exit;
        }
     }

}
