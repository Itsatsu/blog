<?php

namespace Core;

use http\Message;

class Session
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function set($key, $value)
    {
        if (is_array($value) && !empty($value) && array_keys($value) !== range(0, count($value) - 1)) {
            // Tableau associatif
            foreach ($value as $subkey => $subvalue) {
                $_SESSION[$key][$subkey] = $subvalue;
            }
        } else {
            // Autre valeur
            $_SESSION[$key] = $value;
        }
    }

    public function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public function delete($key)
    {
        unset($_SESSION[$key]);
    }

    public function setMessage($type, $value)
    {
            $_SESSION['message']['type'] = $type;
            $_SESSION['message']['value'] = $value;
            $_SESSION['message']['see'] = 0;

    }
    public function seeMessage()
    {
        $_SESSION['message']['see'] = 1;
    }

    public function getMessage()
    {
        if (isset($_SESSION['message'])) {
            return $_SESSION['message'];
        }
        return null;

    }

    public function deleteMessage()
    {
        unset($_SESSION['message']);
    }

    public function start()
    {
        session_start();
    }



    public function destroy()
    {
        session_unset();
        session_destroy();
    }
}



