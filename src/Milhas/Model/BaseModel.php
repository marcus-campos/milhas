<?php


namespace Milhas\Model;


use Milhas\DB\Conn;
use Milhas\Model\Table\Table;

class BaseModel extends Table
{
    public function __construct()
    {
        parent::__construct(Conn::getDb());
    }
}