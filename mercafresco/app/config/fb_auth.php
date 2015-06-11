<?php

return array(
      "base_url" => Request::root()."/login/loguearporfacebook/auth",
      "providers" => array (
        "Facebook" => array ("enabled" => true,
        "keys"=> array ( "id" => "872908226106299", "secret" => "1b7bd7e19e6adddf4ce04c3123f58e2e" ),
        "scope"   => "public_profile,email"//, // optional//"display" => "popup" // optional
       )
    ));
