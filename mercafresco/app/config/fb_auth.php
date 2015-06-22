<?php

return array(
      "base_url" => Request::root()."/login/loguearporfacebook/auth",
      "providers" => array (
        "Facebook" => array ("enabled" => true,
        "keys"=> array ( "id" => "799681453463441", "secret" => "eeb87d0833b27183def94dd5d125ed94" ),
        "scope"   => "public_profile,email"//, // optional//"display" => "popup" // optional
       )
    ));
