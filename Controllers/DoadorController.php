<?php

namespace Controllers;

use \Models\Doador;

class DoadorController
{
    public function index()
    {
        $data = \Server\Request::ValidateData([
            "email",
            "senha"
        ]);
        $idDoador = Doador::Login($data);
        if ($idDoador) {
            \Server\Response::Return(
                200,
                'Login feito com sucesso!',
                $idDoador,
                ["idDoador" => $idDoador, "email" => $data["email"], "senha" => $data["senha"]]
            );
        } else \Server\Response::Return(
            401,
            'Erro ao fazer o Login! Verifique o e-mail e/ou senha.',
            $idDoador
        );
    }
    public function cadastrar()
    {
        $data = \Server\Request::ValidateData([
            "nome",
            "email",
            "senha",
            "telefone",
            "CPF",
            "idade"
        ]);
        if (Doador::EmailExist($data["email"])) {
            \Server\Response::Return(
                400,
                'O e-mail já existe em nosso banco de dados! Tente um endereço de e-mail diferente.',
                false
            );
        } else {
            $result = Doador::Cadastro($data);
            \Server\Response::Return(
                $result ? 200 : 400,
                $result ? 'Usuário cadastrado com sucesso!' : 'Erro ao cadastrar o usuário.',
                $result,
                $result ? ["idDoador" => $result, "email" => $data["email"], "senha" => $data["senha"]] : []
            );
        }
    }
}
