<?php

namespace Server;

return [

    'refresh_rate' => '5000' ,


    'excellent_min' => 0 ,
    'excellent_max' => 70 ,
    'warning_min' => 71 ,
    'warning_max' => 120 ,
    'danger_min' => 200 ,



    // start servers
    'servers' => [

        // international
        'Modem' => [
            'name' => 'Modem' , 'type' => 'ip' ,
            'url' => '192.168.1.1' , 'is_international' => true ,
        ],

        'Google' => [
            'name' => 'Google' , 'type' => 'dns' ,
            'url' => '8.8.8.8' , 'is_international' => true ,
        ],

        'Cloudflare' => [
            'name' => 'Cloudflare' , 'type' => 'dns' ,
            'url' => '1.1.1.1' , 'is_international' => true ,
        ],

        'Google_com' => [
            'name' => 'Google_com' , 'type' => 'host' ,
            'url' => 'google.com' , 'is_international' => true ,
        ],



        // internal
        'TCI' => [
            'name' => 'TCI' , 'type' => 'dns' ,
            'url' => '217.218.155.155' , 'is_international' => false ,
        ],

        'Asiatech' => [
            'name' => 'Asiatech' , 'type' => 'dns' ,
            'url' => '1.1.1.1' , 'is_international' => false ,
        ],

        'Hiweb' => [
            'name' => 'Hiweb' , 'type' => 'dns' ,
            'url' => '46.224.1.42' , 'is_international' => false ,
        ],
        'digikala' => [
            'name' => 'digikala' , 'type' => 'host' ,
            'url' => 'digikala.com' , 'is_international' => false ,
        ],
    ] ,
    //  end servers
];


