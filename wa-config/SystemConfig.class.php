<?php

require_once dirname(__FILE__).'/../wa-system/autoload/waAutoload.class.php';
waAutoload::register();

class SystemConfig extends waSystemConfig
{

}

function wa_password_hash($password)
{
    return md5(sha1("SaL:T1%(#".$password)."_s+A=lT,2*");
}