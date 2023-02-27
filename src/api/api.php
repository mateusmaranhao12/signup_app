<?php

    //incluindo banco de dados
    include "db.php";

    //requisições para conectar com o banco de dados
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Decida se a origem em $_SERVER['HTTP_ORIGIN'] é uma
        // você deseja permitir e, em caso afirmativo:
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 1000');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                // também pode estar usando PUT, PATCH, HEAD etc
                header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
        }
    
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
        }
        exit(0);
    }

    $res_output = array('nome'=> false, 'error' => false, 'email'=> false, 'senha' => false);
 
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