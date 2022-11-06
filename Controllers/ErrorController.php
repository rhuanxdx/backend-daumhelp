<?php

namespace Controllers;

class ErrorController
{
    public static function NotFound()
    {
        \Server\Response::Return(404, "Não encontrado!", false);
    }
    public static function InvalidMethod()
    {
        \Server\Response::Return(401, "Método não permitido!", false);
    }
}
