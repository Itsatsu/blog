<?php

namespace Core;

class HttpRequest{

    public function all()
    {
        return $_POST;
    }
    public function name(string $field)
    {
        return $_POST[$field];
    }
}