<?php

namespace Milhas\Http\Input;


class Input
{
    /**
     * @param $input
     * @return mixed
     */
    static function get($input)
    {
        return $_POST[$input];
    }

    /**
     * @param $file
     * @return mixed
     */
    static function file($file)
    {
        return $_FILES[$file];
    }
}