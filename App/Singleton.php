<?php

namespace App;

trait Singleton
{
    protected static $instance;

    protected function __construct()
    {
    }

    public static function instance()
    {
        if (NULL === static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}