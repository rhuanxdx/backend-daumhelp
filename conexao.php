<?php


$hostname = "sql.freedb.tech";
$bancodedados = "freedb_Da-um-Help";
$usuario = "freedb_rhuanxdx";
$senha = "$@N%uZr9VC&T9cx";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);
if($mysqli->connect_errno){
    echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysql->connect_error;
}

