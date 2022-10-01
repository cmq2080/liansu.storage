<?php

namespace liansu\storage;

class Session
{
    protected static $prefix = ''; // 为了防止撞session，所以设置前置key

    public static function initialize($prefix = null)
    {
        if (isset($_SESSION) === true) {
            session_start();
        }

        if ($prefix !== null) {
            self::$prefix = $prefix;
        }
    }

    public static function set($key, $value)
    {
        $_SESSION[self::getKey($key)] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION[self::getKey($key)] ?? $default;
    }

    public static function del($key)
    {
        unset($_SESSION[$key]);
    }

    protected static function getKey($key)
    {
        return self::$prefix . $key;
    }
}
