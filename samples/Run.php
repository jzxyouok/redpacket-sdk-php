<?php

require_once './Common.php';

$rpClient = Common::getRPClient();
echo $rpClient->hello();


