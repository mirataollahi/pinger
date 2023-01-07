<?php
namespace Server;

use JetBrains\PhpStorm\Pure;

Class Application {

    /**
     * @var Request
     */
    protected Request $request;
    /**
     * @var string
     */
    protected string $pingServer ;

    public function __construct()
    {
        $this->startSession();
        $this->startRequest();
        return $this;
    }


    /**
     * @return bool|string
     */
    public function run(): bool|string
    {
        if ($this->request->get('operation') == 'ping') return $this->ping();
        if ($this->request->get('operation') == 'reset') return $this->reset();
        if ($this->request->get('operation') == 'servers') return $this->getServers();
        if ($this->request->get('operation') == 'monitoring') return $this->monitoring();
        else return $this->response(null);
    }


    /**
     * @return void
     */
    protected function getPingServer():void
    {
        $this->pingServer =  $this->request()->get('server');
    }


    /**
     * @return void
     */
    protected function startRequest():void
    {
        $this->request = request();
    }


    /**
     * @return Request
     */
    protected function request(): Request
    {
        return $this->request;
    }


    /**
     * @return bool
     */
    protected function validateRequest(): bool
    {
        return $this->request()->validateFillable('server');
    }


    /**
     * @return bool
     */
    protected function startSession():bool
    {
        return Session::start();
    }


    /**
     * @return bool|string
     */
    protected function ping(): bool|string
    {
        $this->validateRequest();
        $this->getPingServer();
        $server = $this->pingServer;
        Session::has( $server ) //check ping class is defined ot not
            ? Session::set( $server , session($server)->run($server) )
            : Session::set( $server , new Ping($server) );

        $ping =  session($server);
        return $this->response($ping->data , $ping->status );
    }



    protected function reset()
    {
        $result = Session::reset();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    /**
     * @param mixed $data
     * @param int $status
     * @param string|null $message
     * @return false|string
     */
    protected function response (mixed $data = [] , int $status = 1  , mixed $message = null): bool|string
    {
        header('Content-type: application/json'); // json response
        return json_encode([
            'status' => (int) $status ?? 0 ,
            'message' => $message ?? ( $status  ? 'operation successful' : 'operation failed' ) ,
            'data' => $data ,
        ]);
    }

    /**
     * @return bool|string
     */
    public function getServers(): bool|string
    {
        $servers = config('servers');
        return $this->response($servers , true);
    }

    /**
     * @return array
     */
    #[Pure] public function monitoring(): array
    {
        return Session::all();
    }


}