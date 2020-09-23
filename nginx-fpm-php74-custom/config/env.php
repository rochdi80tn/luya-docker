<?php		
         
$config = require 'config.php'; 

$env = getenv('LUYA_CONFIG_ENV');

if (empty($env)) {
    $env = \luya\Config::ENV_PROD;
}

return $config->toArray([$env]);
