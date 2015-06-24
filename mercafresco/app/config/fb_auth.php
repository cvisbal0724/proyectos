<?php

return array(
      "base_url" => Request::root()."/login/loguearporfacebook/auth",
      "providers" => array (
        "Facebook" => array ("enabled" => true,
        "keys"=> array ( "id" => "964187256972828", "secret" => "28d337376c6ff60be0d294bfd0b1f145" ),
        "scope"   => "public_profile,email"//, // optional//"display" => "popup" // optional
       )
    ));
