<?php

return [

    'accounts' =>[
        'client_id' =>'AbQjBD2tGy5l37vW5COtk9az2s0hyxV6jkwFSdJWKGa64dCoLRlERHTS42Mg8o1vNOblFM0lxS9RQMjz',
        'secret_client' => 'EKNwFRRXyBCYmHNCulAhOYTQI9aoHKTahBdvSa59t5LeHt7iPAtD_84J6QrQPaoTI62tQ55Ux0Z1N7nU'

    ],

    'setting' =>[
        'mode' =>'sandbox',
        'http.Connection.TimeOut' =>'30',
        'log.logEnable' =>true,
        'logFileName' => public_path().'/logs/paypal.log'
    ]
];
