<?php


namespace Milhas\Http\Request;


class Request
{
    private $request;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->request = json_decode(file_get_contents("php://input"));
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->request;
    }
}