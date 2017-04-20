<?php

namespace Milhas\DB;


class Conn
{
    public static function getDb()
    {
        $config = include_once "../config/db.php"; //Get configs
        return new \PDO("{$config['driver']}:host={$config['host']};dbname={$config['database']}","{$config['user']}","{$config['password']}");
    }
}