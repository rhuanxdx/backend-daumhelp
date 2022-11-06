<?php
require_once "vendor/autoload.php";

Core\Core::Init();
Services\Router::Init(
    array(
        [
            "methods" => ["POST"],
            "route_name" => "/doador/login",
            "route_value" => "Doador/index"
        ],
        [
            "methods" => ["POST"],
            "route_name" => "/doador/cadastrar",
            "route_value" => "Doador/cadastrar"
        ],
    )
);
