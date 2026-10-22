<?php
//CONFIGURAÇÃO
//Define a reposta da API, nesse caso em JSON
header("Content-Type: application/json;charset=utf-8");
//Define o acesso à API, nesse * quer dizer todas as origens
header("Acess-Control-Allow-Origin: *");
//Define os métodos que podem ser feitos nessa API
header("Acess-Control-Allow-Methods: GET, POST, PUT, DELETE");

require "config.php";

$rota = $_GET["rota"] ?? "";
$metodo = $_SERVER["REQUEST_METHOD"];

// variável para capturar as informações das requisições
$corpo = json_decode(file_get_contents("php://input"), true) ?? [];

function teste(){
    echo json_encode(["mensagem" => "Back-end respondendo com sucesso!"]);
    exit;
}
// FUNÇÕES - CRUD
//CREATE CLIENTE
function createCliente($con, $dados){
    $stmt = $con->prepare(
        "INSERT INTO CLIENTE (NOME, ENDERECO, TELEFONE, EMAIL)
            VALUES (?,?,?,?)"
    );
    $stmt->execute([$dados["nome"],
                   $dados["endereco"],
                   $dados["telefone"],
                   $dados["email"]]);
    http_response_code(201);
    echo json_encode(
        ["mensagem" => "Cliente criado com sucesso!",
        "id" => $con->lastInsertId()]
    );
}
//READ CLIENTE
function readCliente($con){
    $stmt = $con->query("SELECT * FROM Cliente");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC));
}
// UPDATE CLIENTE
function updateCliente($con, $id, $dados){
    $stmt = $con->prepare(
        "UPDATE Cliente SET nome = ?, endereco = ?, telefone = ?, email = ?
        WHERE idCliente = ?"
    );
    $stmt->execute([$dados["nome"],
                   $dados["endereco"],
                   $dados["telefone"],
                   $dados["email"],
                   $id]);
    echo json_encode(["mensagem" => "Cliente alterado com sucesso!"]);
}
//DELETE CLIENTE
function deleteCliente($con, $id){
    $stmt = $con->prepare("DELETE FROM Cliente WHERE idCliente = ?");
    $stmt->execute([$id]);
    echo json_encode(["mensagem" => "Cliente removido com sucesso!"]);
}

if ($rota === "cliente") {
    switch($metodo){
        case "POST":
            createCliente($con, $corpo);
            break;
        case "GET":
            readCliente($con);
            break;
        case "PUT":
            updateCliente($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deleteCliente($con, $_GET["id"]);
            break;
        default:
            teste();
    }
}
//FUNCIONARIO
function createFuncionario($con, $dados){
    $stmt = $con->prepare(
        "INSERT INTO FUNCIONARIO (NOME, CARGO, SALARIO)
            VALUES (?,?,?)"
    );
    $stmt->execute([$dados["nome"],
                   $dados["cargo"],
                   $dados["salário"]]);
    http_response_code(201);
    echo json_encode(
        ["mensagem" => "Funcionário cadastrado com sucesso!",
        "id" => $con->lastInsertId()]
    );
}
//READ FUNCIONARIO
function readFuncionario($con){
    $stmt = $con->query("SELECT * FROM Funcionario");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC));
}
// UPDATE FUNCIONARIO
function updateFuncionario($con, $id, $dados){
    $stmt = $con->prepare(
        "UPDATE Funcionario SET nome = ?, cargo = ?, salario = ?
        WHERE idFuncionario = ?"
    );
    $stmt->execute([$dados["nome"],
                   $dados["cargo"],
                   $dados["salário"],
                   $id]);
    echo json_encode(["mensagem" => "Funcionário alterado com sucesso!"]);
}
//DELETE FUNCIONARIO
function deleteFuncionario($con, $id){
    $stmt = $con->prepare("DELETE FROM Funcionario WHERE idFuncionario = ?");
    $stmt->execute([$id]);
    echo json_encode(["mensagem" => "Funcionário removido com sucesso!"]);
}

if ($rota === "funcionario") {
    switch($metodo){
        case "POST":
            createFuncionario($con, $corpo);
            break;
        case "GET":
            readFuncionario($con);
            break;
        case "PUT":
            updateFuncionario($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deleteFuncionario($con, $_GET["id"]);
            break;
        default:
            teste();
    }
}
//VEICULO
function createVeiculo($con, $dados){
    $stmt = $con->prepare(
        "INSERT INTO FUNCIONARIO (PLACA, MODELO, CAPACIDADE)
            VALUES (?,?,?)"
    );
    $stmt->execute([$dados["placa"],
                   $dados["modelo"],
                   $dados["capacidade"]]);
    http_response_code(201);
    echo json_encode(
        ["mensagem" => "Veículo cadastrado com sucesso!",
        "id" => $con->lastInsertId()]
    );
}
//READ VEICULO
function readVeiculo($con){
    $stmt = $con->query("SELECT * FROM Veiculo");
    echo json_encode(
        $stmt->fetchAll(PDO::FETCH_ASSOC));
}
// UPDATE VEICULO
function updateVeiculo($con, $id, $dados){
    $stmt = $con->prepare(
        "UPDATE Veiculo SET placa = ?, modelo = ?, capacidade = ?
        WHERE idVeiculo = ?"
    );
    $stmt->execute([$dados["placa"],
                   $dados["modelo"],
                   $dados["capacidade"],
                   $id]);
    echo json_encode(["mensagem" => "Veículo alterado com sucesso!"]);
}
//DELETE VEICULO
function deleteVeiculo($con, $id){
    $stmt = $con->prepare("DELETE FROM Veiculo WHERE idVeiculo = ?");
    $stmt->execute([$id]);
    echo json_encode(["mensagem" => "Veículo removido com sucesso!"]);
}

if ($rota === "veiculo") {
    switch($metodo){
        case "POST":
            createVeiculo($con, $corpo);
            break;
        case "GET":
            readVeiculo($con);
            break;
        case "PUT":
            updateVeiculo($con, $_GET["id"], $corpo);
            break;
        case "DELETE":
            deleteVeiculo($con, $_GET["id"]);
            break;
        default:
            teste();
    }
}