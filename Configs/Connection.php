<?php
namespace Configs;
class Connection
{
    private static $dbName = "freedb_Da-um-Help";
    private static $dbHost = "sql.freedb.tech";
    private static $dbUser = "freedb_rhuanxdx";
    private static $dbPwd = "$@N%uZr9VC&T9cx";
    public static function Get()
    {
        try {
            $conn = new \PDO("mysql:host=" . Self::$dbHost . ";dbname=" . Self::$dbName, Self::$dbUser, Self::$dbPwd);
            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(\PDO::ATTR_EMULATE_PREPARES, FALSE);
            $conn->exec("SET NAMES utf8");
            return $conn;
        } catch (\PDOException $e) {
            \Server\Response::Return(500, "Internal Server Error", false, [
                "error" => $e->getMessage()
            ]);
        }
    }
    public static function Check(): bool
    {
        try {
            return (!is_null(Self::Get()) and Self::Get());
        } catch (\Throwable $th) {
            return false;
        }
    }
}
