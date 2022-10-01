<?php

namespace liansu\storage;

class Cache
{
    protected static $cacheDir = '';
    protected static $defaultExpireSeconds = 86400;

    public static function initialize($cacheDir = null, $defaultExpireSeconds = null)
    {
        if ($cacheDir !== null) {
            self::$cacheDir = $cacheDir;
        }
        if ($defaultExpireSeconds !== null) {
            self::$defaultExpireSeconds = $defaultExpireSeconds;
        }

        if (!self::$cacheDir) {
            throw new \Exception('缓存目录未设置');
        }

        if (!is_dir(self::$cacheDir)) {
            mkdir(self::$cacheDir, 0777, true);
        }
    }

    public static function set($key, $value)
    {
        if (!is_string($value)) {
            throw new \Exception('值不是字符串');
        }

        $path = self::$cacheDir . '/' . $key;
        file_put_contents($path, $value);
    }

    public static function get($key, $default = null, $expireSeconds = null)
    {
        if ($expireSeconds === null) {
            $expireSeconds = self::$defaultExpireSeconds;
        }

        $path = self::$cacheDir . '/' . $key;
        if (!is_file($path) || (filemtime($path) + $expireSeconds) < time()) {
            unlink($path);
            return $default;
        }

        return file_get_contents($path);
    }
}
