<?php

namespace Milhas\Http\Redirect;


class Redirect
{
    static function to($url)
    {
        return header("location:{$url}", true);
    }
}