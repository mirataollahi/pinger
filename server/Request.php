<?php
namespace Server;


class Request
{

    protected  array $servers = [];
    protected  array $params = [];

    public function __construct()
    {
        $this->params = array_merge( $_GET , $_POST );
        $this->servers = $_SERVER;
        return $this;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name): mixed
    {
        if ( isset($this->$name) === true ) return $this->$name;
        return $this->has($name) ? $this->get($name) : null ;
    }

    /**
     * @param $index
     * @return mixed|null
     */
    public function get($index): mixed
    {
        if( array_key_exists($index , $this->params) )
            return $this->params[$index];
        else return null;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key ): bool
    {
        return array_key_exists($key , $this->params);
    }


    /**
     * @return array
     */
    public function all(): array
    {
        return $this->params;
    }

    /**
     * @param $key
     * @return array|mixed|null
     */
    public function server($key = null): mixed
    {
        if(array_key_exists($key , $this->servers)) return $this->servers[$key];
        else if(is_null($key)) return $this->servers;
        else return null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function validateFillable(string $key ): bool
    {
        return (bool) $this->has($key) AND !is_null($this->get($key));
    }


}
