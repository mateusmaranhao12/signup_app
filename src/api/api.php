<?php

    //incluindo banco de dados
    include "db.php";

    include "connection.php";

    //ações de erro em cada value
    $res_output = array('nome'=> false, 'error' => false, 'email'=> false, 'senha' => false);
 
    //ler dados do back-end
    $acao = 'ler_dados';

    if (isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    }

    if ($acao == 'ler_dados') {
       $sql = 'SELECT * FROM clientes';
       $query = $db_conn->query($sql);
       $clientes = array();

        while($row = $query->fetch_array()){
            array_push($clientes, $row);
        }

        $res_output['clientes'] = $clientes;
    }


    //registrar cliente
    if ($acao == 'registrar') {

        function checkStr($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $nome = checkStr($_POST['nome']);
        $email = checkStr($_POST['email']);
        $senha = checkStr($_POST['senha']);

        if ($nome == '') {

            $res_output['nome'] = true;
            $res_output['mensagem'] = 'Informe seu nome!';

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){

            $res_output['email'] = true;
            $res_output['mensagem'] = 'Informe seu e-mail!';

        } else if ($senha == '') {

            $res_output['senha'] = true;
            $res_output['mensagem'] = 'Informe sua senha!';

        } else {
            $sql= "SELECT * from clientes where email='$email'";
            $query = $db_conn->query($sql);

            if ($query->num_rows > 0) {

                $res_output['email'] = true;
                $res_output['mensagem'] = 'Cliente já cadastrado';

            } else {

                $sql = "INSERT INTO clientes (nome, email, senha) values ('$nome', '$email', '$senha')"; 
                $query = $db_conn->query($sql);

                if ($query) {
                    $res_output['mensagem'] = 'Cliente adicionado com sucesso :)';
                } else {
                    $res_output['error'] = true;
                    $res_output['mensagem'] = 'Não foi possível adicionar o cliente :(';
                }

            }
        }

    }

    $db_conn->close();
    //simple pass a json format data in php 
    header("Content-type: application/json");
    echo json_encode($res_output);
    die();

?>