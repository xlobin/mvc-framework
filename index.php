<?php

require_once dirname(__FILE__).'/core/App.php';
$config = dirname(__FILE__).'/app/config.php';

App::createWeb($config)->run();
?>
