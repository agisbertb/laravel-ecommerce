<?php

return [
    'key'                   => env('REDSYS_KEY','sq7HjrUOBfKmC576ILgskD5srU870gJ7'),
    'url_notification'      => env('REDSYS_URL_NOTIFICATION','http://localhost:8000/redsys/notification'),
    'url_ok'                => env('REDSYS_URL_OK','http://localhost:8000/redsys/success'),
    'url_ko'                => env('REDSYS_URL_KO','http://localhost:8000/redsys/error'),
    'merchantcode'          => env('REDSYS_MERCHANT_CODE','999008881'),
    'terminal'              => env('REDSYS_TERMINAL','1'),
    'environment'            => env('REDSYS_ENVIROMENT','test'),
    'tradename'             => env('REDSYS_TRADENAME','LARAVELECOMMERCEDEV'),
];
