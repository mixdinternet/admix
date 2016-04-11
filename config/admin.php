<?php

return [

    'url' => 'admix',

    'name' => '<b>MIXD</b> Internet',

    'www' => true,

    /**
     * strings encontradas na url que não deixará redirecionar para o www
     */
    'skipWww' => [
        '.mixd'
        , '.local'
        , '.dev'
        , 'localhost'
    ],

    'protocol' => 'http'

];