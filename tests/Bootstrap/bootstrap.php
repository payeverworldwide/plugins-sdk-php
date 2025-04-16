<?php

if (!defined('STUB_SERVER_HOST') || !defined('STUB_SERVER_PORT')) {
    exit("FATAL: You must define STUB_SERVER_HOST and STUB_SERVER_PORT constants in phpunit.xml" . PHP_EOL);
}

//Stub command
$stubStartCmd = 'php -S %s:%s ./vendor/payever/plugins-stub/server.php > /dev/null 2>&1 & echo $!';

//Start stub server
exec(sprintf($stubStartCmd, STUB_SERVER_HOST, STUB_SERVER_PORT));
//Start stub worker
exec(sprintf($stubStartCmd, STUB_SERVER_HOST, intval(STUB_SERVER_PORT) + 1));

// give the stub server time to boot up
sleep(3);
