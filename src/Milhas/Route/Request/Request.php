<?php


namespace Milhas\Route\Request;


class Request
{
    private $request;

    public function __construct()
    {
        $this->request = json_decode(file_get_contents("php://input"));
    }

    public function all()
    {
        return $this->request;
    }
}