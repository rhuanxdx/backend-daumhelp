<?php

namespace Models;

class Doador extends \Core\Model
{
    public static function Login(array $arr): int
    {
        try {
            $db = Self::Get();
            $query = $db->prepare("SELECT idDoador FROM Doador WHERE EmailDoador = :email AND Senha = :senha");
            $query->execute(array(
                ":email" => $arr["email"],
                ":senha" => md5($arr["senha"]),
            ));
            $data = $query->fetch();
            return $data ? $data["idDoador"] : false;
        } catch (\Throwable $th) {
            print_r($th->getMessage());
            return false;
        }
    }
    public static function EmailExist(string $email): bool
    {
        try {
            $db = Self::Get();
            $query = $db->prepare("SELECT EmailDoador FROM Doador WHERE EmailDoador = ?");
            $query->execute([trim($email)]);
            return (bool)$query->fetch();
        } catch (\Throwable $th) {
            return false;
        }
    }
    public static function Cadastro(array $arr): int
    {
        try {
            $db = Self::Get();
            $query = $db->prepare("Insert into Doador (
            EmailDoador,
            NomeDoador,
            idade,
            CPF,
            Telefone,
            Senha) values (:EmailDoador,:NomeDoador,:idade,:CPF,:Telefone,:Senha)");
            $query->execute(array(
                ":NomeDoador" => $arr["nome"],
                ":EmailDoador" => $arr["email"],
                ":Senha" => md5($arr["senha"]),
                ":CPF" => $arr["CPF"],
                ":Telefone" => $arr["telefone"],
                ":idade" => $arr["idade"],

            ));
            return $db->lastInsertId();
        } catch (\Throwable $th) {
            return false;
        }
    }
}
