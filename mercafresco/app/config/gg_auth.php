<?php

/*return array(
      "base_url" => Request::root()."/login/loguearporgoogle/auth",
      "providers" => array (
        "Google" => array ("enabled" => true,
        	"keys" => array ( "id" => "663919530695-qcaq0cuomrdpnmjvre4kq7c3gt9cdnim.apps.googleusercontent.com", 
        		"secret" => "6GsOvPSxEEcFRX_HNrbwXoiY" ),
        		"scope"           => "https://www.googleapis.com/auth/userinfo.profile",
        		'redirect_uri'=> 'http://mercafresco.com/auth',
        		"access_type"     => "offline", 
        		"approval_prompt" => "force", 

       )
    ));*/


/*return array("base_url" => Request::root()."/login/loguearporgoogle/auth",
      "providers" => array (
        "Google" => array (
          "enabled" => true,
          "keys"    => array ( "id" => "1078465214054-ma73458v3seavrla30v8ersfbnao3nnf.apps.googleusercontent.com", 
          "secret" => "Tta4jsT90byaF8I1TvcFw3XE" ),
          "scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email"   , // optional
          //'redirect_uri'=> 'http://mercafresco.com/login/loguearporgoogle/auth',
     )
   )
);
*/

//http://mercafresco.com/login/loguearporgoogle/auth
//http://mercafresco.com/login/loguearporgoogle
//http://mercafresco.com/
//http://mercafresco.com/login/loguearporgoogle/auth?hauth.done=Google

return array(
      "base_url" =>Request::root()."/login/loguearporgoogle/auth",
      "providers" => array (
        "Google" => array (
          "enabled" => true,
          "keys"    => array ( "id" => "1078465214054-evshfhfbsaesp41de56dtjo9eh8hf98p.apps.googleusercontent.com", 
            "secret" => "o7vE37oxXu6VBrvDcvpncIH2" ),
          "scope"           => "https://www.googleapis.com/auth/userinfo.profile ". // optional
                               "https://www.googleapis.com/auth/userinfo.email"   , // optional
          "access_type"     => "offline",   // optional
          "approval_prompt" => "force",     // optional
          //"hd"              => "domain.com" // optional
    )));