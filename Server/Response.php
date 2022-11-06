<?php

namespace Server;

/**
 * - Class responsible for all API response methods
 * - Classe responsável por todos metódos de resposta da API
 **/
class Response
{
    /**
     * - Show JSON API response
     * - Mostra a resposta JSON da API 
     * 
     * @param int $code
     * @param mixed|string $msg
     * @param bool $return
     * @param mixed $payload
     * 
     * @return void
     */
    public static function Return($code, $msg, $return, $payload = [])
    {
        try {
            if (is_numeric($code)) header("HTTP/1.1 " . $code);
            $arr = [
                "msg" => $msg,
                "return" => (bool)$return,
                "payload" => $payload
            ];
            print_r(Self::ValidateJson($arr));
            exit;
        } catch (\Throwable $th) {
            Self::Return(500, "Internal Server Error", false, [
                "error" => $th->getMessage()
            ]);
        }
    }
    /**
     * - Validate and return a JSON
     * - Valida e retorna um JSON
     *
     * @param mixed $data
     * 
     * @return string|bool
     */
    public static function ValidateJson($data)
    {
        try {
            $json = json_encode($data);
            if (json_last_error() === JSON_ERROR_NONE) return $json;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
