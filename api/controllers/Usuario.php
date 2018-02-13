<?php

/**
 * Description of Index
 *
 * @author Guilherme
 */
class Usuario extends Front {

    //sempre implementar método parent::construct
    public function __construct($params) {
        parent::__construct($params);
    }

    public function index() {
       $conn = MyPdo::connect();
       $stmt = $conn->prepare('Select nome, login from usuarios');
       $stmt->execute();
       $data = $stmt->fetchAll(PDO::FETCH_ASSOC);


        print_r(json_encode(compact('data')));
        return;



    }
    
    public function salvar(){
        $nome = getPost('nome');
        $login = getPost('login');
        $senha = getPost('senha');
        
        try{
            $usuarioModel = new Model_Usuario();
            $usuarioModel->setSenha($senha);
            $usuarioModel->setNome($nome);
            $usuarioModel->setLogin($login);
            $usuarioModel->salvar();
        }catch(\Exception $e){
            $message = $e->getMessage();
            print_r(json_encode(compact('message')));
            return;
        }

        $data = 'Usuario salvo com sucesso';
        print_r(json_encode(compact('data')));
        return;
    }

    public function autenticar(){
        $login = getPost('login');
        $senha = getPost('senha');

        try{
            $usuarioModel = new Model_Usuario();
            $usuarioModel->setLogin($login);
            $usuarioModel->setSenha($senha);

            $usuario = $usuarioModel->autenticar();
        }catch(\Exception $e){
            $message = $e->getMessage();
            print_r(json_encode(compact('message')));
            return;
        }
        file_put_contents('temp/tmp.json', json_encode(['logado' => 1, 'usuario' =>$usuario['id'] ]));

        print_r(json_encode(['token' => 'logado']));
        return;
    }

    public function logout(){
        unlink('temp/tmp.json');
        print_r(json_encode(['deslogado' => true]));
    }


}
