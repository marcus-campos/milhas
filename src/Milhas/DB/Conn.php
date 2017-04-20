<?php

namespace Milhas\DB;


class Conn
{
    public static function getDb()
    {
        $config = include_once "../config/db.php"; //Get configs

        if($config['driver'] == 'mysql')
            return new \PDO("{$config['driver']}:host={$config['host']};dbname={$config['database']}","{$config['user']}","{$config['password']}");
        else if($config['driver'] == 'sqlite') {
            return new \PDO("{$config['driver']}:{$config['sqlite']['path']}");
        }
        else
            return new \PDOException('Error! Driver can\'t be found.');
    }
}