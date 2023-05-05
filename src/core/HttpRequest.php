<?php

namespace Core;

class HttpRequest{

    public function all()
    {
        return $_POST;
    }
    public function get(string $field)
    {
        if(isset($_POST[$field])){
            return $_POST[$field];
        }else{
            return null;
        }
    }

}