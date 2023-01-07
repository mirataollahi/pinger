<?php

namespace Server;

/**
 * @return Request
 */
function request(): Request
{
    return new Request();
}

/**
 * @param string $key
 * @param $value
 * @return mixed
 */
function session( string $key , $value = null)
{
    return is_null($value) ? Session::get($key) : Session::set( $key , $value);
}

/**
 * @param $key
 * @param $default
 * @return mixed
 */
function config($key , $default = null): mixed
{
    $configs = include('config.php');
    return $configs[$key] ?? ($default ?? null) ;
}

