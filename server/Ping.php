<?php

namespace Server;


class Ping
{
    public string $server; // ping server address

    public int $sent = 0;
    public int $received = 0;
    public int $lost_count = 0;
    public int $lost = 0;

    public int $sum = 0;
    public int $average = 0;

    public int $time = 0;
    public int $status = 0;

    public array $output = [];
    public int $command_status = 0;
    public string $command = '';
    public array $data;
    public mixed $name;

    public function __construct($server)
    {
        return $this->run($server); // create ping class and run first pinging
    }

    public function run($server): Ping
    {
        $this->setServer($server);
        $this->setName();
        $this->rumCommand(); // run ping ip server command
        $this->parsResult(); // get time and data
        $this->data = $this->data(); // return ping time , lost , sent , received , average , status ,
        return $this;
    }

    /**
     * @param $server
     * @return void
     */
    public function setServer($server): void
    {
        $this->server = $server;
    }

    /**
     * @return void
     */
    public function setName():void
    {
        $this->name = !is_null( request()->get('name') ) ? request()->get('name') :  ($this->name ?? null);
    }

    /**
     * @return void
     */
    public function rumCommand(): void
    {
        $this->output = [];
        exec("ping -n 1 $this->server", $this->output, $this->command_status);
    }

    /**
     * @return void
     */
    public function parsResult()
    {
        if ($this->command_status == 1) $this->calculate(0);
        else if (count($this->output) == 0 || count($this->output) == 1) $this->calculate(0);
        else if ( !str_contains($this->output[2] , 'time') ) $this->calculate(0);
        else {
            $this->command = $this->output[2];
            $position = strpos($this->command, 'time=');
            $time = substr($this->command, $position, 8);
            $time = explode('=', $time)[1];
            $time = str_replace('ms', '', $time);
            $time = str_replace('m', '', $time);
            $this->time = (int)$time;

            $this->calculate(1);
        }
    }

    /**
     * @param $status
     * @return void
     */
    public function calculate($status): void
    {
        $this->status = $status;
        $this->sent++;
        $this->sum += $this->time;

        if ($status) $this->received++; // success ping
        else $this->lost_count++; // fail ping

        $this->average = $this->sum / $this->sent; //calculate average
        $this->lost = ($this->lost_count * 100) / $this->sent ;
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return [
            'status' => $this->status,
            'server' => $this->server,
            'sent' => $this->sent,
            'received' => $this->received,
            'lost' => $this->lost,
            'average' => $this->average,
            'time' => $this->time,
            'name' => $this->name,
        ];
    }


}