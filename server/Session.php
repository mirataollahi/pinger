<?php
namespace Server;


class Session {

    public function __construct()
    {
        return session_start(); // start session in application
    }

    /**
     * @return bool
     */
    public static function start(): bool
    {
        return session_start(); // start session in application
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function set( $key , $value ): mixed
    {
        $_SESSION[$key] = $value;
        return $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get( $key ): mixed
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * @param $key
     * @return bool
     */
    public static function has( $key ): bool
    {
        return isset($_SESSION[$key]);
    }

    /**
     * @param $key
     * @return void
     */
    public static function unset($key):void
    {
        unset( $_SESSION[$key] );
    }

    /**
     * @return bool
     */
    public static function reset(): bool
    {
        return session_destroy();
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        return $_SESSION;
    }
}
