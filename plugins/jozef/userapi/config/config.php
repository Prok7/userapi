<?php

    return [
        
        /*
        |--------------------------------------------------------------------------
        | Activation code time to live
        |--------------------------------------------------------------------------
        | Specify how long will be activation code valid.
        | Defaults to 10 minutes 
        */
        "activation_code_ttl" => env("ACTIVATION_CODE_TTL", 10)

    ];