<?php

namespace Server;

/**
 * - Class responsible for all API request methods
 * - Classe responsável por todos metódos de requisição da API
 **/
class Request
{
    /**
     * - Returns the current request method
     * - Retorna o metódo atual da requisição
     * 
     * @return string
     */
    public static function Method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
    /**
     * - Return if request method is valid
     * - Retorna se o metódo é válido
     *
     * @param array $data
     * 
     * @return bool
     */
    public static function ValidateMethod($data = []): bool
    {
        return !empty($data) and in_array(Self::Method(), $data);
    }
    /**
     * - Return request data
     * - Retorna os dados da requisição 
     * 
     * @return array
     */
    public static function Data(): array
    {
        $data = array();
        try {
            $data = array();
            switch (Self::Method()) {
                case 'GET':
                    $data = json_decode(file_get_contents('php://input'), 1);
                    if (is_null($data)) $data = $_GET;
                    break;

                case 'POST':
                    $data = json_decode(file_get_contents('php://input'), 1);
                    if (is_null($data)) $data = $_POST;
                    break;
            }
        } catch (\Throwable $th) {
            \Server\Response::Return(500, "Request Data Error", false, ["error" => $th->getMessage()]);
        }

        return $data;
    }
    public static function ValidateData(array $arr = [])
    {
        try {

            $arr_necessary = [];
            $data = Self::Data();
            if ($arr == []) return $data;
            foreach ($arr as $name) {
                if (!in_array($name, array_keys($data))) {
                    $arr_necessary[] = $name;
                }
            }
            if ($arr_necessary == []) return $data;
            else \Server\Response::Return(400, "Dados Faltando!", false, $arr_necessary);
        } catch (\Throwable $th) {
            \Server\Response::Return(500, "Request Data Error", false, ["error" => $th->getMessage()]);
        }
    }
}
